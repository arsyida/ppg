<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta; // Panggil Model tadi
use Illuminate\Support\Facades\Storage; // Untuk upload file

class PesertaController extends Controller
{
    public function dashboard()
    {
        // Ambil data peserta dari session (yang diset saat login di AuthController)
        $peserta = session('peserta_data');

        // Jika session expired/hilang, kembalikan ke login
        if (!$peserta) {
            return redirect()->route('login')->with('error', 'Sesi habis, silakan login ulang.');
        }

        // Tampilkan halaman index (dashboard peserta)
        return view('peserta.dashboard', compact('peserta'));
    }
    
    // 1. Menampilkan Halaman Form
    public function edit()
    {
        // Ambil data dari session login
        $peserta = session('peserta_data');

        // Cek keamanan: Jika session hilang, tendang ke login
        if (!$peserta) {
            return redirect()->route('login')->with('error', 'Sesi habis, login ulang.');
        }

        // Tampilkan view edit (pastikan file resources/views/peserta/edit.blade.php sudah ada)
        return view('peserta.edit', compact('peserta'));
    }

    // 2. Memproses Update Data
    public function update(Request $request)
{
    // 1. Ambil Session
    $sessionPeserta = session('peserta_data');

    // Cek Session
    if (!$sessionPeserta) {
        return redirect()->route('login')->with('error', 'Sesi habis, silakan login ulang.');
    }

    $validated = $request->validate([
        'nama_peserta'      => 'required|string|max:100',
        'nik'               => 'required|string|max:20',
        'no_hp'             => 'required|string|max:20',
        'tempat_lahir'      => 'required|string|max:100',
        'tanggal_lahir'     => 'required|date',
        'nim'               => 'required|string|max:20',
        'alamat_lengkap'    => 'required|string',
        'nama_bidang_studi' => 'required|string|max:100',
        'jenis_ppg'         => 'required|in:CALON GURU,GURU TERTENTU',
        'pas_foto'          => 'nullable|image|max:1024|mimes:jpg,jpeg,png', 
    ]);

    // Pastikan no_ukg dibersihkan dari spasi (trim)
    $no_ukg_target = trim($sessionPeserta->no_ukg);
    
    // Debugging: Jika error, uncomment baris bawah ini untuk cek isi no_ukg
    // dd($no_ukg_target); 

    $peserta = Peserta::where('no_ukg', $no_ukg_target)->first();

    // Jika data tidak ditemukan di database
    if (!$peserta) {
        return back()->with('error', 'Data peserta tidak ditemukan di Database. Pastikan No UKG Session valid.');
    }

    // 4. Logika Upload Foto
    if ($request->hasFile('pas_foto')) {
        // Hapus foto lama jika ada
        if ($peserta->pas_foto && \Illuminate\Support\Facades\Storage::disk('public')->exists($peserta->pas_foto)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($peserta->pas_foto);
        }

        // Simpan foto baru
        $path = $request->file('pas_foto')->store('uploads/' . date('Y/m'), 'public');
        $validated['pas_foto'] = $path;
    }

    // 5. Update
    $peserta->update($validated);

    // 6. Perbarui Session dengan data terbaru dari DB
    session(['peserta_data' => $peserta]);

    return redirect()->route('peserta.dashboard')->with('message', 'Sukses: Data berhasil diperbarui.');
}

    public function tracking()
    {
        // Ambil data session
        $peserta = session('peserta_data');
    
        // Cek keamanan
        if (!$peserta) {
            return redirect()->route('login')->with('error', 'Sesi habis, login ulang.');
        }
    
        // Tampilkan view
        return view('peserta.tracking', compact('peserta'));
    }
}