@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    <div class="d-flex" id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid p-1 p-md-4">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h2 fw-bold mb-0">Import Data Peserta</h1>
                </div>
                {{-- Flash Message --}}
                @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if(session(key: 'error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h5 class="card-title">Upload File Excel</h5>
                        <p class="card-text">Pilih file Excel (.xlsx atau .xls) yang berisi data peserta. Data akan
                            diperbarui secara otomatis jika No UKG sudah ada.</p>

                        <form method="POST" action="{{ route('admin.import.proses') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="file_excel" class="form-label">File Excel</label>
                                <input class="form-control" type="file" id="file_excel" name="file_excel" required
                                    accept=".xls, .xlsx">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-upload me-2"></i>Upload dan Proses
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mt-4">
                    <div class="card-body p-4">
                        <h5 class="card-title">Petunjuk Format File Excel</h5>
                        <p>Pastikan file Excel Anda memiliki format kolom sebagai berikut (baris pertama adalah header):</p>
                        <p class="text-sm">*Buat header saja dan kosongkan isinya jika ada data yang belum tersedia</p>
                        <ul class="list-group">
                            <li class="list-group-item"><b>Kolom A:</b> no_ukg</li>
                            <li class="list-group-item"><b>Kolom B:</b> nama_peserta</li>
                            <li class="list-group-item"><b>Kolom C:</b> nik</li>
                            <li class="list-group-item"><b>Kolom D:</b> nim</li>
                            <li class="list-group-item"><b>Kolom E:</b> tempat_lahir</li>
                            <li class="list-group-item"><b>Kolom F:</b> tanggal_lahir (Format: YYYY-MM-DD)</li>
                            <li class="list-group-item"><b>Kolom G:</b> nama_bidang_studi</li>
                            <li class="list-group-item"><b>Kolom H:</b> jenis_ppg (CALON GURU / GURU TERTENTU)</li>
                            <li class="list-group-item"><b>Kolom I:</b> no_hp</li>
                            <li class="list-group-item"><b>Kolom J:</b> alamat_lengkap</li>
                            <li class="list-group-item"><b>Kolom K:</b> pas_foto</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection