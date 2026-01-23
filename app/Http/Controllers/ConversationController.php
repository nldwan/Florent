<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
class ConversationController extends Controller
{
    // Menampilkan semua conversation
    public function index()
    {
        $user = Auth::user();
        $conversations = Conversation::where('course_id', $user->course_id)->get();
        return view('siswa.conversation', compact('conversations'));
    }
}
