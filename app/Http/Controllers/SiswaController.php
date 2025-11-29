<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use App\Models\Material;
use App\Models\Vocabulary;
use App\Models\Conversation;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data nilai berdasarkan user yang login
        $grades = Grade::where('user_id', Auth::id())->get();

        return view('siswa.dashboard', compact('grades'));
    }

    public function materi()
    {
        $user = Auth::user();

        $materi = Material::where('kursus', $user->kursus)->get();

        return view('siswa.materi', compact('materials'));
    }

    // public function vocabulary() 
    // {
    //     $vocabularies = Vocabulary::all();
    //     return view('siswa.vocabulary', compact('vocabularies'));
    // }

    public function conversation()
    {
        $conversations = Conversation::all();
        return view('siswa.conversation', compact('conversations'));
    }
}
