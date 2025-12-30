@extends('layouts.app')

@section('title', 'Login Admin PPG FKIP UNILA')

@section('content')

<div class="d-flex" id="wrapper">
    <?php require 'sidebar.php'; ?>

    <div id="page-content-wrapper">
        <div class="container-fluid p-4 p-md-5">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h2 fw-bold mb-0">Data Peserta Lulus PPG</h1>
                <a href="export.php" class="btn btn-primary px-3 py-2">
                    <i class="bi bi-download me-2"></i>Export Data
                </a>
            </div>
            
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">

                <form action="" method="GET" class="d-flex align-items-center flex-grow-1 me-3">
                    <div class="search-box me-2 w-100">
                        <input id="search" type="text" name="search" class="form-control" placeholder="Ketik Nama, UKG, atau NIM..." value="<?= htmlspecialchars($search) ?>" autocomplete="off">
                        <button type="submit" class="btn btn-primary">
                             <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>

                <div class="pagination-container mt-3 mt-lg-0">
                    <?php echo $pagination_html; ?>
                </div>
            </div>
            
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Peserta</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>No UKG</th>
                                    <th>NIM</th>
                                    <th>NIK</th>
                                    <th>Bidang Studi</th>
                                    <th>Jenis PPG</th>
                                    <th>No HP</th>
                                    <th>Alamat</th>
                                    <th>Pas Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                                <?php if (empty($peserta_list)): ?>
                                    <tr>
                                        <td colspan="13" class="text-center text-muted">Data tidak ditemukan.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php 
                                    $i = $offset + 1; 
                                    foreach ($peserta_list as $peserta): 
                                    ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= htmlspecialchars($peserta['nama_peserta']) ?></td>
                                        <td><?= htmlspecialchars($peserta['tempat_lahir']) ?></td>
                                        <td><?= htmlspecialchars($peserta['tanggal_lahir']) ?></td>
                                        <td><?= htmlspecialchars($peserta['no_ukg']) ?></td>
                                        <td><?= htmlspecialchars($peserta['nim']) ?></td>
                                        <td><?= htmlspecialchars($peserta['nik']) ?></td>
                                        <td><?= htmlspecialchars($peserta['nama_bidang_studi']) ?></td>
                                        <td><?= htmlspecialchars($peserta['jenis_ppg']) ?></td>
                                        <td><?= htmlspecialchars($peserta['no_hp'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($peserta['alamat_lengkap'] ?? '-') ?></td>
                                        <td><?= htmlspecialchars($peserta['pas_foto'] ?? '-') ?></td>
                                        <td>
                                            <a href="edit-peserta.php?no_ukg=<?= htmlspecialchars($peserta['no_ukg']) ?>" class="btn btn-sm btn-warning">
                                                <i class="bi bi-pencil-fill"></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <div class="pagination-container-bottom">
                            <?php echo $pagination_html; ?>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script src="{{ asset('assets/js/admin/script.js') }}"></script>
@endsection