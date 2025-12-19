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
                                    <div class="col-md-8">
                                        
                                        <h2 class="display-6 fw-bold mb-3" style="color: var(--primary-color);">
                                            {{ $peserta->nama_peserta }}
                                        </h2>
                                        <h4 class="text-secondary fw-normal mb-5">
                                            {{ $peserta->nama_bidang_studi ?? '-' }}
                                        </h4>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <strong class="d-block text-muted small">Tempat Lahir</strong>
                                                <span><?= htmlspecialchars($peserta['tempat_lahir'] ?? '-', ENT_QUOTES) ?></span>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <strong class="d-block text-muted small">NIM</strong>
                                                <span><?= htmlspecialchars($peserta['nim'] ?? '-', ENT_QUOTES) ?></span> </div>
                                            <div class="col-md-6 mb-3">
                                                <strong class="d-block text-muted small">Tanggal Lahir</strong>
                                                <span><?= htmlspecialchars(date('d/m/Y', strtotime($peserta['tanggal_lahir'] ?? '-')), ENT_QUOTES) ?></span>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <strong class="d-block text-muted small">NIK</strong>
                                                <span><?= htmlspecialchars($peserta['nik'] ?? '-', ENT_QUOTES) ?></span> </div>
                                            <div class="col-md-6 mb-3">
                                                <strong class="d-block text-muted small">Jenis PPG</strong>
                                                <span><?= htmlspecialchars($peserta['jenis_ppg'] ?? '-', ENT_QUOTES) ?></span> </div>
                                            <div class="col-md-6 mb-3">
                                                <strong class="d-block text-muted small">No. UKG</strong>
                                                <span><?= htmlspecialchars($peserta['no_ukg'] ?? '-', ENT_QUOTES) ?></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-center justify-content-center mt-4 mt-md-0">
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection