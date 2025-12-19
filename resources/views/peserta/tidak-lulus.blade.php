<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kelulusan - Tidak Lulus</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
    
    <div class="result-wrapper d-flex align-items-center min-vh-100 justify-content-center bg-light">
        <div class="container">
            <div class="card result-card shadow-lg border-0 overflow-hidden">
                <div class="row g-0">
                    <div class="col-lg-6 d-none d-md-flex illustration-panel align-items-center justify-content-center" 
                         style="background-color: #FFF0F0;">
                        <div class="text-center">
                            <img src="{{ asset('assets/images/try-again.svg') }}" alt="Belum Lulus" class="img-fluid mb-3" style="max-height: 300px;">
                            <h3 class="text-danger fw-bold">Mohon Maaf</h3>
                        </div>
                    </div>

                    <div class="col-lg-6 d-flex align-items-center">
                        <div class="result-panel text-center w-100 p-5">
                            <h2 class="text-danger fw-bold mb-3">Mohon Maaf</h2>
                            <p class="text-muted mb-4">
                                Anda dinyatakan tidak lulus dalam Program PPG FKIP Universitas Lampung. 
                                Jangan berkecil hati dan tetap semangat untuk kesempatan berikutnya!
                            </p>
                            
                            <h4 class="fw-semibold mb-3">{{ $no_ukg }}</h4>
                            
                            <div class="mt-4">
                                <a href="{{ route('login') }}" class="btn btn-primary px-4">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>