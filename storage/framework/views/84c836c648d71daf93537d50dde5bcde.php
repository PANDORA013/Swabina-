

<?php $__env->startSection('head'); ?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => 'Facility Management - Pengelolaan Fasilitas Gedung - PT Swabina Gatra','description' => 'Layanan Facility Management profesional dari PT Swabina Gatra. Solusi lengkap untuk pengelolaan gedung, maintenance, cleaning service, dan security.','keywords' => ['facility management', 'building management', 'cleaning service', 'security service', 'maintenance', 'swabina fm'],'url' => ''.e(route('facility-management')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Facility Management - Pengelolaan Fasilitas Gedung - PT Swabina Gatra','description' => 'Layanan Facility Management profesional dari PT Swabina Gatra. Solusi lengkap untuk pengelolaan gedung, maintenance, cleaning service, dan security.','keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['facility management', 'building management', 'cleaning service', 'security service', 'maintenance', 'swabina fm']),'url' => ''.e(route('facility-management')).'']); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.structured-data','data' => ['type' => 'service','data' => [
    'name' => 'SWA Facility Management',
    'description' => 'Layanan Facility Management profesional',
    'provider' => 'PT Swabina Gatra'
]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('structured-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'service','data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
    'name' => 'SWA Facility Management',
    'description' => 'Layanan Facility Management profesional',
    'provider' => 'PT Swabina Gatra'
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
            <i class="bi bi-building"></i> Facility Management
        </h1>
        <p class="lead">Pengelolaan Fasilitas Gedung Profesional & Terpercaya</p>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <!-- Overview Section -->
    <section class="mb-5">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-info-circle text-primary"></i> Tentang Facility Management Kami
            </h2>
            <div class="title-underline"></div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <p class="text-muted mb-0" style="text-align: justify; line-height: 1.8; font-size: 1.1rem;">
                            SWA Facility Management menyediakan solusi pengelolaan fasilitas yang komprehensif untuk gedung perkantoran, hotel, mal, rumah sakit, dan industri lainnya. Dengan tim profesional dan pengalaman lebih dari 20 tahun, kami memastikan fasilitas Anda berfungsi optimal dan terawat dengan baik.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Breakdown Section -->
    <section class="mb-5">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-briefcase text-primary"></i> Layanan Kami
            </h2>
            <div class="title-underline"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-hammer" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Maintenance & Perawatan</h5>
                        <p class="card-text text-muted small">Perawatan rutin dan perbaikan semua sistem gedung agar selalu berfungsi optimal dan awet.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-broom" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Cleaning Service</h5>
                        <p class="card-text text-muted small">Layanan kebersihan profesional dengan standar sanitasi internasional untuk area interior dan eksterior.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-shield-check" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Security Service</h5>
                        <p class="card-text text-muted small">Layanan keamanan 24 jam dengan personil terlatih dan sistem keamanan teknologi terkini.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-snow" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">HVAC Management</h5>
                        <p class="card-text text-muted small">Pengelolaan sistem ventilasi, pendingin, dan pemanas untuk kenyamanan optimal.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-lightning-fill" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Elektrikal & MEP</h5>
                        <p class="card-text text-muted small">Pengelolaan sistem kelistrikan, mekanis, plumbing, dan utilitas gedung.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-card-text" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Administrasi & Manajemen</h5>
                        <p class="card-text text-muted small">Pengelolaan administrasi, dokumentasi, dan pengurusan izin lingkungan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Percayakan Pengelolaan Fasilitas Anda Kepada Kami</h2>
                <p class="lead mb-4">Dapatkan konsultasi gratis untuk solusi facility management yang tepat untuk kebutuhan gedung Anda.</p>
                <?php
                    $whatsapp = isset($companyInfo) ? ($companyInfo->whatsapp ?? null) : null;
                ?>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="<?php echo e(route('kontakkami')); ?>" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                    </a>
                    <?php if($whatsapp): ?>
                    <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $whatsapp)); ?>" class="btn btn-outline-light btn-lg px-4" target="_blank">
                        <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
.feature-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    margin: 0 auto;
    background: rgba(13, 110, 253, 0.1);
    border-radius: 50%;
}

.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15) !important;
}

.section-title {
    font-size: 2rem;
    font-weight: 700;
    color: #0d6efd;
}

.title-underline {
    width: 60px;
    height: 4px;
    background: #0d6efd;
    border-radius: 2px;
    margin: 1rem auto;
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/produkdanlayanan/facility-management-page.blade.php ENDPATH**/ ?>