<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'siswa',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate();
            return redirect()->route('siswa.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();          // Logout user
        $request->session()->invalidate();      // Hapus session lama
        $request->session()->regenerateToken(); // Buat CSRF token baru

        return redirect('/login');              // Redirect ke login
    }
}