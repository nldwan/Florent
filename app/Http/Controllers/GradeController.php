<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grades;

class GradeController extends Controller
{
    public function index ()
    {
        $grades = Grades::with('student')->get();
        return view('grades.index', compact('grades'));
    }
}
