<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    // Beritahu Laravel nama tabel asli Anda
    protected $table = 'peserta_lulus_ppg';
    
    // Tentukan kolom mana saja yang boleh diisi (Mass Assignment)
    protected $fillable = [
        'nama_peserta', 'nik', 'no_hp', 'tempat_lahir', 
        'tanggal_lahir', 'nim', 'jenis_ppg', 'alamat_lengkap', 'pas_foto', 'nama_bidang_studi'
    ];

    // Jika tabel Anda tidak punya kolom created_at & updated_at, matikan ini:
    public $timestamps = false;
}
