<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesertaController;

// ==========================
// 1. HALAMAN PUBLIK (LOGIN)
// ==========================
// Login Peserta (Halaman Utama)
Route::get('/', [AuthController::class, 'showPesertaLogin'])->name('login');
Route::post('/login-peserta', [AuthController::class, 'prosesPesertaLogin'])->name('login.peserta.process');

// Login Admin
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'prosesAdminLogin'])->name('admin.login.process');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================
// 2. AREA KHUSUS PESERTA
// ==========================
Route::middleware(['auth.peserta'])->group(function () {
    // Halaman Index (Perbaikan Data)
    Route::get('/portal', [PesertaController::class, 'index'])->name('peserta.index');
    Route::post('/portal/simpan', [PesertaController::class, 'update'])->name('peserta.update');
});


// ==========================
// 3. AREA KHUSUS ADMIN
// ==========================
Route::prefix('admin')->middleware(['auth.admin'])->group(function () {
    
    // Dashboard Page
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Import Page
    Route::get('/import', [AdminController::class, 'importPage'])->name('admin.import');
    Route::post('/import', [AdminController::class, 'processImport'])->name('admin.import.proses');
    
    // Edit Data Page (List Semua Peserta)
    Route::get('/data-peserta', [AdminController::class, 'listPeserta'])->name('admin.peserta.list');
    Route::get('/data-peserta/edit/{no_ukg}', [AdminController::class, 'editPeserta'])->name('admin.peserta.edit');
    Route::post('/data-peserta/update/{no_ukg}', [AdminController::class, 'updatePeserta'])->name('admin.peserta.update');

});
