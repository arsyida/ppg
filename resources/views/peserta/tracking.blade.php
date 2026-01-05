@extends('layouts.app')

@section('title', 'Status Pengiriman Sertifikat')

@section('content')

<div class="d-flex" id="wrapper">
    <div id="page-content-wrapper">
        <div class="container-fluid p-4 p-md-5">
            
            <h2 class="h2 mb-4 fw-bold text-dark">Status Pengiriman Sertifikat</h2>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card shadow-sm border-0 mb-4" style="border-radius: var(--radius-lg);">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-4">
                                <div class="flex-shrink-0">
                                    <div class="bg-light p-3 rounded-circle text-primary-custom">
                                        <i class="bi bi-truck fs-3"></i>
                                    </div>
                                </div>
                                <div class="ms-3">
                                    <h5 class="fw-bold mb-1">Sedang Dalam Proses Pengiriman</h5>
                                    <p class="text-muted mb-0 small">Sertifikat Pendidikan Profesi Guru (PPG)</p>
                                </div>
                            </div>

                            <hr class="border-light">

                            <div class="timeline-static">
                                <div class="timeline-item active">
                                    <h6 class="fw-bold text-primary-custom">Paket Keluar dari Hub Asal</h6>
                                    <p class="text-muted small mb-0">Lokasi: Bandar Lampung, Lampung</p>
                                    <small class="text-muted">Status Terkini</small>
                                </div>
                                <div class="timeline-item">
                                    <h6 class="fw-bold text-secondary">Diproses oleh Panitia</h6>
                                    <p class="text-muted small mb-0">Sekretariat PPG FKIP Universitas Lampung</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm border-0" style="border-radius: var(--radius-lg);">
                        <div class="card-header bg-white border-0 py-3">
                            <h6 class="fw-bold mb-0"><i class="bi bi-person-lines-fill me-2"></i> Detail Penerima</h6>
                        </div>
                        <div class="card-body px-4 pb-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Nama Penerima</small>
                                    {{-- Menggunakan Syntax Blade & Object Access --}}
                                    <span class="fw-semibold">{{ $peserta->nama_peserta ?? '-' }}</span>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted d-block">Nomor UKG</small>
                                    {{-- Menggunakan Syntax Blade & Object Access --}}
                                    <span class="font-monospace">{{ $peserta->no_ukg ?? '-' }}</span>
                                </div>
                                <div class="col-12">
                                    <small class="text-muted d-block">Alamat Tujuan (Sesuai Data)</small>
                                    {{-- Menggunakan Syntax Blade & Object Access --}}
                                    <span>{{ $peserta->alamat_lengkap ?? 'Alamat belum dilengkapi' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <div class="card border-0 bg-primary text-white shadow-sm" style="background-color: var(--primary-color) !important; border-radius: var(--radius-lg);">
                        <div class="card-body p-4 text-center">
                            <i class="bi bi-info-circle fs-1 mb-3 text-white-50"></i>
                            <h5 class="fw-bold">Informasi</h5>
                            <p class="small opacity-75">
                                Pengiriman dilakukan secara bertahap dari Bandar Lampung. Pastikan nomor HP Anda aktif agar kurir dapat menghubungi saat pengantaran.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection