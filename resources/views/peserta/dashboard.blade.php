@extends('layouts.app')

@section('title', 'Hasil Kelulusan PPG')

@section('content')
    
    <div class="d-flex" id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid p-4 p-md-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="h2 mb-3 fw-bold text-success">Selamat Anda Dinyatakan Lulus UKPPG 2025</h1>
                        <p class="fs-6 text-muted">Silahkan periksa kesesuaian data dengan ijazah S1 anda dan isi data yang belum lengkap untuk keperluan pengiriman sertifikat.</p>
                        <a href="{{ route('peserta.edit') }}" class="btn btn-primary shadow-sm px-4 py-2 mb-4">
                            Perbarui Data
                        </a>
                        
                        <hr class="my-4">

                        <div class="card shadow-sm border-0" style="border-radius: var(--radius-lg);">
                            <div class="card-body p-4 p-md-5">
                                <div class="row">
                                    <div class="col-md-4 d-flex align-items-start justify-content-center mt-4 mt-md-0">
                                        <div class="pas-foto-placeholder">
                                            <?php if (!empty($peserta['pas_foto'])): ?>
                                                <img src="uploads/<?= htmlspecialchars($peserta['pas_foto']) ?>" 
                                                     alt="Pas Foto Peserta" 
                                                     style="width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius-md);">
                                            <?php else: ?>
                                                Pas foto<br>3 x 4
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        
                                        <h2 class="display-6 fw-bold mb-1" style="color: var(--primary-color);">
                                            {{ $peserta->nama_peserta }}
                                        </h2>
                                        <h4 class="text-secondary fw-normal mb-4">
                                            {{ $peserta->nama_bidang_studi ?? '-' }}
                                        </h4>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <strong class="d-block text-secondary small">No. UKG</strong>
                                                <span class="text-dark"> {{ $peserta['no_ukg'] ?? '-'}}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="d-block text-secondary small">NIK</strong>
                                                <span  class="text-dark">{{ $peserta['nik'] ?? '-' }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="d-block text-secondary small">NIM</strong>
                                                <span class="text-dark">{{ $peserta['nim'] ?? '-' }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="d-block text-secondary small">Jenis PPG</strong>
                                                <span class="text-dark">{{ $peserta['jenis_ppg'] ?? '-' }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="d-block text-secondary small">Tempat Lahir</strong>
                                                <span class="text-dark">{{ $peserta['tempat_lahir'] ?? '-' }}</span>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <strong class="d-block text-secondary small">Tanggal Lahir</strong>
                                                <span class="text-dark">{{ date('d-m-Y', strtotime($peserta['tanggal_lahir'] ?? '-')) }}</span>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <strong class="d-block text-secondary small">No. HP</strong>
                                                <span class="text-dark">{{$peserta['no_hp'] ?? 'Belum diperbarui'}}</span>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <strong class="d-block text-secondary small">Alamat Lengkap</strong>
                                                <span class="text-dark">{{$peserta['alamat_lengkap'] ?? 'Belum diperbarui'}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection