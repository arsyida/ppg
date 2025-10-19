// Menunggu hingga seluruh halaman HTML benar-benar dimuat sebelum menjalankan skrip
document.addEventListener('DOMContentLoaded', function() {
    
    // Menyeleksi elemen-elemen penting dari halaman HTML
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search');
    const tableBody = document.getElementById('participant-table');
    const noResultsRow = document.getElementById('no-results-row');
    const allDataRows = tableBody.querySelectorAll('tr:not(#no-results-row)');
    const paginationNav = document.getElementById('pagination-nav');

    // Pemeriksaan awal untuk memastikan semua elemen yang dibutuhkan ada
    if (!searchForm || !searchInput || !tableBody || !noResultsRow || !paginationNav) {
        console.error('ERROR: Elemen HTML penting tidak ditemukan. Pastikan ID sudah benar.');
        return; 
    }

    // Fungsi untuk memperbarui tampilan paginasi berdasarkan jumlah baris yang terlihat
    function updatePaginationVisibility(visibleRowCount) {
        const itemsPerPage = 10; 
        const totalPages = Math.ceil(visibleRowCount / itemsPerPage);

        if (totalPages <= 1) {
            paginationNav.classList.add('d-none');
        } else {
            paginationNav.classList.remove('d-none');
        }
    }

    // Fungsi utama untuk melakukan pencarian
    function performSearch() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        let visibleRowCount = 0;

        allDataRows.forEach(row => {
            const noPeserta = row.cells[1].textContent.toLowerCase();
            const nama = row.cells[2].textContent.toLowerCase();
            const noSerdik = row.cells[3].textContent.toLowerCase();

            // String apapun akan mengandung string kosong (''), sehingga ini akan me-reset filter
            if (noPeserta.includes(searchTerm) || nama.includes(searchTerm) || noSerdik.includes(searchTerm)) {
                row.classList.remove('d-none');
                visibleRowCount++;
            } else {
                row.classList.add('d-none');
            }
        });

        if (visibleRowCount === 0) {
            noResultsRow.classList.remove('d-none');
        } else {
            noResultsRow.classList.add('d-none');
        }
        
        updatePaginationVisibility(visibleRowCount);
    }

    // Listener untuk form -> Mencari saat tombol diklik
    searchForm.addEventListener('submit', function(event) {
        event.preventDefault(); 
        performSearch();
    });

    searchInput.addEventListener('input', function() {
        // Cek jika isi input field kosong setelah di-trim (menghapus spasi)
        if (searchInput.value.trim() === '') {
            // Jika kosong, panggil kembali fungsi pencarian.
            // Pencarian dengan string kosong akan menampilkan semua data.
            performSearch();
        }
    });
    // ====================================================================

    // Panggil fungsi paginasi saat halaman pertama kali dimuat
    updatePaginationVisibility(allDataRows.length);
});

