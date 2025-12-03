<?php $__env->startSection('head'); ?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => 'Facility Management - PT Swabina Gatra','description' => 'Layanan manajemen fasilitas profesional dan terpadu dari PT Swabina Gatra','keywords' => ['swabina', 'facility management', 'manajemen fasilitas', 'building management'],'url' => ''.e(route('facility-management')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Facility Management - PT Swabina Gatra','description' => 'Layanan manajemen fasilitas profesional dan terpadu dari PT Swabina Gatra','keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['swabina', 'facility management', 'manajemen fasilitas', 'building management']),'url' => ''.e(route('facility-management')).'']); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-building"></i> SWA Facility Management
        </h1>
        <p class="lead">Solusi Manajemen Fasilitas Profesional dan Terpadu</p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <!-- Overview Section -->
    <section class="mb-5">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-info-circle text-primary"></i> Tentang Layanan Kami
            </h2>
            <div class="title-underline"></div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <p class="text-muted mb-0" style="text-align: justify; line-height: 1.8; font-size: 1.1rem;">
                            SWA Facility Management menyediakan layanan manajemen fasilitas yang komprehensif dan profesional untuk gedung, perkantoran, dan kawasan industri. Kami berkomitmen memberikan solusi terbaik dalam pengelolaan fasilitas dengan standar internasional dan didukung oleh tim yang berpengalaman.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan -->
    <section class="mb-5">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-list-check text-primary"></i> Layanan Kami
            </h2>
            <div class="title-underline"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-tools display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Maintenance & Repair</h5>
                        <p class="card-text text-muted">Pemeliharaan dan perbaikan sistem mekanikal, elektrikal, dan plumbing</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-droplet display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Cleaning Service</h5>
                        <p class="card-text text-muted">Layanan kebersihan rutin dan deep cleaning untuk gedung dan fasilitas</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-shield-check display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Security Management</h5>
                        <p class="card-text text-muted">Pengelolaan keamanan gedung dengan sistem dan personel terlatih</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-tree display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Landscaping</h5>
                        <p class="card-text text-muted">Penataan dan pemeliharaan taman dan area hijau</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-bug display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Pest Control</h5>
                        <p class="card-text text-muted">Pengendalian hama dan sanitasi lingkungan</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-recycle display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Waste Management</h5>
                        <p class="card-text text-muted">Pengelolaan sampah dan limbah yang ramah lingkungan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Keunggulan -->
    <section class="mb-5">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-star text-primary"></i> Keunggulan Kami
            </h2>
            <div class="title-underline"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill text-primary fs-3"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Tenaga Profesional</h5>
                        <p class="text-muted">Tim yang terlatih dan bersertifikat dalam bidangnya</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill text-primary fs-3"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Standar Internasional</h5>
                        <p class="text-muted">Mengikuti standar ISO dalam setiap layanan</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill text-primary fs-3"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Teknologi Modern</h5>
                        <p class="text-muted">Menggunakan peralatan dan sistem terkini</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill text-primary fs-3"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Layanan 24/7</h5>
                        <p class="text-muted">Siap melayani kebutuhan fasilitas Anda kapan saja</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white p-5">
                <h2 class="mb-3">Wujudkan Fasilitas yang Optimal</h2>
                <p class="lead mb-4">Percayakan pengelolaan fasilitas Anda kepada ahlinya</p>
                <a href="<?php echo e(route('kontakkami')); ?>" class="btn btn-light btn-lg px-5">
                    <i class="bi bi-telephone me-2"></i> Hubungi Kami
                </a>
            </div>
        </div>
    </section>
</div>

<style>
    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    }

    .section-title {
        font-weight: 700;
        color: #2c3e50;
    }

    .title-underline {
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #0d6efd, #0a58ca);
        margin: 0 auto;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/produkdanlayanan/facility-management-page.blade.php ENDPATH**/ ?>