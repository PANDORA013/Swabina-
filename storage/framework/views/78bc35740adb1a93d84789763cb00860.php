

<?php $__env->startSection('head'); ?>
<?php
    $title = is_array($berita->title) ? $berita->title[app()->getLocale()] ?? $berita->title['id'] : $berita->title;
    $description = is_array($berita->description) ? $berita->description[app()->getLocale()] ?? $berita->description['id'] : $berita->description;
?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => $title . ' - PT Swabina Gatra','description' => Str::limit($description, 160),'keywords' => ['berita', 'artikel', 'swabina'],'url' => ''.e(route('berita.show', $berita->id)).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($title . ' - PT Swabina Gatra'),'description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(Str::limit($description, 160)),'keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['berita', 'artikel', 'swabina']),'url' => ''.e(route('berita.show', $berita->id)).'']); ?>
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
    'headline' => $title,
    'description' => $description,
    'image' => asset('storage/' . $berita->image),
    'datePublished' => $berita->created_at->toIso8601String(),
    'dateModified' => $berita->updated_at->toIso8601String(),
]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('structured-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'article','data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
    'headline' => $title,
    'description' => $description,
    'image' => asset('storage/' . $berita->image),
    'datePublished' => $berita->created_at->toIso8601String(),
    'dateModified' => $berita->updated_at->toIso8601String(),
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
            <i class="bi bi-newspaper"></i> <?php echo e($title); ?>

        </h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(route('beranda')); ?>" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item"><a href="<?php echo e(route('berita')); ?>" class="text-white">Berita</a></li>
                <li class="breadcrumb-item active text-white-50"><?php echo e(Str::limit($title, 50)); ?></li>
            </ol>
        </nav>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <article class="content-article">
                    <!-- Featured Image -->
                    <?php if($berita->image): ?>
                        <div class="mb-4">
                            <img src="<?php echo e(asset('storage/' . $berita->image)); ?>" 
                                 alt="<?php echo e($title); ?>"
                                 class="img-fluid rounded-3 shadow-sm"
                                 style="width: 100%; height: auto; max-height: 500px; object-fit: cover;">
                        </div>
                    <?php else: ?>
                        <div class="placeholder-img rounded-3 mb-4" style="height: 400px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-newspaper" style="font-size: 5rem; color: white;"></i>
                        </div>
                    <?php endif; ?>

                    <!-- Article Meta -->
                    <div class="article-meta mb-4 pb-3 border-bottom">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="text-muted mb-2">
                                    <i class="bi bi-calendar-event"></i>
                                    <strong>Tanggal:</strong> <?php echo e($berita->created_at->format('d F Y')); ?>

                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted mb-0">
                                    <i class="bi bi-clock-history"></i>
                                    <strong>Diperbarui:</strong> <?php echo e($berita->updated_at->format('d F Y H:i')); ?>

                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Article Title -->
                    <h1 class="display-6 fw-bold mb-4"><?php echo e($title); ?></h1>

                    <!-- Article Description -->
                    <div class="article-description mb-4 lead text-muted">
                        <?php echo e($description); ?>

                    </div>

                    <!-- Article Content -->
                    <div class="article-content prose">
                        <p class="fs-5 text-justify">
                            <?php echo e($description); ?>

                        </p>
                    </div>

                    <!-- Share Section -->
                    <div class="share-section mt-5 pt-4 border-top">
                        <h5 class="mb-3">Bagikan Berita Ini</h5>
                        <div class="d-flex gap-2">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(route('berita.show', $berita->id))); ?>" 
                               class="btn btn-outline-primary btn-sm" target="_blank" rel="noopener">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(route('berita.show', $berita->id))); ?>&text=<?php echo e(urlencode($title)); ?>" 
                               class="btn btn-outline-info btn-sm" target="_blank" rel="noopener">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo e(urlencode(route('berita.show', $berita->id))); ?>" 
                               class="btn btn-outline-secondary btn-sm" target="_blank" rel="noopener">
                                <i class="bi bi-linkedin"></i> LinkedIn
                            </a>
                            <a href="https://wa.me/?text=<?php echo e(urlencode($title . ' ' . route('berita.show', $berita->id))); ?>" 
                               class="btn btn-outline-success btn-sm" target="_blank" rel="noopener">
                                <i class="bi bi-whatsapp"></i> WhatsApp
                            </a>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Navigation -->
                <div class="d-grid gap-2 mb-4">
                    <a href="<?php echo e(route('berita')); ?>" class="btn btn-primary">
                        <i class="bi bi-newspaper"></i> Semua Berita
                    </a>
                    <a href="<?php echo e(route('beranda')); ?>" class="btn btn-outline-primary">
                        <i class="bi bi-house"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related News Section -->
<?php if(isset($relatedBerita) && $relatedBerita->count() > 0): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-newspaper"></i> Berita Terkait
            </h2>
            <div class="title-underline"></div>
        </div>

        <div class="row g-4">
            <?php $__currentLoopData = $relatedBerita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-6 col-lg-4">
                <div class="berita-card card h-100 border-0 shadow-sm">
                    <?php if($item->image): ?>
                    <img src="<?php echo e(asset('storage/' . $item->image)); ?>" 
                         class="card-img-top" 
                         alt="<?php echo e($item->title); ?>"
                         style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title fw-semibold">
                            <?php echo e(Str::limit($item->title, 50)); ?>

                        </h5>
                        <p class="card-text text-muted small">
                            <?php echo e(Str::limit($item->description, 100)); ?>

                        </p>
                        <div class="mt-auto">
                            <small class="text-muted d-block mb-2">
                                <i class="bi bi-calendar"></i> <?php echo e($item->created_at->format('d M Y')); ?>

                            </small>
                            <a href="<?php echo e(route('berita.show', $item->id)); ?>" class="btn btn-sm btn-primary">
                                Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/news/show.blade.php ENDPATH**/ ?>