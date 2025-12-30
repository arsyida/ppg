<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin; // Panggil Model 
use Illuminate\Support\Facades\Storage; // Untuk upload file


class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil data admin dari session (yang diset saat login di AuthController)
        $admin = session('admin_data');

        // Jika session expired/hilang, kembalikan ke login
        if (!$admin) {
            return redirect()->route('admin.login')->with('error', 'Sesi habis, silakan login ulang.');
        }

        // Tampilkan halaman index (dashboard admin)
        return view('admin.dashboard', compact('admin'));
    }
}
