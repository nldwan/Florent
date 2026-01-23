<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Course;
use App\Models\Level;
use App\Models\Sublevel;
use Illuminate\Http\Request;

class AdminMaterialController extends Controller
{
    // LIST
    public function index()
    {
        $materials = Material::with(['course', 'level', 'sublevel'])->get();
        return view('admin.materials', [
            'materials' => Material::with(['course', 'level', 'sublevel'])->get(),
            'courses' => Course::all(),
            'levels' => Level::all(),
            'sublevels' => Sublevel::all(),
        ]);
    }

    // FORM TAMBAH
    public function create()
    {
        return view('admin.material_create', [
            'courses' => Course::all(),
            'levels' => Level::all(),
            'sublevels' => Sublevel::all(),
        ]);
    }

    // SIMPAN
    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required',
            'level_id' => 'required',
            'sublevel_id' => 'required',
            'title' => 'required|string',
            'file' => 'required|file|mimes:pdf',
        ]);

        $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
        $request->file('file')->move(public_path('materi'), $fileName);

        Material::create([
            'course_id' => $request->course_id,
            'level_id' => $request->level_id,
            'sublevel_id' => $request->sublevel_id,
            'title' => $request->title,
            'file' => $fileName,
        ]);

        return redirect()
            ->route('admin.materials.index')
            ->with('success', 'Material berhasil ditambahkan');
    }

    // FORM EDIT
    public function edit(Material $material)
    {
        return view('admin.material.edit', [
            'material' => $material,
            'courses' => Course::all(),
            'levels' => Level::all(),
            'sublevels' => Sublevel::all(),
        ]);
    }

    // UPDATE
    public function update(Request $request, Material $material)
    {
        $request->validate([
            'course_id' => 'required',
            'level_id' => 'required',
            'sublevel_id' => 'required',
            'title' => 'required|string',
            'file' => 'nullable|file|mimes:pdf',
        ]);

        $data = $request->only([
            'course_id',
            'level_id',
            'sublevel_id',
            'title'
        ]);

        if ($request->hasFile('file')) {
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->move(public_path('materi'), $fileName);
            $data['file'] = $fileName;
        }

        $material->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Material berhasil diupdate',
            'data' => $material
        ]);
    }

    // HAPUS
    public function destroy(Material $material)
    {
        if ($material->file && file_exists(public_path('materi/' . $material->file))) {
            unlink(public_path('materi/' . $material->file));
        }

        $material->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Material berhasil dihapus'
        ]);
    }
}
