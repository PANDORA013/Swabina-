


<?php $__env->startSection('head'); ?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => 'Beranda - PT Swabina Gatra','description' => 'PT Swabina Gatra adalah perusahaan terdepan dalam Facility Management & Services di Indonesia dengan sertifikasi ISO lengkap dan pengalaman puluhan tahun.','keywords' => ['Swabina Gatra', 'Facility Management', 'ISO 9001', 'ISO 14001', 'ISO 45001', 'Digital Solution', 'AMDK', 'Training', 'Tour Organizer'],'image' => asset('images/og-beranda.jpg')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Beranda - PT Swabina Gatra','description' => 'PT Swabina Gatra adalah perusahaan terdepan dalam Facility Management & Services di Indonesia dengan sertifikasi ISO lengkap dan pengalaman puluhan tahun.','keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Swabina Gatra', 'Facility Management', 'ISO 9001', 'ISO 14001', 'ISO 45001', 'Digital Solution', 'AMDK', 'Training', 'Tour Organizer']),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(asset('images/og-beranda.jpg'))]); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.structured-data','data' => ['type' => 'organization']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('structured-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'organization']); ?>
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
<div class="hero-section">
    <?php if(isset($carousels) && $carousels->count() > 0): ?>
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-indicators">
            <?php $__currentLoopData = $carousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo e($index); ?>" 
                    class="<?php echo e($index === 0 ? 'active' : ''); ?>" aria-label="Slide <?php echo e($index + 1); ?>"></button>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <div class="carousel-inner">
            <?php $__currentLoopData = $carousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="carousel-item <?php echo e($index === 0 ? 'active' : ''); ?>">
                <img src="<?php echo e(asset('images/carousel/' . $carousel->image)); ?>" 
                     class="d-block w-100" 
                     alt="<?php echo e($carousel->title); ?>"
                     loading="<?php echo e($index === 0 ? 'eager' : 'lazy'); ?>">
                <div class="carousel-caption">
                    <div class="container">
                        <h1 class="display-4 fw-bold"><?php echo e($carousel->title); ?></h1>
                        <p class="lead"><?php echo e($carousel->description); ?></p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php else: ?>
    <div class="default-hero">
        <h1 class="display-3 fw-bold">PT Swabina Gatra</h1>
        <p class="lead">Leading Facility Management & Services</p>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="container">
    
    
    <?php if(isset($sekilasPerusahaan) && $sekilasPerusahaan->count() > 0): ?>
    <section class="mb-5">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-building"></i> Sekilas Perusahaan
            </h2>
            <div class="title-underline"></div>
        </div>
        
        <div class="row g-4">
            <?php $__currentLoopData = $sekilasPerusahaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sekilas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-12">
                <div class="card h-100 border-0 shadow-sm">
                    <?php if($sekilas->image): ?>
                    <img src="<?php echo e(asset('images/sekilas/' . $sekilas->image)); ?>" 
                         class="card-img-top" 
                         alt="<?php echo e($sekilas->title); ?>"
                         loading="lazy"
                         style="max-height: 400px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <h3 class="card-title"><?php echo e($sekilas->title); ?></h3>
                        <div class="card-text">
                            <?php echo $sekilas->content; ?>

                        </div>
                        <a href="<?php echo e(route('sekilas')); ?>" class="btn btn-primary mt-3">
                            <i class="bi bi-arrow-right-circle"></i> Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>
    
    
    <section class="mb-5 bg-light p-4 rounded">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-briefcase"></i> Layanan Kami
            </h2>
            <div class="title-underline"></div>
        </div>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center">
                        <div class="service-icon mb-3">
                            <i class="bi bi-building-gear" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                        <h4 class="card-title">Facility Management</h4>
                        <p class="card-text">Layanan pengelolaan fasilitas profesional untuk gedung dan perkantoran.</p>
                        <a href="<?php echo e(route('facility-management')); ?>" class="btn btn-primary">
                            <i class="bi bi-arrow-right"></i> Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center">
                        <div class="service-icon mb-3">
                            <i class="bi bi-cpu" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                        <h4 class="card-title">Digital Solution</h4>
                        <p class="card-text">Solusi teknologi digital untuk transformasi bisnis Anda.</p>
                        <a href="<?php echo e(route('digitalsolution')); ?>" class="btn btn-primary">
                            <i class="bi bi-arrow-right"></i> Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center">
                        <div class="service-icon mb-3">
                            <i class="bi bi-mortarboard" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                        <h4 class="card-title">SWA Academy</h4>
                        <p class="card-text">Pelatihan dan pengembangan SDM profesional.</p>
                        <a href="<?php echo e(route('swaacademy')); ?>" class="btn btn-primary">
                            <i class="bi bi-arrow-right"></i> Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center">
                        <div class="service-icon mb-3">
                            <i class="bi bi-geo-alt" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                        <h4 class="card-title">SWA Tour Organizer</h4>
                        <p class="card-text">Layanan travel dan tour organizer profesional.</p>
                        <a href="<?php echo e(route('swatour')); ?>" class="btn btn-primary">
                            <i class="bi bi-arrow-right"></i> Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center">
                        <div class="service-icon mb-3">
                            <i class="bi bi-droplet" style="font-size: 3rem; color: var(--primary-color);"></i>
                        </div>
                        <h4 class="card-title">Swasegar AMDK</h4>
                        <p class="card-text">Air minum dalam kemasan berkualitas tinggi.</p>
                        <a href="<?php echo e(route('swasegar')); ?>" class="btn btn-primary">
                            <i class="bi bi-arrow-right"></i> Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
    <?php if(isset($beritas) && $beritas->count() > 0): ?>
    <section class="mb-5 bg-light p-4 rounded">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-newspaper"></i> Berita Terbaru
            </h2>
            <div class="title-underline"></div>
        </div>

        <div class="row g-4">
            <?php $__currentLoopData = $beritas->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4">
                <div class="service-card card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center">
                        <div class="service-icon mb-3">
                            <?php if($berita->image): ?>
                                <img src="<?php echo e(asset('storage/' . $berita->image)); ?>" 
                                     alt="<?php echo e(is_array($berita->title) ? $berita->title[app()->getLocale()] ?? $berita->title['id'] : $berita->title); ?>"
                                     loading="lazy"
                                     style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                            <?php else: ?>
                                <div style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; border-radius: 8px; margin: 0 auto;">
                                    <i class="bi bi-newspaper" style="font-size: 2.5rem; color: white;"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <h4 class="card-title">
                            <?php echo e(Str::limit(is_array($berita->title) ? $berita->title[app()->getLocale()] ?? $berita->title['id'] : $berita->title, 45)); ?>

                        </h4>
                        <p class="card-text" style="font-size: 0.9rem; color: var(--text-gray);">
                            <?php echo e(Str::limit(is_array($berita->description) ? $berita->description[app()->getLocale()] ?? $berita->description['id'] : $berita->description, 70)); ?>

                        </p>
                        <a href="<?php echo e(route('berita.show', $berita->id)); ?>" class="btn btn-primary">
                            <i class="bi bi-arrow-right"></i> Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    
    <section class="cta-section mb-5">
        <div class="card bg-primary text-white border-0 shadow-lg">
            <div class="card-body text-center py-5">
                <h2 class="display-6 fw-bold mb-3">Siap Bermitra dengan Kami?</h2>
                <p class="lead mb-4">Hubungi kami untuk solusi terbaik kebutuhan bisnis Anda</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="<?php echo e(route('kontakkami')); ?>" class="btn btn-light btn-lg">
                        <i class="bi bi-envelope"></i> Hubungi Kami
                    </a>
                    <a href="<?php echo e(route('faq')); ?>" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-question-circle"></i> FAQ
                    </a>
                    <a href="<?php echo e(route('berita')); ?>" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-newspaper"></i> Berita Terbaru
                    </a>
                </div>
            </div>
        </div>
    </section>
    
</div>

<style>
.hero-section {
    margin-bottom: 3rem;
}

.carousel-item img {
    height: 500px;
    object-fit: cover;
}

.carousel-caption {
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    bottom: 0;
    left: 0;
    right: 0;
    padding: 3rem 0;
}

.default-hero {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    color: white;
    padding: 8rem 2rem;
    text-align: center;
    border-radius: 8px;
}

.section-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.title-underline {
    width: 60px;
    height: 4px;
    background: var(--primary-color);
    margin: 0 auto 2rem;
    border-radius: 2px;
}

.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
}

.berita-card {
    overflow: hidden;
    border-radius: 8px;
}

.berita-card-item {
    transition: all 0.3s ease;
    border-radius: 8px;
}

.berita-card-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2) !important;
}

.berita-card-item .card-img-top {
    transition: transform 0.3s ease;
}

.berita-card-item:hover .card-img-top {
    transform: scale(1.05);
}

.berita-card .carousel-inner {
    border-radius: 8px 8px 0 0;
}

.berita-card .carousel-control-prev,
.berita-card .carousel-control-next {
    opacity: 0;
    transition: opacity 0.3s ease;
}

.berita-card:hover .carousel-control-prev,
.berita-card:hover .carousel-control-next {
    opacity: 1;
}

.berita-card .carousel-control-prev-icon,
.berita-card .carousel-control-next-icon {
    filter: drop-shadow(1px 1px 2px rgba(0, 0, 0, 0.5));
}

.placeholder-img {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}

.service-card .card-body {
    padding: 2rem;
}

.cta-section .card {
    background: linear-gradient(135deg, var(--primary-color) 0%, #004494 100%);
}

@media (max-width: 768px) {
    .carousel-item img {
        height: 300px;
    }
    
    .carousel-caption {
        padding: 1.5rem 0;
    }
    
    .carousel-caption h1 {
        font-size: 1.5rem;
    }
    
    .carousel-caption p {
        font-size: 0.9rem;
    }
}
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/beranda/landingpage-professional.blade.php ENDPATH**/ ?>