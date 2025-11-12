

<?php $__env->startSection('head'); ?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => 'Berita & Artikel Terbaru - PT Swabina Gatra','description' => 'Berita terbaru, artikel, dan informasi seputar layanan PT Swabina Gatra. Tetap update dengan perkembangan perusahaan kami.','keywords' => ['berita swabina', 'artikel', 'news', 'company news', 'press release'],'url' => ''.e(route('berita')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Berita & Artikel Terbaru - PT Swabina Gatra','description' => 'Berita terbaru, artikel, dan informasi seputar layanan PT Swabina Gatra. Tetap update dengan perkembangan perusahaan kami.','keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['berita swabina', 'artikel', 'news', 'company news', 'press release']),'url' => ''.e(route('berita')).'']); ?>
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
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-newspaper"></i> Berita & Artikel
        </h1>
        <p class="lead">Informasi Terbaru dari PT Swabina Gatra</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(route('beranda')); ?>" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item active text-white-50">Berita</li>
            </ol>
        </nav>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Berita Section -->
<section class="py-5">
    <div class="container">
        <?php if($berita->count() > 0): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4">
                <article class="card h-100 border-0 shadow-sm hover-lift news-card">
                    <div class="card-img-wrapper">
                        <?php if($item->gambar): ?>
                            <img src="<?php echo e(asset('storage/beritas/' . $item->gambar)); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo e($item->judul); ?>"
                                 width="400"
                                 height="250"
                                 style="height: 250px; object-fit: cover;"
                                 loading="lazy"
                                 decoding="async"
                                 fetchpriority="<?php echo e($loop->index < 3 ? 'high' : 'low'); ?>">
                        <?php else: ?>
                            <?php
                                $fallbackImages = ['berita1.jpg', 'berita2.jpeg', 'berita3.jpg', 'berita4.jpg', 'berita5.jpg', 'berita6.jpg', 'berita7.png'];
                                $randomImage = $fallbackImages[($loop->index % count($fallbackImages))];
                            ?>
                            <img src="<?php echo e(asset('assets/gambar_berita/' . $randomImage)); ?>" 
                                 class="card-img-top" 
                                 alt="<?php echo e($item->judul); ?>"
                                 width="400"
                                 height="250"
                                 style="height: 250px; object-fit: cover;"
                                 loading="lazy"
                                 decoding="async"
                                 fetchpriority="<?php echo e($loop->index < 3 ? 'high' : 'low'); ?>">
                        <?php endif; ?>
                        <div class="news-date-badge">
                            <span class="badge bg-primary">
                                <i class="bi bi-calendar3 me-1"></i><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d M Y')); ?>

                            </span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-light text-dark">
                                <i class="bi bi-tag-fill me-1"></i>Berita
                            </span>
                        </div>
                        <h5 class="card-title fw-bold mb-3"><?php echo e($item->judul); ?></h5>
                        <p class="card-text text-muted flex-grow-1" style="text-align: justify;">
                            <?php echo e(Str::limit(strip_tags($item->deskripsi), 120)); ?>

                        </p>
                        <button class="btn btn-outline-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#newsModal<?php echo e($item->id); ?>">
                            <i class="bi bi-arrow-right-circle me-1"></i>Baca Selengkapnya
                        </button>
                    </div>
                </article>
            </div>

            <!-- Modal for News Detail -->
            <div class="modal fade" id="newsModal<?php echo e($item->id); ?>" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold"><?php echo e($item->judul); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <?php if($item->gambar): ?>
                                <img src="<?php echo e(asset('storage/beritas/' . $item->gambar)); ?>" 
                                     class="img-fluid rounded mb-4" 
                                     alt="<?php echo e($item->judul); ?>">
                            <?php endif; ?>
                            <div class="mb-3">
                                <span class="badge bg-primary me-2">
                                    <i class="bi bi-calendar3 me-1"></i><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('d F Y')); ?>

                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-tag-fill me-1"></i>Berita
                                </span>
                            </div>
                            <div class="news-content" style="text-align: justify; line-height: 1.8;">
                                <?php echo nl2br(e($item->deskripsi)); ?>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <div class="text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 5rem;"></i>
            <h3 class="mt-4 text-muted">Belum Ada Berita</h3>
            <p class="text-muted">Berita akan ditampilkan di sini</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Butuh Informasi Lebih Lanjut?</h2>
                <p class="lead mb-4">Hubungi tim kami untuk mendapatkan informasi detail</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="<?php echo e(route('kontakkami')); ?>" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                    </a>
                    <a href="<?php echo e(route('faq')); ?>" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-question-circle-fill me-2"></i>FAQ
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
.news-card {
    transition: all 0.3s ease;
    overflow: hidden;
    content-visibility: auto;
    contain-intrinsic-size: 0 500px;
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
    will-change: transform;
}

.news-card:hover .card-img-wrapper img {
    transform: scale(1.1);
}

.news-date-badge {
    position: absolute;
    top: 15px;
    right: 15px;
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

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/berita/berita-professional.blade.php ENDPATH**/ ?>