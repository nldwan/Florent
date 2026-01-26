<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Level;
use App\Models\Sublevel;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'siswa')->get();
        return view('admin.users_siswa', compact('users'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.users_create', compact('courses'));
    }

    // Simpan admin baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'no_hp'    => 'required|string|max:20',
            'password' => 'required|string|min:6',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Ambil level pertama dari course yang dipilih
        $firstLevel = Level::orderBy('order', 'asc')->first();

        // Ambil sublevel pertama dari level pertama
        $firstSublevel = $firstLevel 
                        ? Sublevel::where('level_id', $firstLevel->id)
                                ->orderBy('order', 'asc')
                                ->first()
                        : null;

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'role'     => 'siswa',
            'password' => bcrypt($request->password),
            'course_id' => $request->course_id,
            'current_level_id' => $firstLevel ? $firstLevel->id : null,
            'current_sublevel_id' => $firstSublevel ? $firstSublevel->id : null,
        ]);

        return redirect()
            ->route('admin.users.siswa')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'required|string|max:20',
        ]);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Admin berhasil diperbarui',
            'data' => $user
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Siswa berhasil dihapus'
        ]);
    }
}
