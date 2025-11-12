

<?php $__env->startSection('head'); ?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => 'Sertifikat & Penghargaan - PT Swabina Gatra','description' => 'Sertifikat dan penghargaan yang telah diraih PT Swabina Gatra sebagai bukti komitmen kami dalam memberikan layanan berkualitas tinggi.','keywords' => ['sertifikat swabina', 'penghargaan', 'sertifikasi', 'awards', 'ISO certification'],'url' => ''.e(route('sertif')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Sertifikat & Penghargaan - PT Swabina Gatra','description' => 'Sertifikat dan penghargaan yang telah diraih PT Swabina Gatra sebagai bukti komitmen kami dalam memberikan layanan berkualitas tinggi.','keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['sertifikat swabina', 'penghargaan', 'sertifikasi', 'awards', 'ISO certification']),'url' => ''.e(route('sertif')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal84f9df3f620371229981225e7ba608d7)): ?>
<?php $attributes = $__attributesOriginal84f9df3f620371229981225e7ba608d7; ?>
<?php unset($__attributesOriginal84f9df3f620371229981225e7ba608d7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal84f9df3f620371229981225e7ba608d7)): ?>
<?php $component = $__componentOriginal84f9df3f620371229981225e7ba608d7; ?>
<?php unset($__componentOriginal84f9df3f620371229981225e7ba608d7); ?>
<?php endif; ?>
<?php if (isset($component)) { $__componentOriginal0ca6c402d3013c24b5dc26ae1e2d2fa5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0ca6c402d3013c24b5dc26ae1e2d2fa5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.structured-data','data' => ['type' => 'article','data' => [
    'headline' => 'Sertifikat & Penghargaan',
    'description' => 'Sertifikat dan penghargaan PT Swabina Gatra'
]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('structured-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'article','data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
    'headline' => 'Sertifikat & Penghargaan',
    'description' => 'Sertifikat dan penghargaan PT Swabina Gatra'
])]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0ca6c402d3013c24b5dc26ae1e2d2fa5)): ?>
<?php $attributes = $__attributesOriginal0ca6c402d3013c24b5dc26ae1e2d2fa5; ?>
<?php unset($__attributesOriginal0ca6c402d3013c24b5dc26ae1e2d2fa5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0ca6c402d3013c24b5dc26ae1e2d2fa5)): ?>
<?php $component = $__componentOriginal0ca6c402d3013c24b5dc26ae1e2d2fa5; ?>
<?php unset($__componentOriginal0ca6c402d3013c24b5dc26ae1e2d2fa5); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-award-fill"></i> Sertifikat & Penghargaan
        </h1>
        <p class="lead">Bukti Komitmen Kami dalam Memberikan Layanan Terbaik</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(route('beranda')); ?>" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-white">Tentang Kami</a></li>
                <li class="breadcrumb-item active text-white-50">Sertifikat & Penghargaan</li>
            </ol>
        </nav>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Sertifikat Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-trophy text-warning"></i> Pencapaian Kami
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">Sertifikasi dan penghargaan yang membuktikan kualitas layanan kami</p>
        </div>

        <div class="row g-4">
            <?php if($sertifikatPenghargaan && $sertifikatPenghargaan->count() > 0): ?>
            <?php $__currentLoopData = $sertifikatPenghargaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sertifikat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift certificate-card">
                    <div class="card-img-wrapper">
                        <?php if($sertifikat->gambar): ?>
                            <img src="<?php echo e(asset('storage/sertifikat_penghargaans/' . $sertifikat->gambar)); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo e($sertifikat->judul); ?>"
                                 style="height: 300px; object-fit: cover;">
                        <?php else: ?>
                            <div class="placeholder-img bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                <i class="bi bi-award text-muted" style="font-size: 4rem;"></i>
                            </div>
                        <?php endif; ?>
                        <div class="card-img-overlay-hover">
                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#certificateModal<?php echo e($sertifikat->id); ?>">
                                <i class="bi bi-zoom-in"></i> Lihat Detail
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="certificate-badge mb-2">
                            <span class="badge bg-primary">
                                <i class="bi bi-patch-check-fill me-1"></i>Verified
                            </span>
                        </div>
                        <h5 class="card-title fw-bold"><?php echo e($sertifikat->judul); ?></h5>
                        <p class="card-text text-muted small"><?php echo e($sertifikat->deskripsi); ?></p>
                    </div>
                </div>
            </div>

            <!-- Modal for Certificate Detail -->
            <div class="modal fade" id="certificateModal<?php echo e($sertifikat->id); ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title"><?php echo e($sertifikat->judul); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            <?php if($sertifikat->gambar): ?>
                                <img src="<?php echo e(asset('storage/sertifikat_penghargaans/' . $sertifikat->gambar)); ?>" 
                                     class="img-fluid" 
                                     alt="<?php echo e($sertifikat->judul); ?>">
                            <?php endif; ?>
                            <p class="mt-3 text-muted"><?php echo e($sertifikat->deskripsi); ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="alert alert-info text-center py-5" role="alert">
                <i class="bi bi-info-circle me-2"></i>
                <span>Sertifikat dan penghargaan akan segera ditampilkan.</span>
            </div>
        <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Percayakan Kebutuhan Anda pada Kami</h2>
                <p class="lead mb-4">Dengan sertifikasi dan pengalaman yang telah teruji</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="<?php echo e(route('facility-management')); ?>" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-briefcase-fill me-2"></i>Lihat Layanan
                    </a>
                    <a href="<?php echo e(route('kontakkami')); ?>" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
.certificate-card {
    transition: all 0.3s ease;
    overflow: hidden;
}

.hover-lift:hover {
    transform: translateY(-10px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
}

.card-img-wrapper {
    position: relative;
    overflow: hidden;
}

.card-img-wrapper img {
    transition: transform 0.3s ease;
}

.certificate-card:hover .card-img-wrapper img {
    transform: scale(1.1);
}

.card-img-overlay-hover {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.certificate-card:hover .card-img-overlay-hover {
    opacity: 1;
}

.certificate-badge {
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
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
    opacity: 0.5;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/tentangkami/sertifikat-professional.blade.php ENDPATH**/ ?>