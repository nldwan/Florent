<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminAdminController extends Controller
{
    // Tampilkan semua admin
    public function index()
    {
        $admins = User::where('role', 'admin')->get();
        return view('admin.users_admin', compact('admins'));
    }

    public function create()
    {
        return view('admin.admin_create');
    }

    // Simpan admin baru
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'no_hp'    => 'required|string|max:20',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'no_hp'    => $request->no_hp,
            'role'     => 'admin',
            'password' => bcrypt($request->password),
        ]);

        return redirect()
            ->route('admin.users.admin')
            ->with('success', 'Admin berhasil ditambahkan');
    }

    // Update admin
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'required|string|max:20',
            'password' => 'nullable|string|min:6',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Admin berhasil diperbarui',
            'data' => $data
        ]);
    }

    // Hapus admin
    public function destroy(User $user)
    {
        if ($user->role !== 'admin') {
            return response()->json([
                'status' => 'error',
                'message' => 'Hanya admin yang dapat dihapus'
            ], 403);
        }

        $user->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Admin berhasil dihapus'
        ]);
    }
}
