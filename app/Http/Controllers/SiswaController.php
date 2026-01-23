<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Grade;

class SiswaController extends Controller
{
    public function index()
    {
        // Ambil data nilai berdasarkan user yang login
        $grades = Grade::where('user_id', Auth::id())->get();

        return view('siswa.dashboard', compact('grades'));
    }

}
