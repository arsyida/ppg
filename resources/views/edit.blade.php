<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbaikan Data - PPG FKIP UNILA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="d-flex" id="wrapper">
        
        <?php 
        // Memanggil file sidebar
        require 'templates/sidebar.php'; 
        ?>

        <div id="page-content-wrapper">
            <div class="container-fluid p-4 p-md-5">

                <?php
                // Tampilkan "Flash Message" jika ada
                if (isset($_SESSION['message'])) {
                    $message_type = strpos(strtolower($_SESSION['message']), 'error') !== false ? 'danger' : 'success';
                    echo '<div class="alert alert-' . $message_type . ' alert-dismissible fade show" role="alert">';
                    echo htmlspecialchars($_SESSION['message']);
                    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                    echo '</div>';
                    
                    // Hapus pesan setelah ditampilkan
                    unset($_SESSION['message']);
                }
                ?>

                <h1 class="h2 mb-4 fw-bold">Perbaikan Data Sertifikat Pendidik</h1>
                
                <div class="card shadow-sm border-0" style="border-radius: var(--radius-lg);">
                    <div class="card-body p-4 p-md-5">
                        
                        <form method="POST" action="proses-perbaikan.php" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-5 col-lg-4">
                                    <label class="form-label fw-medium">Pas Foto 3x4</label>
                                    <div class="pas-foto-placeholder mb-2">
                                        <?php if (!empty($peserta['pas_foto'])): ?>
                                            <img src="uploads/<?= htmlspecialchars($peserta['pas_foto']) ?>" 
                                                 alt="Pas Foto Peserta" 
                                                 style="width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius-md);">
                                        <?php else: ?>
                                            Pas foto<br>3 x 4
                                        <?php endif; ?>
                                    </div>
                                    <input type="file" class="form-control" id="pas_foto" name="pas_foto" accept="image/jpeg, image/png" <?php if (empty($peserta['pas_foto'])) echo 'required'; ?>>
                                    <small class="form-text text-muted">Upload pas foto dengan background merah (format .jpg/.png).</small>
                                    <div class="mt-4">
                                        <label for="no_ukg" class="form-label fw-medium">No UKG</label>
                                        <input type="text" class="form-control" id="no_ukg" name="no_ukg" value="<?= htmlspecialchars($peserta['no_ukg'] ?? 'No UKG', ENT_QUOTES) ?>" readonly>
                                    </div>
                                    
                                    
                                </div>
                                
                                <div class="col-md-7 col-lg-8 s mt-md-0">
                                    <div class="row">
                                        <div class="mt-lg-0">
                                        <label for="nama_peserta" class="form-label fw-medium">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" value="<?= htmlspecialchars($peserta['nama_peserta'] ?? 'Nama Lengkap', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') ?>" required>
                                        </div>

                                        <div class="col-lg-6 mt-3">
                                            <label for="nik" class="form-label fw-medium">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik" value="<?= htmlspecialchars($peserta['nik'] ?? 'NIK', ENT_QUOTES) ?>" required>
                                        </div>

                                        <div class="col-lg-6 mt-3">
                                            <label for="no_hp" class="form-label fw-medium">No HP</label>
                                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukkan No HP Anda" value="<?= htmlspecialchars($peserta['no_hp'] ?? '', ENT_QUOTES) ?>" required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <label for="tempat_lahir" class="form-label fw-medium">Tempat Lahir</label>
                                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= htmlspecialchars($peserta['tempat_lahir'] ?? 'Tempat Lahir', ENT_QUOTES) ?>" required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <label for="tanggal_lahir" class="form-label fw-medium">Tanggal Lahir</label>
                                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="<?= htmlspecialchars($peserta['tanggal_lahir'] ?? 'Tanggal Lahir', ENT_QUOTES) ?>" required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <label for="nim" class="form-label fw-medium">NIM</label>
                                            <input type="text" class="form-control" id="nim" name="nim" value="<?= htmlspecialchars($peserta['nim'] ?? 'NIM', ENT_QUOTES) ?>" required>
                                        </div>
                                        <div class="col-lg-6 mt-3">
                                            <label for="jenis_ppg" class="form-label fw-medium">Jenis PPG</Label>
                                            <input type="text" class="form-control" id="jenis_ppg" name="jenis_ppg" value="<?= htmlspecialchars($peserta['jenis_ppg'] ?? 'Jenis PPG', ENT_QUOTES) ?>" readonly>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <label for="alamat_lengkap" class="form-label fw-medium">Alamat Lengkap</label>
                                            <textarea class="form-control" id="alamat_lengkap" name="alamat_lengkap" rows="5" placeholder="Jalan, RT RW, Desa, Kecamatan, Kabupaten, Provinsi, Kode pos" required><?= htmlspecialchars($peserta['alamat_lengkap'] ?? '', ENT_QUOTES)?></textarea>
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
</body>
</html>