<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Form register
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // Proses register
    Route::post('register', [RegisteredUserController::class, 'store']);

    // Form login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // Proses login
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    // 🔹 Form lupa password
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    // 🔹 Kirim link reset password ke email
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    // 🔹 Form ubah password (dari email token)
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    // 🔹 Proses ubah password baru
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
