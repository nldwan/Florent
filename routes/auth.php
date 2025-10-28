<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    //Form register
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    // Proses register
    Route::post('register', [RegisteredUserController::class, 'store']);
    // Form login
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    // Proses login
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
