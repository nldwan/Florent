<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::where('role', 'siswa')->count();  // hanya siswa
        $adminCount = User::where('role', 'admin')->count();  // hanya admin
        $materialCount = Material::count();

        return view('admin.dashboard', compact('userCount','adminCount', 'materialCount'));
    }
}
