<?php
// Start session with secure settings at the very top
session_start([
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
    'cookie_secure' => true, // only if HTTPS
    'use_strict_mode' => true,
]);

// Generate CSRF token if not exists
if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Kelulusan PPG</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- custom CSS -->
     <link rel="stylesheet" href="assets/css/style.css">
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="login-wrapper">
        <div class="card login-card shadow-lg">
            <div class="row g-0">
                <!-- Sisi Kiri: Ilustrasi -->
                <div class="col-lg-6 d-none d-md-flex illustration-panel">
                    <div>
                        <img src="assets/images/login-ilustration.svg" alt="Illustration">
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
                    
                        <form method="POST" action="/ppg/index.php">
                            <input type="hidden" name="csrf" value="<?= htmlspecialchars($_SESSION['csrf'], ENT_QUOTES | ENT_SUBSTITUTE) ?>">
                            <div class="mb-3">
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
</body>
</html>