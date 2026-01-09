@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

    {{-- CSS Tambahan (Sesuai kode native Anda) --}}
    <style>
        .table th {
            white-space: nowrap;
        }

        /* Pastikan CSS .pagination-custom dsb sudah ada di style.css global */
    </style>

    <div class="d-flex" id="wrapper">
        <div id="page-content-wrapper">
            <div class="container-fluid p-1 p-md-4">

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i> {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h2 fw-bold mb-0">Data Peserta Lulus PPG</h1>
                    <a href="{{ route('admin.export') }}" class="btn btn-primary px-md-3 py-md-2">
                        <i class="bi bi-download me-md-2"></i><span class="d-none d-md-inline">Export Data</span>
                    </a>
                </div>

                <div class="d-flex-col d-md-flex align-items-center mb-3">
                    {{-- Form Search --}}
                    <form action="{{ route('admin.dashboard') }}" method="GET"
                        class="flex-grow-1 align-items-center justify-content-between search-box d-flex me-0 me-md-5"
                        onsubmit="return false;">
                        <input id="search" type="text" name="search" class="form-control"
                            placeholder="Ketik Nama, UKG, atau NIM..." value="{{ $keyword }}" autocomplete="off">
                        <button type="button" class="btn btn-primary btn-lg ms-2" onclick="loadData(document.getElementById('search').value)">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                    {{-- Pagination Container Atas --}}
                    <div class="pagination-container mt-3 mt-lg-0 p-2 ">
                        @include('admin.partials.pagination')
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
                                    {{-- Include Rows Partial --}}
                                    @include('admin.partials.table_rows')
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex-col d-md-flex align-items-center justify-content-end mt-3">
                    {{-- Pagination Container Atas --}}
                    <div class="pagination-container mt-3 mt-lg-0 p-2">
                        @include('admin.partials.pagination')
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT AJAX --}}
    <script>
    document.addEventListener("DOMContentLoaded", function () {

        const searchInput = document.getElementById('search');
        const tableBody = document.getElementById('table-body');
        const paginationContainers = document.querySelectorAll('.pagination-container'); // Sesuaikan selector container

        // --- 1. Fungsi Fetch Data (loadData) ---
        window.loadData = function(query) { 
            // Efek Loading
            if(tableBody) tableBody.style.opacity = '0.5';

            const url = "{{ route('admin.dashboard') }}?ajax_search=1&keyword=" + encodeURIComponent(query);

            fetch(url)
                .then(response => {
                    // Cek jika response bukan OK (misal error 500)
                    if (!response.ok) {
                        throw new Error("HTTP error " + response.status); 
                    }
                    return response.json();
                })
                .then(data => {
                    // Update Tabel
                    if (data.table_html !== undefined) {
                        tableBody.innerHTML = data.table_html;
                    }

                    // Update Pagination
                    paginationContainers.forEach(container => {
                        if (data.pagination_html !== undefined) {
                            container.innerHTML = data.pagination_html;
                        }
                    });
                    
                    // Kembalikan Opacity
                    if(tableBody) tableBody.style.opacity = '1';
                })
                .catch(error => {
                    console.error('Error:', error);
                    if(tableBody) tableBody.style.opacity = '1';
                });
        }

        // --- 2. Event Listener Live Search (Debounce) ---
        let debounceTimer;
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    loadData(searchInput.value);
                }, 300);
            });

            // Cegah Enter reload halaman
            searchInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    clearTimeout(debounceTimer);
                    loadData(searchInput.value);
                }
            });
        }

        // --- 3. Event Listener Klik Pagination (Kode Baru Anda) ---
        document.addEventListener('click', function(e) {
            // PERHATIKAN: Saya ubah .pagination jadi .pagination-custom sesuai HTML Anda
            if (e.target.closest('.pagination-custom .page-link')) {
                e.preventDefault();
                const link = e.target.closest('.page-link');
                const url = link.getAttribute('href');

                // Cek URL valid dan tidak disabled
                // Cek parentElement (li) apakah punya class disabled
                if (url && url !== '#' && !link.parentElement.classList.contains('disabled')) {
                    
                    const currentSearch = searchInput ? searchInput.value : '';
                    
                    // Modifikasi URL untuk menyertakan keyword pencarian
                    const finalUrl = new URL(url);
                    if(currentSearch) {
                        finalUrl.searchParams.set('keyword', currentSearch); // atau 'search' sesuai controller
                        finalUrl.searchParams.set('ajax_search', 1);
                    }
                    
                    // Efek loading saat klik page
                    if(tableBody) tableBody.style.opacity = '0.5';

                    fetch(finalUrl)
                        .then(res => res.json())
                        .then(data => {
                            if (data.table_html) tableBody.innerHTML = data.table_html;
                            
                            // Update semua tempat pagination muncul (atas & bawah)
                            paginationContainers.forEach(el => {
                                if(data.pagination_html) el.innerHTML = data.pagination_html;
                            });

                            if(tableBody) tableBody.style.opacity = '1';
                        })
                        .catch(err => {
                             console.error(err);
                             if(tableBody) tableBody.style.opacity = '1';
                        });
                }
            }
        });

    });
</script>

@endsection