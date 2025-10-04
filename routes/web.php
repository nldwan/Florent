<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::get('/siswa/materi', [SiswaController::class, 'materi'])->name('siswa.materi');
    Route::get('/siswa/vocabulary', [SiswaController::class, 'vocabulary'])->name('siswa.vocabulary');
    Route::get('/profile', function () {
        return view('profile.edit'); // bikin file resources/views/profile/edit.blade.php
    })->name('profile.edit');
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});

require __DIR__.'/auth.php';
