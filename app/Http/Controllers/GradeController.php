<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;

class GradeController extends Controller
{
    public function index ()
    {
        $grades = Grade::with('student')->get();
        return view('grades.index', compact('grades'));
    }
}
