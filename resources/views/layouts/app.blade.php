<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem PPG') - FKIP UNILA</title>

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">    
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> 

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="d-flex" id="wrapper">
        
        @if (!Route::is('login') && !Route::is('admin.login'))
            @include('sidebar')
        @endif

        <div id="page-content-wrapper">
            
            @if (!Route::is('login') && !Route::is('admin.login'))
            <nav class="navbar navbar-light bg-light border-bottom d-md-none mb-3">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">
                        <i class="bi bi-list fs-5"></i>
                    </button>
                </div>
            </nav>
            @endif

            <div class="container-fluid">
                @yield('content')
            </div>

        </div>

        <div id="overlay"></div>

    </div>
    
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            
            const wrapper = document.getElementById('wrapper');
            const toggleButton = document.getElementById('sidebarToggle');
            const overlay = document.getElementById('overlay');

            // Fungsi Toggle
            function toggleSidebar() {
                wrapper.classList.toggle('toggled');
            }

            // 1. Klik Tombol Burger
            if (toggleButton) {
                toggleButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleSidebar();
                });
            }

            // 2. Klik Overlay (Background gelap) untuk menutup sidebar
            if (overlay) {
                overlay.addEventListener('click', function() {
                    wrapper.classList.remove('toggled');
                });
            }
        });
    </script>
</body>
</html>