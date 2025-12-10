<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem PPG') - FKIP UNILA</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">    
     <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> <!-- custom CSS -->
    <!-- Google Fonts: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div class="d-flex" id="wrapper">
        
        @if (!Route::is('login') && !Route::is('admin.login'))
        @include('partials.sidebar')
    @endif

        <div id="page-content-wrapper">
            
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom d-md-none">
                <div class="container-fluid">
                    <button class="btn btn-primary" id="sidebarToggle">Menu</button>
                </div>
            </nav>

            @yield('content')
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}">
        window.addEventListener('DOMContentLoaded', event => {
            const sidebarToggle = document.body.querySelector('#sidebarToggle');
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', event => {
                    event.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                });
            }
        });
    </script>
</body>
</html>