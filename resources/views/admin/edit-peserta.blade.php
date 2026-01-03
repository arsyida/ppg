@extends('layouts.app')

@section('title', 'Edit Peserta')

@section('content')

{{-- Container fluid padding menyesuaikan kode asli --}}
<div class="container-fluid p-4 p-md-5">
    <h1 class="h2 mb-4 fw-bold">Edit Data: {{ $peserta->nama_peserta }}</h1>

    {{-- Tampilkan Error jika ada --}}
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-4 p-md-5">
            {{-- Form Action mengarah ke route update --}}
            <form method="POST" action="{{ route('admin.peserta.update', $peserta->no_ukg) }}">
                @csrf
                @method('PUT') {{-- Metode update di Laravel sebaiknya menggunakan PUT --}}

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nama_peserta" class="form-label fw-medium">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" 
                               value="{{ old('nama_peserta', $peserta->nama_peserta) }}" required>
                    </div>
                    
                    <div class="col-lg-6 mb-3">
                        <label for="tempat_lahir" class="form-label fw-medium">Tempat Lahir</label>
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" 
                               value="{{ old('tempat_lahir', $peserta->tempat_lahir) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="no_ukg" class="form-label fw-medium">No UKG</label>
                        {{-- Hati-hati mengubah primary key/identifier --}}
                        <input type="text" class="form-control" id="no_ukg" name="no_ukg" 
                               value="{{ old('no_ukg', $peserta->no_ukg) }}" required>
                    </div>
                    
                    <div class="col-lg-6 mb-3">
                        <label for="tanggal_lahir" class="form-label fw-medium">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
                               value="{{ old('tanggal_lahir', $peserta->tanggal_lahir) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nik" class="form-label fw-medium">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" 
                               value="{{ old('nik', $peserta->nik) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="nim" class="form-label fw-medium">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" 
                               value="{{ old('nim', $peserta->nim) }}" required>
                    </div>
                    
                    <div class="col-lg-6 mb-3">
                        <label for="nama_bidang_studi" class="form-label fw-medium">Bidang Studi</label>
                        <input type="text" class="form-control" id="nama_bidang_studi" name="nama_bidang_studi" 
                               value="{{ old('nama_bidang_studi', $peserta->nama_bidang_studi) }}" required>
                    </div>
                    
                    <div class="col-lg-6 mb-3">
                        <label for="jenis_ppg" class="form-label fw-medium">Jenis PPG</label>
                        <input type="text" class="form-control" id="jenis_ppg" name="jenis_ppg" 
                               value="{{ old('jenis_ppg', $peserta->jenis_ppg) }}" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="no_hp" class="form-label fw-medium">No HP</label>
                        <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" 
                               value="{{ old('no_hp', $peserta->no_hp) }}">
                        @error('no_hp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <label for="alamat_lengkap" class="form-label fw-medium">Alamat Lengkap</label>
                        <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="4">{{ old('alamat_lengkap', $peserta->alamat_lengkap) }}</textarea>
                    </div>
                    
                    <div class="col-12 text-end mt-4">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection