@extends('layouts.app')  

@section('title', 'Perbaikan Data Peserta')

@section('content')

    <div class="d-flex" id="wrapper">

        <div id="page-content-wrapper">
            <div class="container-fluid pb-5 p-md-5">

            {{-- Flash Message --}}
            @if(session('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

                <h1 class="h2 mb-4 fw-bold">Perbaikan Data Sertifikat Pendidik</h1>
                
                <div class="card shadow-sm border-0" style="border-radius: var(--radius-lg);">
                    <div class="card-body p-4 p-md-5">
                        
                        <form method="POST" action="{{ route('peserta.update') }}" enctype="multipart/form-data">
                           
                            @csrf

                            <div class="row">
                                <div class="col-md-5 col-lg-4">
                                    <label class="form-label fw-medium">Pas Foto</label>
                                    <div class="pas-foto-placeholder mb-2">
                                        @if ($peserta->pas_foto)
                                        <img src="{{ asset('storage/' . $peserta->pas_foto) }}" 
                                             alt="Pas Foto" 
                                             style="width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius-md);">
                                        @else
                                            <div>Pas foto<br>3 x 4</div>
                                        @endif
                                    </div>
                                    <input type="file" 
                                        class="form-control @error('pas_foto') is-invalid @enderror" 
                                        id="pas_foto" 
                                        name="pas_foto" 
                                        accept="image/jpeg, image/png, image/jpg"

                                        {{-- Logika: Jika di database kolom pas_foto kosong, maka tambahkan atribut 'required' --}}
                                        @required(!$peserta->pas_foto)>

                                        @error('pas_foto')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    <small class="form-text text-muted">Upload pas foto dengan background merah (format .jpg/.png).</small>
                                    
                                    <div class="mt-4">
                                        <label for="no_ukg" class="form-label fw-medium">No UKG</label>
                                        <input type="text" 
                                            class="form-control" 
                                            value="{{ $peserta->no_ukg }}" 
                                            disabled>
                                    </div>

                                    <div class="mt-4">
                                        <label for="nama_bidang_studi" class="form-label fw-medium">Bidang Studi <span class="text-danger">*</span></label>
                                        <input type="text" 
                                            class="form-control" 
                                            id="nama_bidang_studi" 
                                            name="nama_bidang_studi"
                                            value="{{ $peserta->nama_bidang_studi ?? '-' }}" 
                                            required>
                                    </div>
                                </div>
                                
                                <div class="col-md-7 col-lg-8 mt-3 mt-md-0">
                                    <div class="row">
                                        <div class="mt-lg-0">
                                        <label for="nama_peserta" class="form-label fw-medium">Nama Lengkap <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control" 
                                               id="nama_peserta" 
                                               name="nama_peserta" 
                                               value="{{ old('nama_peserta', $peserta->nama_peserta) }}" 
                                               required>
                                        </div>

                                        <div class="col-lg-6 mt-3">
                                            <label for="nik" class="form-label fw-medium">NIK <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   name="nik" 
                                                   class="form-control" 
                                                   value="{{ old('nik', $peserta->nik) }}"

                                                   {{-- Ubah keyboard di HP jadi angka --}}
                                                   inputmode="numeric" 

                                                   {{-- Script PENCEGAH HURUF (Hanya terima angka 0-9) --}}
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"

                                                   placeholder="Masukkan NIK Anda"
                                                   required>
                                        </div>

                                        <div class="col-lg-6 mt-3">
                                            <label for="no_hp" class="form-label fw-medium">No HP <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   name="no_hp" 
                                                   class="form-control" 
                                                   value="{{ old('no_hp', $peserta->no_hp) }}"

                                                   {{-- Ubah keyboard di HP jadi angka --}}
                                                   inputmode="numeric" 

                                                   {{-- Script PENCEGAH HURUF (Hanya terima angka 0-9) --}}
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"

                                                   placeholder="Masukkan No HP Anda"
                                                   required>
                                        </div>

                                        <div class="col-lg-6 mt-3">
                                            <label for="tempat_lahir" class="form-label fw-medium">Tempat Lahir <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" 
                                               value="{{ old('tempat_lahir', $peserta->tempat_lahir) }}" required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <label for="tanggal_lahir" class="form-label fw-medium">Tanggal Lahir <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" 
                                               value="{{ old('tanggal_lahir', $peserta->tanggal_lahir) }}" required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <label for="nim" class="form-label fw-medium">NIM <span class="text-danger">*</span></label>
                                            <input type="text" 
                                                   name="nim" 
                                                   class="form-control" 
                                                   value="{{ old('nim', $peserta->nim) }}"

                                                   {{-- Ubah keyboard di HP jadi angka --}}
                                                   inputmode="numeric" 

                                                   {{-- Script PENCEGAH HURUF (Hanya terima angka 0-9) --}}
                                                   oninput="this.value = this.value.replace(/[^0-9]/g, '')"

                                                   placeholder="Masukkan NIM Anda"
                                                   required>
                                        </div>

                                        <div class="col-lg-6 mt-3">
                                            <label for="jenis_ppg" class="form-label fw-medium">Jenis PPG</Label>
                                            <input type="text" class="form-control" value="{{ $peserta->jenis_ppg }}" disabled>
                                        </div>

                                        <div class="col-12 mt-3">
                                            <label for="alamat_lengkap" class="form-label fw-medium">Alamat Lengkap <span class="text-danger">*</span></label>
                                            <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="7" placeholder="Silahkan masukan alamat lengkap seperti Jalan, RT RW, Desa, Kecamatan, Kabupaten, Provinsi, Kode pos" required>{{ old('alamat_lengkap', $peserta->alamat_lengkap) }}</textarea>
                                            <p class="text-danger"><small>*Alamat ini akan digunakan untuk pengiriman sertifikat pendidik.</small></p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 text-end mt-4 pt-4 border-top">
                                    <button type="submit" class="btn btn-primary px-4 py-2">Simpan Perubahan</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>

            </div>
        </div>
        </div>
@endsection