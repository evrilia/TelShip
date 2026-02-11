<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PermohonanController;
use App\Http\Controllers\NotifikasiController;

// Halaman Utama / Login
Route::get('/', function () {
    return view('auth.login');
})->name('login');

// Registrasi Calon Intern
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Registrasi HR/Admin Baru
Route::get('/hr/register', function () {
    return view('auth.registerHR');
})->name('hr.register');
Route::post('/hr/register', [AuthController::class, 'registerHR'])->name('hr.register.post');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {

    Route::get('/notifikasi/{id}/read', [NotifikasiController::class, 'markAsRead'])->name('notif.read');
    // --- GRUP RUTE ADMIN / HR ---
    Route::prefix('hr')->name('hr.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/permohonan', [AdminController::class, 'permohonan'])->name('permohonan');
        Route::get('/permohonan-list', [AdminController::class, 'permohonan'])->name('permohonan.index');
        Route::patch('/permohonan/{id}/status', [AdminController::class, 'updateStatus'])->name('permohonan.status');
        Route::get('/permohonan/{id}/detail', [AdminController::class, 'getDetail'])->name('permohonan.detail');
        Route::get('/admin-profile', [ProfileController::class, 'profile'])->name('profile');
        Route::post('/admin-profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });

    // --- GRUP RUTE INTERN / USER ---
    Route::prefix('intern')->name('intern.')->group(function () {
        Route::get('/dashboard', [InternController::class, 'dashboard'])->name('dashboard');
        Route::get('/status', [InternController::class, 'status'])->name('status');
        Route::get('/pengajuan', [InternController::class, 'pengajuan'])->name('pengajuan');
        Route::post('/pengajuan', [InternController::class, 'storePengajuan'])->name('pengajuan.store'); // Pastikan .store ada
        Route::get('/user-profile', [ProfileController::class, 'profile'])->name('profile');
        Route::post('/user-profile/update', [ProfileController::class, 'update'])->name('profile.update');
    });
});