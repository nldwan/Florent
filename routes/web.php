<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\VocabularyController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminAdminController;
use App\Http\Controllers\Admin\AdminMaterialController;
use App\Http\Controllers\Admin\AdminVocabularyController;
use App\Http\Controllers\Admin\AdminConversationController;
use App\Http\Controllers\Admin\AdminGradeController;
use App\Http\Controllers\Admin\AdminPaymentController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// ===============================
// HALAMAN AWAL
// ===============================
Route::get('/', function () {
    return view('welcome');
});

// =====================
// ADMIN AUTH (LOGIN)
// =====================
Route::get('/admin/login', function () {
    return view('admin.auth.login');
})->name('admin.login');

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->name('admin.login.process');

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

// ===============================
// PAYMENT RESULT PAGES
// ===============================
Route::get('/payment/success', function () {
    return view('payment.success');
});

Route::get('/payment/failed', function () {
    return view('payment.failed');
});

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
        Route::get('/siswa/conversation', [ConversationController::class, 'index'])->name('siswa.conversation');
        Route::get('/siswa/grade', [SiswaController::class, 'grade'])->name('siswa.grade');
        Route::post('/siswa/payment/create', [PaymentController::class, 'create'])->name('siswa.payment.create');
    });

    // =====================
    // PROFILE (SEMUA ROLE)
    // =====================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// =====================
// ADMIN ONLY
// =====================

Route::prefix('admin')->middleware(['auth','role:admin'])->group(function() {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Users Siswa (update & delete saja)
    Route::get('/users/siswa', [AdminUserController::class, 'index'])->name('admin.users.siswa');
    Route::get('/users/siswa/create', [AdminUserController::class, 'create'])->name('admin.users.siswa.create');
    Route::post('/users/siswa', [AdminUserController::class, 'store'])->name('admin.users.siswa.store');
    Route::put('/users/siswa/{user}', [AdminUserController::class, 'update'])->name('admin.users.siswa.update');
    Route::delete('/users/siswa/{user}', [AdminUserController::class, 'destroy'])->name('admin.users.siswa.destroy');


    // Users Admin/Guru (CRUD lengkap)
    Route::get('/users/admin', [AdminAdminController::class, 'index'])->name('admin.users.admin');
    Route::get('/users/admin/create', [AdminAdminController::class, 'create'])->name('admin.users.create');
    Route::post('/users/admin', [AdminAdminController::class, 'store'])->name('admin.users.store');
    Route::put('/users/admin/{user}', [AdminAdminController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/admin/{user}', [AdminAdminController::class, 'destroy'])->name('admin.users.destroy');

    // Materials
    Route::get('/materials', [AdminMaterialController::class, 'index'])->name('admin.materials.index');
    Route::get('/materials/create', [AdminMaterialController::class, 'create'])->name('admin.materials.create');
    Route::post('/materials', [AdminMaterialController::class, 'store'])->name('admin.materials.store');
    Route::put('/materials/{material}', [AdminMaterialController::class, 'update'])->name('admin.materials.update');
    Route::delete('/materials/{material}', [AdminMaterialController::class, 'destroy'])->name('admin.materials.destroy');
    
    // Vocabulary
    Route::get('/vocabulary', [AdminVocabularyController::class, 'index'])->name('admin.vocabulary.index');
    Route::get('/vocabulary/create', [AdminVocabularyController::class, 'create'])->name('admin.vocabulary.create');
    Route::post('/vocabulary', [AdminVocabularyController::class, 'store'])->name('admin.vocabulary.store');
    Route::put('/vocabulary/{vocabulary}', [AdminVocabularyController::class, 'update'])->name('admin.vocabulary.update');
    Route::delete('/vocabulary/{vocabulary}', [AdminVocabularyController::class, 'destroy'])->name('admin.vocabulary.destroy');

    // Conversation
    Route::get('/conversations', [AdminConversationController::class, 'index'])->name('admin.conversations.index');
    Route::get('/conversations/create', [AdminConversationController::class, 'create'])->name('admin.conversations.create');
    Route::post('/conversations', [AdminConversationController:: class, 'store'])->name('admin.conversations.store');
    Route::put('/conversations/{conversation}', [AdminConversationController::class, 'update'])->name('admin.conversations.update');
    Route::delete('/conversations/{conversation}', [AdminConversationController::class, 'destroy'])->name('admin.conversations.destroy');

    // Grade
    Route::get('/grades', [AdminGradeController::class, 'index'])->name('admin.grades.index');
    Route::get('/grades/create', [AdminGradeController::class, 'create'])->name('admin.grades.create');
    Route::post('/grades', [AdminGradeController::class, 'store'])->name('admin.grades.store');
    Route::put('/grades/{grade}', [AdminGradeController::class, 'update'])->name('admin.grades.update');
    Route::delete('/grades/{grade}', [AdminGradeController::class, 'destroy'])->name('admin.grades.destroy');

    // Payments
    Route::get('/admin/payments', [AdminPaymentController::class, 'index'])->name('admin.payments.index');
    Route::get('/admin/payments/create', [AdminPaymentController::class, 'create'])->name('admin.payments.create');
    Route::post('/admin/payments', [AdminPaymentController::class, 'store'])->name('admin.payments.store');

    Route::post('/logout', function() {
        Auth::logout();
        return redirect('admin.login'); // atau halaman welcome
    })->name('admin.logout');
    
});

// AUTH ROUTES
require __DIR__.'/auth.php';
