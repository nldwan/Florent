<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    // Menampilkan semua conversation
    public function index()
    {
        $conversations = Conversation::all();
        return view('siswa.conversation', compact('conversations'));
    }

    // (Opsional) Menampilkan form tambah conversation
    public function create()
    {
        return view('admin.add-conversation');
    }

    // (Opsional) Menyimpan data baru dari form
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'video' => 'required|string|max:255',
        ]);

        Conversation::create($request->only(['title', 'video']));

        return redirect()->route('conversations.index')->with('success', 'Conversation berhasil ditambahkan!');
    }
}
