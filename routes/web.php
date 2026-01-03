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
Route::post('/login', [AuthController::class, 'prosesPesertaLogin'])->name('login.peserta.process');

// Login Admin
Route::prefix('admin')->get('/login', [AuthController::class, 'showAdminLogin'])->name('admin.login');
Route::prefix('admin')->post('/login', [AuthController::class, 'prosesAdminLogin'])->name('login.admin.process');

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
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Import Page
    Route::get('import', [AdminController::class, 'importPage'])->name('admin.import');
    Route::post('import', [AdminController::class, 'processImport'])->name('admin.import.proses');

    // Route Export Excel
    Route::get('/export', [AdminController::class, 'exportExcel'])->name('admin.export');

    // Route untuk Halaman Edit
    Route::get('/data-peserta/edit/{no_ukg}', [AdminController::class, 'editPeserta'])->name('admin.peserta.edit');

    // Route untuk Proses Update (POST/PUT)
    Route::put('/data-peserta/update/{no_ukg}', [AdminController::class, 'updatePeserta'])->name('admin.peserta.update');

});