<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">

    <title>{{ config('app.name', 'Admin Panel') }}</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome - Required for admin icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Preconnect to CDN for faster resource loading -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
    <!-- Chart.js (deferred to avoid render-blocking) -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js" defer></script>

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
            -webkit-text-size-adjust: 100%;
            text-size-adjust: 100%;
            font-size: 14px;
        }

        /* PROFESSIONAL SIZING FOR ADMIN PANEL - OVERRIDE BOOTSTRAP DEFAULTS */
        
        /* Container and spacing */
        .container,
        .container-fluid {
            --bs-gutter-x: 0.75rem !important;
            --bs-gutter-y: 0.75rem !important;
        }

        .row {
            --bs-gutter-x: 0.75rem !important;
            --bs-gutter-y: 0.75rem !important;
        }

        /* Buttons */
        .btn {
            padding: 0.375rem 0.75rem !important;
            font-size: 0.8125rem !important;
            line-height: 1.4 !important;
        }

        .btn-sm {
            padding: 0.25rem 0.5rem !important;
            font-size: 0.75rem !important;
        }

        .btn-lg {
            padding: 0.5rem 1rem !important;
            font-size: 0.875rem !important;
        }

        /* Forms */
        .form-control,
        .form-select {
            font-size: 0.8rem !important;
            padding: 0.375rem 0.5rem !important;
            height: auto !important;
            min-height: 1.8rem !important;
        }

        .form-label {
            font-size: 0.8rem !important;
            margin-bottom: 0.35rem !important;
        }

        .form-group {
            margin-bottom: 0.75rem !important;
        }

        /* Tables */
        .table {
            font-size: 0.8rem !important;
            margin-bottom: 0.75rem !important;
        }

        .table th,
        .table td {
            padding: 0.5rem !important;
            vertical-align: middle !important;
        }

        /* Cards */
        .card {
            margin-bottom: 0.75rem !important;
            border: 1px solid #ddd !important;
        }

        .card-header {
            padding: 0.75rem !important;
            font-size: 0.9rem !important;
            font-weight: 600 !important;
        }

        .card-body {
            padding: 0.75rem !important;
        }

        .card-footer {
            padding: 0.75rem !important;
        }

        /* Headings */
        h1 {
            font-size: 1.3rem !important;
            margin-bottom: 0.75rem !important;
            font-weight: 700 !important;
        }

        h2 {
            font-size: 1.1rem !important;
            margin-bottom: 0.5rem !important;
            font-weight: 700 !important;
        }

        h3 {
            font-size: 1rem !important;
            margin-bottom: 0.4rem !important;
            font-weight: 600 !important;
        }

        h4 {
            font-size: 0.95rem !important;
            margin-bottom: 0.35rem !important;
            font-weight: 600 !important;
        }

        h5 {
            font-size: 0.9rem !important;
            margin-bottom: 0.3rem !important;
            font-weight: 600 !important;
        }

        h6 {
            font-size: 0.85rem !important;
            margin-bottom: 0.25rem !important;
            font-weight: 600 !important;
        }

        /* Modals */
        .modal-header {
            padding: 0.75rem !important;
            border-bottom: 1px solid #ddd !important;
        }

        .modal-body {
            padding: 0.75rem !important;
        }

        .modal-footer {
            padding: 0.75rem !important;
            border-top: 1px solid #ddd !important;
        }

        .modal-title {
            font-size: 1rem !important;
            font-weight: 600 !important;
        }

        /* Navbar */
        .navbar {
            padding: 0.75rem !important;
        }

        .navbar-brand {
            font-size: 1.1rem !important;
            font-weight: 700 !important;
        }

        .nav-link {
            font-size: 0.8rem !important;
            padding: 0.35rem 0.75rem !important;
        }

        /* Badges and pills */
        .badge {
            font-size: 0.7rem !important;
            padding: 0.25rem 0.5rem !important;
        }

        /* Alerts */
        .alert {
            padding: 0.5rem 0.75rem !important;
            margin-bottom: 0.75rem !important;
            font-size: 0.8rem !important;
        }

        /* Pagination */
        .pagination {
            gap: 0.25rem !important;
        }

        .page-link {
            padding: 0.35rem 0.5rem !important;
            font-size: 0.8rem !important;
        }

        /* Dropdowns */
        .dropdown-menu {
            font-size: 0.8rem !important;
        }

        .dropdown-item {
            padding: 0.35rem 0.75rem !important;
        }

        /* List groups */
        .list-group-item {
            padding: 0.5rem 0.75rem !important;
            font-size: 0.8rem !important;
        }

        /* Breadcrumb */
        .breadcrumb {
            font-size: 0.8rem !important;
            margin-bottom: 0.75rem !important;
            background: transparent !important;
            padding: 0 !important;
        }

        .breadcrumb-item a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            color: var(--secondary-color);
            text-decoration: underline;
        }

        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1rem 1.5rem;
            border-radius: 8px;
            color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .page-header .page-title {
            color: white;
            margin-bottom: 0.5rem;
            font-size: 1.4rem !important;
        }

        .page-header .breadcrumb {
            background: rgba(255,255,255,0.1);
            padding: 0.5rem 1rem !important;
            border-radius: 5px;
        }

        .page-header .breadcrumb-item {
            color: rgba(255,255,255,0.9);
        }

        .page-header .breadcrumb-item a {
            color: white;
            font-weight: 500;
        }

        .page-header .breadcrumb-item.active {
            color: rgba(255,255,255,0.8);
        }

        .page-header .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.7);
        }

        /* General margins and paddings */
        .p-1 { padding: 0.35rem !important; }
        .p-2 { padding: 0.75rem !important; }
        .p-3 { padding: 1rem !important; }
        .m-1 { margin: 0.35rem !important; }
        .m-2 { margin: 0.75rem !important; }
        .m-3 { margin: 1rem !important; }

        /* Sidebar */
        .sidebar {
            padding: 0.75rem 0 !important;
        }

        .sidebar-menu a {
            padding: 0.5rem 0.75rem !important;
            font-size: 0.8rem !important;
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
            margin-bottom: 0.5rem;
        }

        .sidebar-menu a {
            display: block;
            padding: 0.75rem 1rem;
            color: #555;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            font-size: 0.875rem;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background-color: var(--light-gray);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            padding-left: 1.25rem;
        }

        .main-content {
            padding: 1.5rem;
        }

        .card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: #033a7a;
            border-color: #033a7a;
        }

        .table {
            background: white;
        }

        .table thead th {
            background-color: var(--light-gray);
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.875rem;
            padding: 0.75rem;
        }

        .table tbody tr:hover {
            background-color: var(--light-gray);
        }

        .icon {
            width: 48px;
            height: 48px;
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
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .numbers p {
            font-size: 0.875rem;
            color: #555;
        }

        .footer {
            background: #f8f9fa;
            border-top: 1px solid #e0e0e0;
            padding: 1.5rem;
            text-align: center;
            color: #666;
            margin-top: 2rem;
            font-size: 0.875rem;
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

        /* Icon sizing for proper display */
        .sidebar-menu i {
            font-size: 1rem;
            width: 1.25rem;
            text-align: center;
            display: inline-block;
        }

        .navbar i {
            font-size: 1.1rem;
            vertical-align: middle;
        }

        .navbar-brand {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .nav-link {
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                display: none;
            }

            .main-content {
                padding: 0.5rem;
            }

            .numbers h2 {
                font-size: 1.1rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Skip to Main Content Link (Accessibility) -->
    <a href="#main-content" class="btn btn-primary position-absolute" style="top: -40px; left: 0; z-index: 100;">
        Skip to main content
    </a>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" role="navigation" aria-label="Main navigation">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2" aria-hidden="true"></i>
                Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="fas fa-user-circle me-2"></i>
                            {{ auth()->user()->name ?? 'Admin' }}
                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="border: none; background: none;">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Logout
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
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                    </li>

                    <!-- Divider -->
                    <li style="border-top: 1px solid #e0e0e0; margin: 10px 0; padding: 10px 0;">
                        <span style="padding: 0 20px; font-size: 0.85rem; color: #999; font-weight: 600; text-transform: uppercase;">
                            <i class="fas fa-globe me-2"></i>
                            Halaman Public
                        </span>
                    </li>

                    <!-- Berita -->
                    <li>
                        <a href="{{ route('admin.berita.index') }}" class="@if(request()->routeIs('admin.berita.*')) active @endif">
                            <i class="fas fa-newspaper me-2"></i>
                            Berita & Artikel
                        </a>
                    </li>

                    <!-- FAQ -->
                    <li>
                        <a href="{{ route('admin.faq.index') }}" class="@if(request()->routeIs('admin.faq.*')) active @endif">
                            <i class="fas fa-question-circle me-2"></i>
                            FAQ
                        </a>
                    </li>

                    <!-- Pedoman -->
                    <li>
                        <a href="{{ route('admin.pedoman.index') }}" class="@if(request()->routeIs('admin.pedoman.*')) active @endif">
                            <i class="fas fa-book me-2"></i>
                            Kebijakan & Pedoman
                        </a>
                    </li>

                    <!-- Jejak Langkah -->
                    <li>
                        <a href="{{ route('admin.jejak.index') }}" class="@if(request()->routeIs('admin.jejak.*')) active @endif">
                            <i class="fas fa-history me-2"></i>
                            Jejak Langkah
                        </a>
                    </li>

                    <!-- Why Choose Us -->
                    <li>
                        <a href="{{ route('admin.why-choose-us.index') }}" class="@if(request()->routeIs('admin.why-choose-us.*')) active @endif">
                            <i class="fas fa-star me-2"></i>
                            Mengapa Memilih Kami
                        </a>
                    </li>

                    <!-- Sertifikat & Penghargaan -->
                    <li>
                        <a href="{{ route('admin.sertifikat.index') }}" class="@if(request()->routeIs('admin.sertifikat.*')) active @endif">
                            <i class="fas fa-award me-2"></i>
                            Sertifikat & Penghargaan
                        </a>
                    </li>

                    <!-- Sekilas Perusahaan -->
                    <li>
                        <a href="{{ route('admin.sekilas.index') }}" class="@if(request()->routeIs('admin.sekilas.*')) active @endif">
                            <i class="fas fa-building me-2"></i>
                            Sekilas Perusahaan
                        </a>
                    </li>

                    <!-- Contact Page Management -->
                    <li>
                        <a href="{{ route('admin.contact-page.index') }}" class="@if(request()->routeIs('admin.contact-page.*')) active @endif">
                            <i class="fas fa-envelope me-2"></i>
                            Halaman Kontak
                        </a>
                    </li>

                    <!-- Layanan Pages Management -->
                    <li>
                        <a href="{{ route('admin.layanan.index') }}" class="@if(request()->routeIs('admin.layanan.*')) active @endif">
                            <i class="fas fa-briefcase me-2"></i>
                            Halaman Layanan
                        </a>
                    </li>

                    <!-- Divider -->
                    <li style="border-top: 1px solid #e0e0e0; margin: 10px 0; padding: 10px 0;">
                        <span style="padding: 0 20px; font-size: 0.85rem; color: #999; font-weight: 600; text-transform: uppercase;">
                            <i class="fas fa-lock me-2"></i>
                            Super Admin
                        </span>
                    </li>

                    <!-- Admin Management (Super Admin Only) -->
                    @if(auth()->check() && auth()->user()->isSuperAdmin())
                        <li>
                            <a href="{{ route('admin.admin-management.index') }}" class="@if(request()->routeIs('admin.admin-management.*')) active @endif">
                                <i class="fas fa-cog me-2"></i>
                                Kelola Admin
                            </a>
                        </li>
                    @endif

                    <!-- Divider -->
                    <li style="border-top: 1px solid #e0e0e0; margin: 10px 0; padding: 10px 0;">
                        <span style="padding: 0 20px; font-size: 0.85rem; color: #999; font-weight: 600; text-transform: uppercase;">
                            <i class="fas fa-cog me-2"></i>
                            Pengaturan
                        </span>
                    </li>

                    <!-- Company Info -->
                    <li>
                        <a href="{{ route('admin.company-info.index') }}" class="@if(request()->routeIs('admin.company-info.*')) active @endif">
                            <i class="fas fa-building me-2"></i>
                            Informasi Perusahaan
                        </a>
                    </li>

                    <!-- Social Media -->
                    <li>
                        <a href="{{ route('admin.social-media.index') }}" class="@if(request()->routeIs('admin.social-media.*')) active @endif">
                            <i class="fas fa-share-alt me-2"></i>
                            Media Sosial
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content" id="main-content" role="main">
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

                <!-- Page Header with Breadcrumb -->
                <div class="page-header mb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="page-title mb-1">
                                <span class="badge bg-danger me-2">ADMIN</span>
                                @yield('page-title', 'Dashboard')
                            </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a></li>
                                    @yield('breadcrumb')
                                </ol>
                            </nav>
                        </div>
                        <div class="text-muted small">
                            <i class="fas fa-user-shield"></i> {{ auth()->user()->name ?? 'Guest' }}
                        </div>
                    </div>
                </div>

                <!-- Page Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; {{ date('Y') }} PT Swabina Gatra. All rights reserved.</p>
    </div>

    <!-- Bootstrap JS with defer for non-blocking load -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    
    <!-- SweetAlert2 (deferred to avoid render-blocking) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

    @stack('scripts')
</body>
</html>
