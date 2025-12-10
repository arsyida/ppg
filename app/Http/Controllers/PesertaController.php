<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Peserta; // Panggil Model tadi
use Illuminate\Support\Facades\Storage; // Untuk upload file

class PesertaController extends Controller
{
    // 1. Menampilkan Halaman Form
    public function edit()
    {
        // Anggap user ID 1 sedang login (Nanti diganti Auth::user())
        $peserta = Peserta::where('no_ukg', '1234567890')->first(); 
        
        return view('peserta.edit', compact('peserta'));
    }

    // 2. Memproses Update Data
    public function update(Request $request)
    {
        // A. Validasi (Pengganti if empty...)
        $validated = $request->validate([
            'nama_peserta' => 'required|string',
            'nik' => 'required|numeric',
            'pas_foto' => 'nullable|image|max:1024|mimes:jpg,png', // Max 1MB
            // ... tambahkan validasi lain
        ]);

        // Ambil data peserta
        $peserta = Peserta::where('no_ukg', '1234567890')->first();

        // B. Logika Upload Foto
        if ($request->hasFile('pas_foto')) {
            // Laravel otomatis mengatur nama unik & folder
            $path = $request->file('pas_foto')->store('uploads/2025/10', 'public');
            $validated['pas_foto'] = $path;
        }

        // C. Update Database
        $peserta->update($validated);

        // D. Redirect dengan Pesan Sukses
        return back()->with('message', 'Sukses: Data berhasil diperbarui!');
    }
}