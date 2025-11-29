<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vocabulary;

class VocabularyController extends Controller
{
    // Tampilkan semua vocabulary
    public function index(Request $request)
    {
        $search = $request->input('search');

        $vocabularies = Vocabulary::when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('verb1', 'like', "%{$search}%")
                ->orWhere('verb2', 'like', "%{$search}%")
                ->orWhere('verb3', 'like', "%{$search}%")
                ->orWhere('meaning', 'like', "%{$search}%");
            });
        })->get();

        return view('siswa.vocabulary', compact('vocabularies'));
    }

    // Filter berdasarkan type: noun, verb, adjective, adverb
    public function filterByType($type)
    {
        $vocabularies = Vocabulary  ::where('type', $type)->get();
        return view('siswa.vocabulary', compact('vocabularies'));
    }
}
