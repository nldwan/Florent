<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('materials.index', compact('materials'));
    }

    // Contoh fungsi upload file
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'file' => 'required|file',
        ]);

        $filePath = $request->file('file')->store('materials');

        Material::create([
            'title' => $request->title,
            'file' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Material berhasil ditambahkan');
    }
}
