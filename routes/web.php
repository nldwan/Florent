<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VocabularyController;
use App\Http\Controllers\MaterialController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// ===============================
// HALAMAN AWAL
// ===============================
Route::get('/', function () {
    return view('welcome');
});

// ===============================
// EMAIL VERIFICATION
// ===============================
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/siswa/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// ======================================================
// ROUTE PROTECTED (HARUS LOGIN)
// ======================================================
Route::middleware(['auth'])->group(function () {

    // =====================
    // SISWA ONLY
    // =====================
    Route::middleware(['role:siswa'])->group(function () {
        Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
        Route::get('/siswa/materi', [MaterialController::class, 'index'])->name('siswa.materi');       
        Route::get('/siswa/vocabulary', [VocabularyController::class, 'index'])->name('siswa.vocabulary');
        Route::get('/vocabulary/type/{type}', [VocabularyController::class, 'filterByType'])->name('vocabulary.filter');
        Route::get('/siswa/conversation', [SiswaController::class, 'conversation'])->name('siswa.conversation');
        Route::get('/siswa/grade', [SiswaController::class, 'grade'])->name('siswa.grade');
    });

    // =====================
    // ADMIN ONLY
    // =====================
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        // Route resource admin nanti bisa ditambah di sini
    });


    // =====================
    // PROFILE (SEMUA ROLE)
    // =====================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});


// AUTH ROUTES
require __DIR__.'/auth.php';
