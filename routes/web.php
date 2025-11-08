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

    // Siswa
    Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
    Route::get('/siswa/materi', [SiswaController::class, 'materi'])->name('siswa.materi');
    Route::get('/siswa/vocabulary', [SiswaController::class, 'vocabulary'])->name('siswa.vocabulary');
    Route::get('/siswa/conversation', [SiswaController::class, 'conversation'])->name('siswa.conversation');
    Route::get('/siswa/grade', [SiswaController::class, 'grade'])->name('siswa.grade');
    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');

    // Admin
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Route::resource('/admin/materi', MateriController::class);
    // Route::resource('/admin/vocabulary', VocabularyController::class);
    // Route::resource('/admin/grade', GradeController::class);
});

require __DIR__.'/auth.php';
