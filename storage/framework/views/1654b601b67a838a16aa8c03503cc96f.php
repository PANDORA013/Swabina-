<?php $__env->startSection('head'); ?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => 'Berita & Artikel - PT Swabina Gatra','description' => 'Berita terkini, artikel, dan update dari PT Swabina Gatra mengenai Facility Management, Digital Solution, dan layanan profesional lainnya.','keywords' => ['Berita Swabina', 'Artikel', 'Update', 'News', 'Facility Management', 'Swabina Gatra'],'image' => asset('images/og-berita.jpg')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Berita & Artikel - PT Swabina Gatra','description' => 'Berita terkini, artikel, dan update dari PT Swabina Gatra mengenai Facility Management, Digital Solution, dan layanan profesional lainnya.','keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Berita Swabina', 'Artikel', 'Update', 'News', 'Facility Management', 'Swabina Gatra']),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(asset('images/og-berita.jpg'))]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.structured-data','data' => ['type' => 'website']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('structured-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'website']); ?>
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
<div class="page-header bg-gradient" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-color) 100%); padding: 4rem 0; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="bi bi-newspaper"></i> Berita & Artikel
                </h1>
                <p class="lead mb-0">Informasi dan update terkini dari PT Swabina Gatra</p>
            </div>
            <div class="col-lg-4 text-end">
                <i class="bi bi-newspaper" style="font-size: 5rem; opacity: 0.2;"></i>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="container py-5">
    <?php if(isset($beritas) && $beritas->count() > 0): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="berita-card card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center d-flex flex-column">
                        
                        <?php if($berita->image): ?>
                            <div class="berita-image mb-3">
                                <img src="<?php echo e(asset('storage/' . $berita->image)); ?>" 
                                     alt="<?php echo e($berita->title); ?>"
                                     loading="lazy"
                                     class="img-fluid"
                                     style="width: 100%; height: 160px; object-fit: cover; border-radius: 8px;">
                            </div>
                        <?php else: ?>
                            <div class="berita-icon mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 160px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                <i class="bi bi-newspaper" style="font-size: 3rem; color: white;"></i>
                            </div>
                        <?php endif; ?>
                        
                        
                        <small class="text-muted mb-2" style="font-size: 0.85rem;">
                            <i class="bi bi-calendar-event"></i> 
                            <?php echo e($berita->created_at->format('d M Y')); ?>

                        </small>
                        
                        
                        <h5 class="card-title fw-bold mb-2" style="min-height: 50px; display: flex; align-items: center; justify-content: center;">
                            <?php echo e(Str::limit($berita->title, 60)); ?>

                        </h5>
                        
                        
                        <p class="card-text" style="font-size: 0.9rem; color: var(--text-gray); min-height: 60px;">
                            <?php echo e(Str::limit(strip_tags($berita->description), 90)); ?>

                        </p>
                        
                        
                        <div class="mt-auto pt-3 border-top">
                            <a href="<?php echo e(route('berita.show', $berita->id)); ?>" class="btn btn-primary btn-sm w-100">
                                <i class="bi bi-arrow-right"></i> Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info text-center py-5" role="alert">
            <i class="bi bi-info-circle" style="font-size: 3rem; display: block; margin-bottom: 1rem; opacity: 0.5;"></i>
            <h5>Belum Ada Berita</h5>
            <p class="text-muted mb-0">Mohon tunggu, berita akan segera ditambahkan.</p>
        </div>
    <?php endif; ?>
</div>


<section class="bg-light py-5">
    <div class="container text-center">
        <h3 class="mb-4">Ingin Mengetahui Lebih Lanjut?</h3>
        <p class="text-muted mb-4">Hubungi kami untuk informasi lengkap tentang layanan dan penawaran terbaru dari PT Swabina Gatra.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="<?php echo e(route('kontakkami')); ?>" class="btn btn-primary">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
            <a href="<?php echo e(route('faq')); ?>" class="btn btn-outline-primary">
                <i class="bi bi-question-circle"></i> FAQ
            </a>
            <a href="<?php echo e(route('beranda')); ?>" class="btn btn-outline-secondary">
                <i class="bi bi-house"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .berita-card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .berita-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .berita-card .card-body {
        padding: 1.5rem;
    }

    .berita-image img {
        transition: transform 0.3s ease;
    }

    .berita-card:hover .berita-image img {
        transform: scale(1.05);
    }

    .page-header {
        margin-bottom: 3rem;
    }

    .page-header h1 {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/news/index.blade.php ENDPATH**/ ?>