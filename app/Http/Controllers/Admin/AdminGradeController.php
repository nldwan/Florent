<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Course;
use App\Models\User;
use App\Models\Level;
use App\Models\Sublevel;
use Illuminate\Http\Request;

class AdminGradeController extends Controller
{
    // LIST
    public function index()
    {
        return view('admin.grades', [
            'grades' => Grade::with(['user', 'course', 'level', 'sublevel'])->get()
        ]);
    }

    // FORM CREATE
    public function create()
    {
        return view('admin.grades_create', [
            'students' => User::where('role', 'siswa')->get(),
            'courses' => Course::all(),
            'levels' => Level::orderBy('order')->get(),
            'sublevels' => Sublevel::orderBy('order')->get(),
        ]);
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'level_id' => 'required',
            'sublevel_id' => 'required',
        ]);

        // VALIDASI PROGRESS SISWA
        $user = User::findOrFail($request->user_id);

        if (
            $request->level_id != $user->current_level_id ||
            $request->sublevel_id != $user->current_sublevel_id
        ) {
            return redirect()->back()->withErrors([
                'error' => 'Tidak bisa menilai materi yang belum terbuka untuk siswa ini'
            ]);
        }

        // HITUNG FINAL SCORE
        $scores = collect([
            $request->writing_grammar,
            $request->writing_translation,
            $request->writing_composition,
            $request->reading_compre,
            $request->reading_vocabulary,
            $request->listening_compre,
            $request->speaking_pronouncing,
            $request->speaking_intonation,
            $request->speaking_fluency,
        ])->filter();

        $finalScore = $scores->avg();
        $status = $finalScore >= 75 ? 'completed' : 'in_progress';

        // SIMPAN NILAI
        Grade::create(array_merge(
            $request->all(),
            [
                'final_score' => $finalScore,
                'status' => $status,
            ]
        ));

        // UPDATE CURRENT LEVEL & SUBLEVEL
        if ($status === 'completed') {
            $this->updateUserProgress($request->user_id);
        }

        return redirect()
            ->route('admin.grades.index')
            ->with('success', 'Grade berhasil ditambahkan & progress siswa diupdate');
    }

    // UPDATE
    public function update(Request $request, Grade $grade)
    {
        $scores = collect([
            $request->writing_grammar,
            $request->writing_translation,
            $request->writing_composition,
            $request->reading_compre,
            $request->reading_vocabulary,
            $request->listening_compre,
            $request->speaking_pronouncing,
            $request->speaking_intonation,
            $request->speaking_fluency,
        ])->filter();

        $finalScore = $scores->avg();
        $status = $finalScore >= 75 ? 'completed' : 'in_progress';

        $grade->update(array_merge(
            $request->all(),
            [
                'final_score' => $finalScore,
                'status' => $status,
            ]
        ));

        if ($status === 'completed') {
            $this->updateUserProgress($grade->user_id);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Grade berhasil diperbarui',
            'data' => $grade
        ]);
    }

    // DELETE
    public function destroy(Grade $grade)
    {
        $grade->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Grade berhasil dihapus'
        ]);
    }

    // =====================================================
    // 🔥 LOGIC UTAMA AUTO UPDATE CURRENT LEVEL & SUBLEVEL
    // =====================================================
    private function updateUserProgress($userId)
    {
        $user = User::findOrFail($userId);

        $currentLevelId = $user->current_level_id;
        $currentSublevelId = $user->current_sublevel_id;

        // ambil sublevel sekarang
        $currentSublevel = Sublevel::find($currentSublevelId);

        if (!$currentSublevel) {
            return;
        }

        // cari sublevel berikutnya DI LEVEL YANG SAMA
        $nextSublevel = Sublevel::where('level_id', $currentLevelId)
            ->where('order', '>', $currentSublevel->order)
            ->orderBy('order')
            ->first();

        // NAIK SUBLEVEL
        if ($nextSublevel) {
            $user->update([
                'current_sublevel_id' => $nextSublevel->id
            ]);
            return;
        }

        // SUBLEVEL HABIS → NAIK LEVEL
        $currentLevel = Level::find($currentLevelId);

        $nextLevel = Level::where('order', '>', $currentLevel->order)
            ->orderBy('order')
            ->first();

        if (!$nextLevel) {
            return;
        }

        $firstSublevel = Sublevel::where('level_id', $nextLevel->id)
            ->orderBy('order')
            ->first();

        if ($firstSublevel) {
            $user->update([
                'current_level_id' => $nextLevel->id,
                'current_sublevel_id' => $firstSublevel->id
            ]);
        }
    }
}
