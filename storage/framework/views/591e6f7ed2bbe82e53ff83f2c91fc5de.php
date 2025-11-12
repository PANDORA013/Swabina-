<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Admin Panel')); ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome with font-display swap for faster rendering -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>
    
    <!-- Preconnect to CDN for faster resource loading -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
    <!-- Chart.js (loaded immediately for dashboard) -->
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

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo e(route('admin.dashboard')); ?>">
                <i class="fas fa-tachometer-alt me-2"></i>Admin Panel
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <span class="nav-link">
                            <i class="fas fa-user-circle me-2"></i><?php echo e(auth()->user()->name ?? 'Admin'); ?>

                        </span>
                    </li>
                    <li class="nav-item">
                        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
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
                        <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php if(request()->routeIs('admin.dashboard')): ?> active <?php endif; ?>">
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
                        <a href="<?php echo e(route('admin.berita.index')); ?>" class="<?php if(request()->routeIs('admin.berita.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-newspaper me-2"></i>Berita & Artikel
                        </a>
                    </li>

                    <!-- FAQ -->
                    <li>
                        <a href="<?php echo e(route('admin.faq.index')); ?>" class="<?php if(request()->routeIs('admin.faq.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-question-circle me-2"></i>FAQ
                        </a>
                    </li>

                    <!-- Pedoman -->
                    <li>
                        <a href="<?php echo e(route('admin.pedoman.index')); ?>" class="<?php if(request()->routeIs('admin.pedoman.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-book me-2"></i>Kebijakan & Pedoman
                        </a>
                    </li>

                    <!-- Jejak Langkah -->
                    <li>
                        <a href="<?php echo e(route('admin.jejak.index')); ?>" class="<?php if(request()->routeIs('admin.jejak.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-timeline me-2"></i>Jejak Langkah
                        </a>
                    </li>

                    <!-- Why Choose Us -->
                    <li>
                        <a href="<?php echo e(route('admin.why-choose-us.index')); ?>" class="<?php if(request()->routeIs('admin.why-choose-us.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-star me-2"></i>Mengapa Memilih Kami
                        </a>
                    </li>

                    <!-- Sertifikat & Penghargaan -->
                    <li>
                        <a href="<?php echo e(route('admin.sertifikat.index')); ?>" class="<?php if(request()->routeIs('admin.sertifikat.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-award me-2"></i>Sertifikat & Penghargaan
                        </a>
                    </li>

                    <!-- Sekilas Perusahaan -->
                    <li>
                        <a href="<?php echo e(route('admin.sekilas.index')); ?>" class="<?php if(request()->routeIs('admin.sekilas.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-building-columns me-2"></i>Sekilas Perusahaan
                        </a>
                    </li>

                    <!-- Divider -->
                    <li style="border-top: 1px solid #e0e0e0; margin: 10px 0; padding: 10px 0;">
                        <span style="padding: 0 20px; font-size: 0.85rem; color: #999; font-weight: 600; text-transform: uppercase;">
                            <i class="fas fa-lock me-2"></i>Super Admin
                        </span>
                    </li>

                    <!-- Admin Management (Super Admin Only) -->
                    <?php if(auth()->user()->isSuperAdmin()): ?>
                        <li>
                            <a href="<?php echo e(route('admin.admin-management.index')); ?>" class="<?php if(request()->routeIs('admin.admin-management.*')): ?> active <?php endif; ?>">
                                <i class="fas fa-users-cog me-2"></i>Kelola Admin
                            </a>
                        </li>
                    <?php endif; ?>

                    <!-- Divider -->
                    <li style="border-top: 1px solid #e0e0e0; margin: 10px 0; padding: 10px 0;">
                        <span style="padding: 0 20px; font-size: 0.85rem; color: #999; font-weight: 600; text-transform: uppercase;">
                            <i class="fas fa-cog me-2"></i>Pengaturan
                        </span>
                    </li>

                    <!-- Company Info -->
                    <li>
                        <a href="<?php echo e(route('admin.company-info.index')); ?>" class="<?php if(request()->routeIs('admin.company-info.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-building me-2"></i>Informasi Perusahaan
                        </a>
                    </li>

                    <!-- Social Media -->
                    <li>
                        <a href="<?php echo e(route('admin.sosmed.index')); ?>" class="<?php if(request()->routeIs('admin.sosmed.*')): ?> active <?php endif; ?>">
                            <i class="fas fa-share-alt me-2"></i>Media Sosial
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <!-- Alerts -->
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong>
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Page Content -->
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>&copy; <?php echo e(date('Y')); ?> PT Swabina Gatra. All rights reserved.</p>
    </div>

    <!-- Bootstrap JS with defer for non-blocking load -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\project_magang\resources\views/layouts/app.blade.php ENDPATH**/ ?>