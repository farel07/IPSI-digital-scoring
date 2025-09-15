<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sistem Pertandingan</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #eef1f9, #f7f8fc);
            min-height: 100vh;
        }
        .navbar-custom {
            background-color: #3b82f6; /* Biru */
            color: white;
        }
        .main-header {
            background-color: white;
            padding: 1.5rem 2rem;
            border-bottom: 1px solid #dee2e6;
        }
        .card {
            border: none;
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        .breadcrumb {
            background-color: transparent;
            padding: 0;
        }
        .breadcrumb-item a {
            text-decoration: none;
            color: #3b82f6;
        }
        .breadcrumb-item.active {
            color: #6c757d;
        }
        .list-group-item-action:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <header class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <i class="bi bi-shield-check fs-3 me-2"></i>
                <div>
                    <h5 class="mb-0">Dashboard Superadmin</h5>
                    <small class="d-block" style="font-size: 0.7rem;">Sistem Manajemen Pertandingan Pencak Silat</small>
                </div>
            </a>
            <div class="d-flex align-items-center">
                <span class="navbar-text me-3">
                    Selamat datang, <strong>Admin Utama</strong>
                </span>
                <i class="bi bi-person-circle fs-2 text-white"></i>
            </div>
        </div>
    </header>

    <main class="container-fluid p-4">
        @yield('content')
    </main>
    @stack('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>