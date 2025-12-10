<div class="bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4">
        <img src="assets/images/Logo-PPG-FKIP.png" alt="Logo PPG" style="width: 50px;">
        <span class="ms-2 fs-5 fw-bold">PPG FKIP UNILA</span>
    </div>
    <div class="list-group list-group-flush my-3">
        
        <a href="index.php" class="list-group-item list-group-item-action <?= ($currentPage == 'index.php') ? 'active' : '' ?>">
            <i class="bi bi-house-door-fill me-2"></i>Beranda
        </a>
        
        <a href="perbaikan-data.php" class="list-group-item list-group-item-action <?= ($currentPage == 'perbaikan-data.php') ? 'active' : '' ?>">
            <i class="bi bi-pencil-square me-2"></i>Perbaikan Data
        </a>
        
        <a href="info-pengiriman.php" class="list-group-item list-group-item-action <?= ($currentPage == 'info-pengiriman.php') ? 'active' : '' ?>">
            <i class="bi bi-truck me-2"></i>Info Pengiriman
        </a>

        <a href="logout.php" class="list-group-item list-group-item-action text-danger mt-5">
            <i class="bi bi-box-arrow-left me-2"></i>Logout
        </a>
    </div>
</div>