<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vocabulary;

class VocabularyController extends Controller
{
    // Tampilkan semua vocabulary
    public function index()
    {
        $vocabularies = Vocabulary::all();
        return view('vocabularies.index', compact('vocabularies'));
    }

    // Filter berdasarkan type: noun, verb, adjective, adverb
    public function filterByType($type)
    {
        $vocabularies = Vocabularies::where('type', $type)->get();
        return view('vocabularies.index', compact('vocabularies'));
    }
}
