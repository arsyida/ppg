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

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h1 class="h2 fw-bold mb-0">Data Peserta Lulus PPG</h1>
                    <a href="{{ route('admin.export') }}" class="btn btn-primary px-md-3 py-md-2">
                        <i class="bi bi-download me-md-2"></i><span class="d-none d-md-inline">Export Data</span>
                    </a>
                </div>

                <div class="d-flex-col d-md-flex align-items-center mb-3">
                    {{-- Form Search --}}
                    <form action="{{ route('admin.dashboard') }}" method="GET"
                        class="flex-grow-1 align-items-center justify-content-between search-box d-flex me-0 me-md-5">
                        <input id="search" type="text" name="search" class="form-control"
                            placeholder="Ketik Nama, UKG, atau NIM..." value="{{ $keyword }}" autocomplete="off">
                        <button type="submit" class="btn btn-primary btn-lg ms-2">
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
            const paginationContainers = document.querySelectorAll('.pagination-container, .pagination-container-bottom');

            // Fungsi Fetch Data
            function loadData(query) {
                // Ganti URL ke Route Laravel
                // Perhatikan parameter ?ajax_search=1 agar Controller tahu ini AJAX
                const url = "{{ route('admin.dashboard') }}?ajax_search=1&keyword=" + encodeURIComponent(query);

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        // A. Update Tabel
                        if (data.table_html !== undefined) {
                            tableBody.innerHTML = data.table_html;
                        }

                        // B. Update Pagination
                        paginationContainers.forEach(container => {
                            if (data.pagination_html !== undefined) {
                                container.innerHTML = data.pagination_html;
                            }
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }

            // Event Listener Live Search
            let debounceTimer;
            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(() => {
                        const query = searchInput.value;
                        loadData(query);
                    }, 300);
                });
            }
        });
    </script>

@endsection