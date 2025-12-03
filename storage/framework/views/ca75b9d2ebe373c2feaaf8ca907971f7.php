<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- SEO Meta Tags -->
    <title><?php echo $__env->yieldContent('title', 'PT Swabina Gatra - Facility Management & Services'); ?></title>
    <meta name="description" content="<?php echo $__env->yieldContent('description', 'PT Swabina Gatra adalah perusahaan terdepan dalam Facility Management & Services di Indonesia'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords', 'facility management, services, gresik, indonesia'); ?>">
    <meta name="author" content="PT Swabina Gatra">
    
    <!-- Performance Optimizations -->
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    
    <!-- Critical Bootstrap CSS (inline for faster rendering) -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>?v=<?php echo e(config('app.version', '1.0.0')); ?>" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>?v=<?php echo e(config('app.version', '1.0.0')); ?>"></noscript>
    
    <!-- Bootstrap Icons (CDN - using SVG icons instead, no preload needed) -->
    
    <!-- Custom Styles (deferred) -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/swabina-main.css')); ?>?v=<?php echo e(config('app.version', '1.0.0')); ?>" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="<?php echo e(asset('assets/css/swabina-main.css')); ?>?v=<?php echo e(config('app.version', '1.0.0')); ?>"></noscript>
    
    <!-- Professional Styles -->
    <style>:root{--primary-color:#0454a3;--secondary-color:#00a8e8;--accent-color:#ff6b35;--success-color:#2ecc71;--danger-color:#e74c3c;--light-gray:#f8f9fa;--dark-gray:#343a40}*{margin:0;padding:0;box-sizing:border-box}body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;line-height:1.6;color:#333;background-color:#fff;font-display:swap}@font-face{font-family:'Segoe UI';font-display:swap}
        [data-src] {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
            min-height: 200px;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
        
        .lazy-loaded {
            animation: fadeIn 0.4s ease-in !important;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Professional Header */
        .professional-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 1.5rem 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .header-top {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 0.75rem 0;
            font-size: 0.9rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .contact-info {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .info-item i {
            font-size: 1.2rem;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .logo-container img {
            height: 70px;
            width: auto;
        }
        
        .company-info h1 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
        }
        
        .company-info p {
            font-size: 0.85rem;
            margin: 0;
            opacity: 0.9;
        }
        
        /* Navigation Styles */
        .professional-nav {
            background-color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 0;
        }
        
        .navbar {
            padding: 0.5rem 0;
            display: flex;
            justify-content: center;
        }
        
        .navbar-nav {
            gap: 0.5rem;
        }
        
        .nav-item {
            display: flex;
            align-items: center;
        }
        
        .nav-link {
            color: var(--dark-gray) !important;
            font-weight: 500;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.75rem 1.25rem !important;
            display: inline-flex;
            align-items: center;
            white-space: nowrap;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        .nav-link.active {
            color: var(--primary-color) !important;
            border-bottom: 3px solid var(--primary-color);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        /* Dropdown Styles */
        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
            animation: slideDown 0.3s ease;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .dropdown-item {
            color: var(--dark-gray);
            transition: all 0.3s ease;
            padding: 0.75rem 1.5rem;
        }
        
        .dropdown-item:hover {
            background-color: var(--light-gray);
            color: var(--primary-color);
            padding-left: 1.75rem;
        }
        
        /* Main Content */
        main {
            min-height: calc(100vh - 300px);
            padding: 2rem 0;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .page-header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .page-header p {
            font-size: 1.1rem;
            opacity: 0.95;
        }
        
        /* Card Styles */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-radius: 0.5rem;
            overflow: hidden;
        }
        
        .card:hover {
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
            transform: translateY(-5px);
        }
        
        /* Hover Lift Effect */
        .hover-lift {
            transition: all 0.3s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }
        
        /* Section Title Styles */
        .section-title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .title-underline {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            margin: 0 auto 1rem;
            border-radius: 2px;
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border: none;
            padding: 1.25rem;
            font-weight: 600;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        /* Button Styles */
        .btn {
            border: none;
            border-radius: 0.35rem;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: #033a80;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(4, 84, 163, 0.3);
        }
        
        .btn-secondary {
            background-color: var(--secondary-color);
        }
        
        .btn-secondary:hover {
            background-color: #0096cc;
            transform: translateY(-2px);
        }
        
        .btn-accent {
            background-color: var(--accent-color);
            color: white;
        }
        
        .btn-accent:hover {
            background-color: #ff5520;
            color: white;
        }
        
        /* Section Styles */
        .section {
            padding: 3rem 0;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        
        .section-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            position: relative;
            padding-bottom: 1rem;
        }
        
        .section-header h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            border-radius: 2px;
        }
        
        .section-header p {
            font-size: 1.1rem;
            color: #666;
        }
        
        /* Footer Styles */
        .professional-footer {
            background: linear-gradient(135deg, var(--dark-gray) 0%, #1a1a1a 100%);
            color: white;
            padding: 3rem 0 1rem;
            margin-top: 3rem;
        }
        
        .footer-section h5 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--secondary-color);
        }
        
        .footer-section ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-section ul li {
            margin-bottom: 0.75rem;
        }
        
        .footer-section ul li a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .footer-section ul li a:hover {
            color: var(--secondary-color);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1.5rem;
            margin-top: 2rem;
            text-align: center;
            color: #999;
        }
        
        /* Responsive Styles */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 1.8rem;
            }
            
            .section-header h2 {
                font-size: 1.5rem;
            }
            
            .contact-info {
                gap: 1rem;
                font-size: 0.8rem;
            }
            
            .nav-link {
                padding: 0.5rem 0.75rem !important;
            }
        }
    </style>
    
    <?php echo $__env->yieldContent('additional-styles'); ?>
</head>
<body>
    <!-- Header -->
    <?php echo $__env->make('partials.professional-header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <!-- Navigation -->
    <?php if(Route::currentRouteName() !== 'beranda'): ?>
    <?php echo $__env->make('partials.professional-nav', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
    
    <!-- Page Header (if exists) -->
    <?php if (! empty(trim($__env->yieldContent('page-header')))): ?>
    <div class="page-header">
        <div class="container">
            <?php echo $__env->yieldContent('page-header'); ?>
        </div>
    </div>
    <?php endif; ?>
    
    <!-- Main Content -->
    <main class="container">
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
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>
        
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    
    <!-- Footer -->
    <?php echo $__env->make('partials.professional-footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <!-- Scripts -->
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>" defer></script>
    <script src="<?php echo e(asset('assets/js/lazy-loader.js')); ?>" defer></script>
    
    <!-- Performance Monitor (Only in development/testing) -->
    <?php if(config('app.debug') || request()->has('perf')): ?>
    <script src="<?php echo e(asset('assets/js/performance-monitor.js')); ?>" defer></script>
    <?php endif; ?>
    
    <!-- Service Worker -->
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js').then(reg => {
                    console.log('Service Worker registered');
                }).catch(err => console.log('SW registration failed'));
            });
        }
    </script>
    
    <?php echo $__env->yieldContent('additional-scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\project_magang\resources\views/layouts/app-professional.blade.php ENDPATH**/ ?>