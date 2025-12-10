<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'admin'; // Nama tabel manual
    protected $primaryKey = 'id'; // Asumsi primary key
    public $timestamps = false; // Matikan jika tidak ada created_at
    protected $fillable = ['username', 'password', 'nama']; // Kolom yang boleh diisi
}