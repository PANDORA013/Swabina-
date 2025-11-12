

<?php $__env->startSection('head'); ?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => 'Jejak Langkah Perusahaan - PT Swabina Gatra','description' => 'Sejarah dan perjalanan PT Swabina Gatra dari awal berdiri hingga menjadi perusahaan terkemuka di bidang facility management dan layanan terpadu.','keywords' => ['sejarah swabina', 'jejak langkah', 'perjalanan perusahaan', 'milestone swabina', 'company history'],'url' => ''.e(route('jejaklangkah')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Jejak Langkah Perusahaan - PT Swabina Gatra','description' => 'Sejarah dan perjalanan PT Swabina Gatra dari awal berdiri hingga menjadi perusahaan terkemuka di bidang facility management dan layanan terpadu.','keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['sejarah swabina', 'jejak langkah', 'perjalanan perusahaan', 'milestone swabina', 'company history']),'url' => ''.e(route('jejaklangkah')).'']); ?>
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
    'headline' => 'Jejak Langkah Perusahaan',
    'description' => 'Sejarah dan perjalanan PT Swabina Gatra'
]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('structured-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'article','data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
    'headline' => 'Jejak Langkah Perusahaan',
    'description' => 'Sejarah dan perjalanan PT Swabina Gatra'
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
            <i class="bi bi-clock-history"></i> Jejak Langkah
        </h1>
        <p class="lead">Perjalanan dan Pencapaian PT Swabina Gatra</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(route('beranda')); ?>" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-white">Tentang Kami</a></li>
                <li class="breadcrumb-item active text-white-50">Jejak Langkah</li>
            </ol>
        </nav>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Timeline Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-calendar-event text-primary"></i> Timeline Pencapaian
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">Perjalanan kami dari waktu ke waktu</p>
        </div>

        <div class="timeline">
            <?php $__currentLoopData = $jejakLangkahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $jejak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="timeline-item <?php echo e($index % 2 == 0 ? 'left' : 'right'); ?>">
                <div class="timeline-card card border-0 shadow-sm hover-lift">
                    <div class="card-body p-4">
                        <div class="timeline-year">
                            <span class="badge bg-primary fs-5 px-4 py-2"><?php echo e($jejak->tahun); ?></span>
                        </div>
                        <h3 class="card-title h5 fw-bold text-primary mb-3"><?php echo e($jejak->judul); ?></h3>
                        <p class="card-text text-muted mb-0" style="text-align: justify; line-height: 1.8;">
                            <?php echo e($jejak->deskripsi); ?>

                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Buat Sejarah Bersama Kami</h2>
                <p class="lead mb-4">Mari bergabung dan menjadi bagian dari pencapaian kami selanjutnya</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="<?php echo e(route('sekilas')); ?>" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-building me-2"></i>Tentang Kami
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
.timeline {
    position: relative;
    padding: 2rem 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(to bottom, #0d6efd, #0a58ca);
    transform: translateX(-50%);
}

.timeline-item {
    position: relative;
    margin-bottom: 3rem;
    width: 50%;
    padding: 0 2rem;
}

.timeline-item.left {
    left: 0;
    text-align: right;
}

.timeline-item.right {
    left: 50%;
    text-align: left;
}

.timeline-item::before {
    content: '';
    position: absolute;
    top: 20px;
    width: 20px;
    height: 20px;
    background: #0d6efd;
    border: 4px solid white;
    border-radius: 50%;
    box-shadow: 0 0 0 4px #0d6efd;
    z-index: 1;
}

.timeline-item.left::before {
    right: -10px;
}

.timeline-item.right::before {
    left: -10px;
}

.timeline-card {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
}

.timeline-year {
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .timeline::before {
        left: 20px;
    }
    
    .timeline-item {
        width: 100%;
        left: 0 !important;
        text-align: left !important;
        padding-left: 60px;
        padding-right: 1rem;
    }
    
    .timeline-item::before {
        left: 11px !important;
    }
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

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/tentangkami/jejaklangkah-professional.blade.php ENDPATH**/ ?>