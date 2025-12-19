<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta; // Model Peserta
use App\Models\Admin;   // Model Admin
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash; // Penting jika password admin di-hash

class AuthController extends Controller
{
    // ==========================================
    // 1. BAGIAN PESERTA (No UKG & Tanggal Lahir)
    // ==========================================

    // Tampilkan Form Login Peserta
    public function showPesertaLogin()
    {
        return view('peserta.login-peserta');
    }

    // Proses Login Peserta
    public function prosesPesertaLogin(Request $request)
{
    $request->validate([
        'no_ukg' => 'required|numeric',
        'tanggal_lahir' => 'required|date',
    ]);

    $peserta = Peserta::where('no_ukg', $request->no_ukg)
                      ->where('tanggal_lahir', $request->tanggal_lahir)
                      ->first();

    if ($peserta) {
        // --- KONDISI LULUS ---
        Session::put('peserta_logged_in', true);
        Session::put('peserta_data', $peserta);

        // Arahkan ke Dashboard (resources/views/peserta/index.blade.php)
        return redirect()->route('peserta.dashboard');
    } 
    
    // --- KONDISI TIDAK LULUS ---
    // Jangan redirect back(), tapi tampilkan halaman Tidak Lulus
    return view('peserta.tidak-lulus', [
        'no_ukg' => $request->no_ukg
    ]);
}

    // ==========================================
    // 2. BAGIAN ADMIN (Username & Password)
    // ==========================================

    // Tampilkan Form Login Admin
    public function showAdminLogin()
    {
        return view('admin.login-admin');
    }

    // Proses Login Admin
    public function prosesAdminLogin(Request $request)
    {
        // 1. Validasi
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 2. Cari Admin di Database
        $admin = Admin::where('username', $request->username)->first();

        // 3. Cek Password
        // CATATAN PENTING:
        // Jika di database password Anda PLAIN TEXT (belum dienkripsi), pakai cara A.
        // Jika di database password Anda BCRYPT (standar Laravel), pakai cara B.
        
        // CARA A (Plain Text - Sesuai Native PHP biasanya):
        if ($admin && $admin->password === $request->password) {
            
        // CARA B (Jika nanti Anda mau migrasi ke enkripsi aman):
        // if ($admin && Hash::check($request->password, $admin->password)) {

            // Simpan session khusus admin
            Session::put('admin_logged_in', true);
            Session::put('admin_data', $admin);

            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Username atau Password salah.');
    }

    // ==========================================
    // 3. LOGOUT (Umum)
    // ==========================================
    public function logout()
    {
        // Hapus semua session
        Session::flush();
        
        // Kembali ke halaman depan (Login Peserta)
        return redirect()->route('login')->with('message', 'Anda telah logout.');
    }
}