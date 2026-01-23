<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vocabulary;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class AdminVocabularyController extends Controller
{
    public function index()
    {
        $vocabularies = Vocabulary::latest()->get();
        return view('admin.vocabulary', compact('vocabularies'));
    }

    public function create()
    {
        return view('admin.vocabulary_create');
    }   

    public function store(Request $request)
    {
        $request->validate([
            'verb1'   => 'required|string|max:255',
            'verb2'   => 'required|string|max:255',
            'verb3'   => 'required|string|max:255',
            'meaning' => 'required|string',
        ]);

        Vocabulary::create($request->only([
            'verb1',
            'verb2',
            'verb3',
            'meaning',
        ]));

        return redirect()
            ->route('admin.vocabulary.index')
            ->with('success', 'Vocabulary berhasil ditambahkan');
    }

    public function update(Request $request, Vocabulary $vocabulary)
    {
        $request->validate([
            'verb1'   => 'required|string|max:255',
            'verb2'   => 'required|string|max:255',
            'verb3'   => 'required|string|max:255',
            'meaning' => 'required|string',
        ]);

        $vocabulary->update($request->only([
            'verb1',
            'verb2',
            'verb3',
            'meaning',
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Admin berhasil diperbarui',
            'data' => $vocabulary
        ]);
    }

    public function destroy(Vocabulary $vocabulary)
    {
        $vocabulary->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Vocabulary berhasil dihapus',
        ]);
    }
}
