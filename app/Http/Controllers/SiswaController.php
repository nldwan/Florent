<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Grade;
use App\Models\Grades;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data nilai berdasarkan user yang login
        $grades = Grades::where('user_id', Auth::id())->get();

        return view('siswa.dashboard', compact('grades'));
    }

    public function materi()
    {
        return view('siswa.materi');
    }

    public function vocabulary()
    {
        return view('siswa.vocabulary');
    }
}
