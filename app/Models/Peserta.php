<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    // Beritahu Laravel nama tabel asli Anda
    protected $table = 'peserta_lulus_ppg';
    
    // 2. TIMESTAMPS FALSE (Karena tabel tidak punya created_at & updated_at)
    public $timestamps = false;

    // Tentukan kolom mana saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama_peserta', 'nik', 'no_hp', 'tempat_lahir', 
        'tanggal_lahir', 'nim', 'jenis_ppg', 'alamat_lengkap', 'pas_foto', 'nama_bidang_studi', 'no_ukg'
    ];
}
