document.addEventListener("DOMContentLoaded", function() {
    
    // 1. Ambil elemen
    const searchInput = document.getElementById('search'); 
    const tableBody = document.getElementById('table-body');
    // Ambil SEMUA container pagination (atas dan bawah jika ada)
    const paginationContainers = document.querySelectorAll('.pagination-container, .pagination-container-bottom'); 

    // 2. Fungsi Fetch Data ke File Ini Sendiri
    function loadData(query) {
        const url = `dashboard.php?ajax_search=1&keyword=${encodeURIComponent(query)}`;

        fetch(url)
            .then(response => response.json()) // Respons sekarang berupa JSON
            .then(data => {
                // A. Update Tabel
                if (data.table_html !== undefined) {
                    tableBody.innerHTML = data.table_html;
                }

                // B. Update Pagination (di semua lokasi)
                paginationContainers.forEach(container => {
                    if (data.pagination_html !== undefined) {
                        container.innerHTML = data.pagination_html;
                    }
                });
            })
            .catch(error => console.error('Error:', error));
    }

    // 3. Event Listener (Input = Live Typing)
    let debounceTimer;
    if(searchInput) {
        searchInput.addEventListener('input', function() {
            
            clearTimeout(debounceTimer);
            
            // Tunggu 300ms agar server tidak berat
            debounceTimer = setTimeout(() => {
                const query = searchInput.value;
                loadData(query);
            }, 300);
        });
    }
});