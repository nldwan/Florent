<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminConversationController extends Controller
{
    public function index()
    {
        $conversations = Conversation::with('course')->get();
        $courses = Course::all();

        return view('admin.conversations', compact('conversations', 'courses'));
    }

    public function create()
    {
        $courses = Course::all();
        return view('admin.conversations_create', compact('courses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id'  => 'required|exists:courses,id',
            'title'       => 'required|string|max:255',
            'video'       => 'required|string|max:255',
        ]);

        Conversation::create($request->only([
            'course_id',
            'title',
            'video',
        ]));

        return redirect()
            ->route('admin.conversations.index')
            ->with('success', 'Conversation berhasil ditambahkan');
    }

    public function update(Request $request, Conversation $conversation)
    {
        $request->validate([
            'course_id'  => 'required|exists:courses,id',
            'title'       => 'required|string|max:255',
            'video'       => 'required|string|max:255',
        ]);

        $conversation->update($request->only([
            'course_id',
            'title',
            'video',
        ]));

        return response()->json([
            'status' => 'success',
            'message' => 'Conversation berhasil diupdate',
            'data' => $conversation
        ]);
    }

    public function destroy(Conversation $conversation)
    {
        $conversation->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Conversation berhasil dihapus'
        ]);
    }
}
