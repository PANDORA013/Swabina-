<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<meta name="googlebot" content="noindex, nofollow">
<title>Admin SWABINA GATRA</title>
<link rel="shortcut icon" type="image/png" href="https://th.bing.com/th/id/OIP.kAUISDUCtKkJbri2eOKW6gAAAA?rs=1&pid=ImgDetMain" />
<link rel="stylesheet" href="<?php echo e(asset('admin/css/styles.min.css')); ?>" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body style="background-image: url('<?php echo e(asset('assets/logo-perusahaan/Fantasi gunung alami(1).jpg')); ?>');">

<div class="bg-overlay">
    <div class="container-fluid">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>

<script src="<?php echo e(asset('admin/libs/jquery/dist/jquery.min.js')); ?>"> </script>
<script src="<?php echo e(asset('admin/libs/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"> </script>
<script src="<?php echo e(asset('admin/libs/apexcharts/dist/apexcharts.min.js')); ?>"> </script>
<script src="<?php echo e(asset('admin/libs/simplebar/dist/simplebar.js')); ?>"> </script>
<script src="<?php echo e(asset('admin/js/sidebarmenu.js')); ?>"> </script>
<script src="<?php echo e(asset('admin/js/app.min.js')); ?>"> </script>
<script src="<?php echo e(asset('admin/js/dashboard.js')); ?>"> </script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script>$(document).ready(function() {$('.sidebar-link.has-arrow').on('click', function() {var $this = $(this);var $submenu = $this.next('.collapse');$submenu.slideToggle(300);$this.find('.dropdown-icon').toggleClass('rotate');});});</script>
<style>
    body {
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        min-height: 100vh;
    }

    .bg-overlay {
        min-height: 100vh;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Overlay gelap untuk meningkatkan keterbacaan */
        padding: 20px;
    }

    .dropdown-icon.rotate {
        transform: rotate(90deg);
        transition: transform 0.3s;
    }

    @media (max-width: 768px) {
        .container-fluid {
            padding: 10px;
        }
    }
</style>
<?php echo $__env->yieldContent('scripts'); ?>
</body>

</html><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/layouts/login.blade.php ENDPATH**/ ?>