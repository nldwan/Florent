<?php

namespace App\Http\Controllers;
use App\Models\Material;
use App\Models\Grade;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $materials = Material::where('course_id', $user->course_id)
            ->orderBy('level_id')
            ->orderBy('sublevel_id')
            ->get();


        $completedLevels = Grade::where('user_id', $user->id)
            ->where('status', 'completed')
            ->pluck('sublevel_id')
            ->toArray();

        return view('siswa.materi', compact('materials', 'completedLevels'));
    }

}
