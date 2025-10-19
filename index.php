<?php
// Enable error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session at the very top
session_start();

// Include DB connection
require 'db.php';

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header("Location: login.php");
    exit('Method not allowed.');
}

// Check CSRF token safely
if (!isset($_POST['csrf'], $_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], $_POST['csrf'])) {
    http_response_code(403);
    exit('Invalid CSRF token.');
}

// Validate inputs
$no_ukg = trim($_POST['no_ukg'] ?? '');
$tanggal_lahir = trim($_POST['tanggal_lahir'] ?? '');

if (!preg_match('/^[0-9]{6,20}$/', $no_ukg)) {
    exit('Invalid Nomor UKG.');
}

$date = DateTime::createFromFormat('Y-m-d', $tanggal_lahir);
if (!$date || $date->format('Y-m-d') !== $tanggal_lahir) {
    exit('Invalid Tanggal Lahir.');
}

// Prepare SQL query
try {
    $stmt = $pdo->prepare(
        'SELECT no_ukg, nik, nim, nama_peserta, tempat_lahir, tanggal_lahir, nama_bidang_studi, jenis_ppg
         FROM peserta_lulus_ppg
         WHERE no_ukg = ? AND tanggal_lahir = ?
         LIMIT 1'
    );
    $stmt->execute([$no_ukg, $tanggal_lahir]);
    $peserta = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('Database error: ' . $e->getMessage());
    http_response_code(500);
    exit('Internal Server Error.');
}

$status = $peserta ? 'LULUS' : 'TIDAK LULUS';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kelulusan PPG</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="result-wrapper">
        <div class="card result-card">
            <div class="row g-0">
                <!-- Kolom kiri: Ilustrasi -->
                <div class="col-lg-6 d-none d-md-flex illustration-panel">
                    <img src="assets/images/<?= $status === 'LULUS' ? 'congrats.svg' : 'try-again.svg' ?>" 
                         alt="<?= $status === 'LULUS' ? 'Selamat Lulus' : 'Belum Lulus' ?>" 
                         class="img-fluid"> 
                </div>

                <!-- Kolom kanan: Hasil -->
                <div class="col-lg-6 d-flex align-items-center">
                    <div class="result-panel text-center w-100 p-5">
                        <?php if ($status === 'LULUS'): ?>
                            <h2 class="text-success fw-bold mb-3">Selamat!</h2>
                            <p class="text-muted mb-4">Anda dinyatakan <strong>LULUS</strong> dalam Program PPG FKIP Universitas Lampung.</p>
                            <h4 class="fw-semibold mb-3">
                                <?= htmlspecialchars($peserta['nama_peserta'] ?? '-', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>
                            </h4>

                            <!-- Detail Peserta -->
                            <div class="text-start mx-auto" style="max-width: 400px;">
                                <table class="table table-borderless small">
                                    <tr><td><strong>No. UKG</strong></td><td>: <?= htmlspecialchars($peserta['no_ukg'] ?? '-', ENT_QUOTES) ?></td></tr>
                                    <tr><td><strong>NIK</strong></td><td>: <?= htmlspecialchars($peserta['nik'] ?? '-', ENT_QUOTES) ?></td></tr>
                                    <tr><td><strong>NIM</strong></td><td>: <?= htmlspecialchars($peserta['nim'] ?? '-', ENT_QUOTES) ?></td></tr>
                                    <tr><td><strong>Tempat, Tanggal Lahir</strong></td><td>: <?= htmlspecialchars(($peserta['tempat_lahir'] ?? '-') . ', ' . date('d-m-Y', strtotime($peserta['tanggal_lahir'] ?? '')), ENT_QUOTES) ?></td></tr>
                                    <tr><td><strong>Bidang Studi</strong></td><td>: <?= htmlspecialchars($peserta['nama_bidang_studi'] ?? '-', ENT_QUOTES) ?></td></tr>
                                    <tr><td><strong>Jenis PPG</strong></td><td>: <?= htmlspecialchars($peserta['jenis_ppg'] ?? '-', ENT_QUOTES) ?></td></tr>
                                </table>
                            </div>

                        <?php else: ?>
                            <h2 class="text-danger fw-bold mb-3">Mohon Maaf</h2>
                            <p class="text-muted mb-4">Anda dinyatakan tidak lulus dalam Program PPG FKIP Universitas Lampung. Jangan berkecil hati dan tetap semangat untuk kesempatan berikutnya!</p>
                            <h4 class="fw-semibold mb-3"><?= htmlspecialchars($no_ukg, ENT_QUOTES) ?></h4>
                        <?php endif; ?>

                        <div class="mt-4">
                            <a href="login.php" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
