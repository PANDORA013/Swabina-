

<?php $__env->startSection('title', $service->title . ' - ' . ($companyInfo->company_name ?? 'Swabina Gatra')); ?>

<?php $__env->startSection('meta'); ?>
<meta name="description" content="<?php echo e(Str::limit($service->description, 160)); ?>">
<meta name="keywords" content="<?php echo e($service->title); ?>, layanan, swabina gatra">
<meta property="og:title" content="<?php echo e($service->title); ?>">
<meta property="og:description" content="<?php echo e(Str::limit($service->description, 200)); ?>">
<?php if($service->image): ?>
<meta property="og:image" content="<?php echo e(asset('storage/' . $service->image)); ?>">
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="hero-section py-5" style="background: linear-gradient(135deg, #0056b3 0%, #003d82 100%); color: white;">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-8 mx-auto text-center">
                <?php if($service->icon): ?>
                <div class="mb-4">
                    <i class="bi <?php echo e($service->icon); ?> display-1"></i>
                </div>
                <?php endif; ?>
                <h1 class="display-4 fw-bold mb-3"><?php echo e($service->title); ?></h1>
                <p class="lead mb-4"><?php echo e($service->subtitle); ?></p>
                <a href="#details" class="btn btn-light btn-lg">
                    <i class="bi bi-arrow-down-circle me-2"></i>Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Service Details Section -->
<section id="details" class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <?php if($service->image): ?>
                <div class="mb-4">
                    <img 
                        src="<?php echo e(asset('storage/' . $service->image)); ?>" 
                        alt="<?php echo e($service->title); ?>"
                        class="img-fluid rounded shadow-lg"
                        loading="lazy"
                        width="800"
                        height="450"
                    >
                </div>
                <?php endif; ?>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h2 class="h3 mb-4">Tentang <?php echo e($service->title); ?></h2>
                        <div class="text-muted lh-lg">
                            <?php echo nl2br(e($service->description)); ?>

                        </div>
                    </div>
                </div>

                <?php if($service->features): ?>
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h3 class="h4 mb-4">Fitur & Keunggulan</h3>
                        <div class="row g-3">
                            <?php $__currentLoopData = $service->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <div class="d-flex align-items-start">
                                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                                    <span><?php echo e($feature); ?></span>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<!-- Related Services Section -->
<?php if($relatedServices->isNotEmpty()): ?>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="h3">Layanan Lainnya</h2>
            <p class="text-muted">Jelajahi layanan kami yang lain</p>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $relatedServices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <?php if($related->icon): ?>
                        <div class="mb-3">
                            <i class="bi <?php echo e($related->icon); ?> display-4 text-primary"></i>
                        </div>
                        <?php endif; ?>
                        <h3 class="h5 mb-3"><?php echo e($related->title); ?></h3>
                        <p class="text-muted small mb-4"><?php echo e(Str::limit($related->subtitle, 80)); ?></p>
                        <a href="<?php echo e(route('layanan.show', $related->slug)); ?>" class="btn btn-outline-primary btn-sm">
                            Lihat Detail <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 class="h3 mb-2">Tertarik dengan <?php echo e($service->title); ?>?</h2>
                <p class="mb-0">Hubungi kami untuk informasi lebih lanjut dan konsultasi gratis</p>
            </div>
            <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
                <a href="<?php echo e(route('kontakkami')); ?>" class="btn btn-light btn-lg">
                    <i class="bi bi-envelope me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .min-vh-50 {
        min-height: 50vh;
    }
    
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }
    
    .hero-section {
        position: relative;
        overflow: hidden;
    }
    
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        opacity: 0.1;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/layanan/show.blade.php ENDPATH**/ ?>