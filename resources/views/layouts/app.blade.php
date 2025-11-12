<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Admin Panel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        :root {
            --primary-color: #0454a3;
            --secondary-color: #00a8e8;
            --light-gray: #f8f9fa;
            --dark-gray: #343a40;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-gray);
            color: #333;
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        .nav-link {
            color: rgba(255, 255, 255, 0.8) !important;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            color: white !important;
        }

        .sidebar {
            background: white;
            border-right: 1px solid #e0e0e0;
            min-height: 100vh;
            padding: 20px 0;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            display: block;
            padding: 12px 20px;
            color: #666;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--light-gray);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            padding-left: 25px;
        }

        .main-content {
            padding: 30px 20px;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }

        .card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 15px 20px;
            font-weight: 600;
        }

        .card-body {
            padding: 20px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #033a7a;
            border-color: #033a7a;
        }

        .badge {
            padding: 8px 12px;
            font-size: 0.85rem;
        }

        .table {
            background: white;
        }

        .table thead th {
            background-color: var(--light-gray);
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: var(--primary-color);
        }

        .table tbody tr:hover {
            background-color: var(--light-gray);
        }

        .icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #3498db 0%, #2980b9 100%);
            color: white;
        }

        .bg-gradient-success {
            background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
            color: white;
        }

        .bg-gradient-warning {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
            color: white;
        }

        .bg-gradient-danger {
            background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
            color: white;
        }

        .numbers h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .numbers p {
            font-size: 0.9rem;
            color: #666;
        }

        .footer {
            background: #f8f9fa;
            border-top: 1px solid #e0e0e0;
            padding: 20px;
            text-align: center;
            color: #666;
            margin-top: 30px;
        }

        .alert {
            border-radius: 8px;
            border: none;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-content {
                padding: 15px 10px;
            }

            .numbers h2 {
                font-size: 1.5rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2"></i>Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="fas fa-user-circle me-2"></i>{{ auth()->user()->name ?? 'Admin' }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="border: none; background: none;">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-none d-md-block">
                <ul class="sidebar-menu">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="@if(request()->routeIs('admin.dashboard')) active @endif">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>

                    <!-- Divider -->
                    <li style="border-top: 1px solid #e0e0e0; margin: 10px 0; padding: 10px 0;">
                        <span style="padding: 0 20px; font-size: 0.85rem; color: #999; font-weight: 600; text-transform: uppercase;">
                            <i class="fas fa-globe me-2"></i>Halaman Public
                        </span>
                    </li>

                    <!-- Berita -->
                    <li>
                        <a href="{{ route('admin.berita.index') }}" class="@if(request()->routeIs('admin.berita.*')) active @endif">
                            <i class="fas fa-newspaper me-2"></i>Berita & Artikel
                        </a>
                    </li>

                    <!-- FAQ -->
                    <li>
                        <a href="{{ route('admin.faq.index') }}" class="@if(request()->routeIs('admin.faq.*')) active @endif">
                            <i class="fas fa-question-circle me-2"></i>FAQ
                        </a>
                    </li>

                    <!-- Pedoman -->
                    <li>
                        <a href="{{ route('admin.pedoman.index') }}" class="@if(request()->routeIs('admin.pedoman.*')) active @endif">
                            <i class="fas fa-book me-2"></i>Kebijakan & Pedoman
                        </a>
                    </li>

                    <!-- Jejak Langkah -->
                    <li>
                        <a href="{{ route('admin.jejak.index') }}" class="@if(request()->routeIs('admin.jejak.*')) active @endif">
                            <i class="fas fa-timeline me-2"></i>Jejak Langkah
                        </a>
                    </li>

                    <!-- Why Choose Us -->
                    <li>
                        <a href="{{ route('admin.why-choose-us.index') }}" class="@if(request()->routeIs('admin.why-choose-us.*')) active @endif">
                            <i class="fas fa-star me-2"></i>Mengapa Memilih Kami
                        </a>
                    </li>

                    <!-- Divider -->
                    <li style="border-top: 1px solid #e0e0e0; margin: 10px 0; padding: 10px 0;">
                        <span style="padding: 0 20px; font-size: 0.85rem; color: #999; font-weight: 600; text-transform: uppercase;">
                            <i class="fas fa-cog me-2"></i>Pengaturan
                        </span>
                    </li>

                    <!-- Company Info -->
                    <li>
                        <a href="{{ route('admin.company-info.index') }}" class="@if(request()->routeIs('admin.company-info.*')) active @endif">
                            <i class="fas fa-building me-2"></i>Informasi Perusahaan
                        </a>
                    </li>

                    <!-- Social Media -->
                    <li>
                        <a href="{{ route('admin.sosmed.index') }}" class="@if(request()->routeIs('admin.sosmed.*')) active @endif">
                            <i class="fas fa-share-alt me-2"></i>Media Sosial
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Alerts -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Page Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} PT Swabina Gatra. All rights reserved.</p>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
