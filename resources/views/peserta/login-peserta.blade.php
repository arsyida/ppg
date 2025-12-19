@extends('layouts.app')

@section('title', 'Login Peserta PPG FKIP UNILA')

@section('content')

<div class="login-wrapper">
        <div class="card login-card shadow-lg">
            <div class="row g-0">
                <!-- Sisi Kiri: Ilustrasi -->
                <div class="col-lg-6 d-none d-md-flex illustration-panel">
                    <div>
                        <img src="{{ asset('assets/images/login-ilustration.svg') }}" alt="Illustration">
                        <h3>Cek Kelulusan PPG</h3>
                        <p class="text-muted px-4">FKIP Universitas Lampung</p>
                    </div>
                </div>
                <!-- Sisi Kanan: Form -->
                <div class="col-lg-6">
                    <div class="form-panel">
                        <div class="mb-5">
                            <h2>Selamat Datang</h2>
                            <p>Silakan masukkan nomor UKG dan tanggal lahir.</p>
                        </div>

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                    
                        <form method="POST" action="{{ route('login.peserta.process') }}">
                            @csrf <div class="mb-3">
                                <label for="no_ukg" class="form-label fw-medium">No UKG</label>
                                <input type="text" class="form-control" id="no_ukg" name="no_ukg" required placeholder="Masukkan No UKG Anda">
                            </div>
                            <div class="mb-4">
                                <label for="tanggal_lahir" class="form-label fw-medium">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-primary">Cek Hasil</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection