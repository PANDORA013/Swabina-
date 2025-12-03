<?php $__env->startSection('head'); ?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => 'SWA Academy - PT Swabina Gatra','description' => 'Program pelatihan dan pengembangan SDM profesional dari PT Swabina Gatra','keywords' => ['swabina', 'academy', 'pelatihan', 'training', 'sertifikasi'],'url' => ''.e(route('swaacademy')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'SWA Academy - PT Swabina Gatra','description' => 'Program pelatihan dan pengembangan SDM profesional dari PT Swabina Gatra','keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['swabina', 'academy', 'pelatihan', 'training', 'sertifikasi']),'url' => ''.e(route('swaacademy')).'']); ?>
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
            <i class="bi bi-mortarboard"></i> SWA Academy
        </h1>
        <p class="lead">Program Pelatihan dan Pengembangan SDM Profesional</p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <!-- Overview Section -->
    <section class="mb-5">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-info-circle text-primary"></i> Tentang SWA Academy
            </h2>
            <div class="title-underline"></div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <p class="text-muted mb-0" style="text-align: justify; line-height: 1.8; font-size: 1.1rem;">
                            SWA Academy adalah divisi pelatihan dan pengembangan SDM dari PT Swabina Gatra yang berkomitmen untuk meningkatkan kompetensi dan profesionalisme sumber daya manusia di berbagai bidang industri. Kami menyediakan program pelatihan yang disesuaikan dengan kebutuhan industri dan standar internasional.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Pelatihan -->
    <section class="mb-5">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-book text-primary"></i> Program Pelatihan
            </h2>
            <div class="title-underline"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-person-badge display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Pelatihan Teknis</h5>
                        <p class="card-text text-muted">Program pelatihan keterampilan teknis sesuai bidang industri</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-people display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Soft Skills</h5>
                        <p class="card-text text-muted">Pengembangan kemampuan komunikasi dan kepemimpinan</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-award display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Sertifikasi</h5>
                        <p class="card-text text-muted">Program sertifikasi profesi sesuai standar nasional dan internasional</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-laptop display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Pelatihan Digital</h5>
                        <p class="card-text text-muted">Program pelatihan teknologi informasi dan digital</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-shield-check display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">K3 & Safety</h5>
                        <p class="card-text text-muted">Pelatihan Keselamatan dan Kesehatan Kerja</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-box mb-3">
                            <i class="bi bi-graph-up display-4 text-primary"></i>
                        </div>
                        <h5 class="card-title">Manajemen</h5>
                        <p class="card-text text-muted">Program pelatihan manajemen dan kepemimpinan</p>
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
                        <h5>Instruktur Berpengalaman</h5>
                        <p class="text-muted">Tim instruktur profesional dengan pengalaman industri yang luas</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill text-primary fs-3"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Kurikulum Terstruktur</h5>
                        <p class="text-muted">Materi pelatihan yang disesuaikan dengan kebutuhan industri terkini</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill text-primary fs-3"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Sertifikat Resmi</h5>
                        <p class="text-muted">Sertifikat yang diakui oleh industri dan lembaga pemerintah</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="d-flex align-items-start">
                    <div class="flex-shrink-0">
                        <i class="bi bi-check-circle-fill text-primary fs-3"></i>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h5>Fasilitas Lengkap</h5>
                        <p class="text-muted">Ruang pelatihan modern dengan peralatan yang memadai</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white p-5">
                <h2 class="mb-3">Tingkatkan Kompetensi SDM Anda</h2>
                <p class="lead mb-4">Hubungi kami untuk informasi program pelatihan yang sesuai dengan kebutuhan perusahaan Anda</p>
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

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/produkdanlayanan/swaacademy-page.blade.php ENDPATH**/ ?>