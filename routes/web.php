<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PesertaController;

// ==========================
// 1. HALAMAN PUBLIK (LOGIN)
// ==========================
// Login Peserta (Halaman Utama)
Route::get('/login', [AuthController::class, 'showPesertaLogin'])->name('login');
Route::post('/login-peserta', [AuthController::class, 'prosesPesertaLogin'])->name('login.peserta.process');

// Login Admin
Route::get('/admin/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'prosesAdminLogin'])->name('admin.login.process');

// Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// ==========================
// 2. AREA KHUSUS PESERTA
// ==========================
Route::middleware(['auth.peserta', 'no.cache'])->group(function () {
    // Dashboard
    Route::get('/', [PesertaController::class, 'dashboard'])->name('peserta.dashboard');

    // Halaman Edit (Formulir)
    Route::get('/edit', [PesertaController::class, 'edit'])->name('peserta.edit'); // <-- Ini yang hilang

    // Proses Simpan (Update)
    Route::post('/simpan', [PesertaController::class, 'update'])->name('peserta.update');

    // page tracking/info pengiriman
    Route::get('/tracking', [PesertaController::class, 'tracking'])->name('peserta.tracking');

    // Route POST untuk memproses simpan
    Route::post('/simpan', [PesertaController::class, 'update'])->name('peserta.update');
});


// ==========================
// 3. AREA KHUSUS ADMIN
// ==========================
Route::prefix('admin')->middleware(['auth.admin'])->group(function () {
    
    // Dashboard Page
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Import Page
    Route::get('/admin/import', [AdminController::class, 'importPage'])->name('admin.import');
    Route::post('/admin/import', [AdminController::class, 'processImport'])->name('admin.import.proses');

    // Edit Data Page (List Semua Peserta)
    Route::get('/admin/data-peserta', [AdminController::class, 'listPeserta'])->name('admin.peserta.list');
    Route::get('/admin/data-peserta/edit/{no_ukg}', [AdminController::class, 'editPeserta'])->name('admin.peserta.edit');
    Route::post('/admin/data-peserta/update/{no_ukg}', [AdminController::class, 'updatePeserta'])->name('admin.peserta.update');

});


Route::middleware(['auth.peserta'])->group(function () {
    
    // 1. Dashboard
    Route::get('/', [PesertaController::class, 'dashboard'])->name('peserta.dashboard');

    // 2. TAMBAHKAN INI: Halaman Edit (Formulir)
    Route::get('/edit', [PesertaController::class, 'edit'])->name('peserta.edit'); // <-- Ini yang hilang

    // 3. Proses Simpan (Update)
    Route::post('/simpan', [PesertaController::class, 'update'])->name('peserta.update');
});