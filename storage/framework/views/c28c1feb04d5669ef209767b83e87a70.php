<?php $__env->startSection('head'); ?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => 'Sekilas Perusahaan - PT Swabina Gatra','description' => 'Pelajari tentang sejarah, visi, dan misi PT Swabina Gatra sebagai perusahaan terdepan dalam Facility Management.','keywords' => ['sekilas perusahaan', 'profil perusahaan', 'PT Swabina Gatra', 'about us', 'company profile'],'url' => ''.e(route('sekilas')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Sekilas Perusahaan - PT Swabina Gatra','description' => 'Pelajari tentang sejarah, visi, dan misi PT Swabina Gatra sebagai perusahaan terdepan dalam Facility Management.','keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['sekilas perusahaan', 'profil perusahaan', 'PT Swabina Gatra', 'about us', 'company profile']),'url' => ''.e(route('sekilas')).'']); ?>
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
    'headline' => 'Sekilas Perusahaan PT Swabina Gatra',
    'description' => 'Profil dan sejarah PT Swabina Gatra'
]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('structured-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'article','data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
    'headline' => 'Sekilas Perusahaan PT Swabina Gatra',
    'description' => 'Profil dan sejarah PT Swabina Gatra'
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
            <i class="bi bi-building"></i> Sekilas Perusahaan
        </h1>
        <p class="lead">Mengenal Lebih Dekat Tentang Perjalanan dan Pencapaian Kami</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(route('beranda')); ?>" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-white">Tentang Kami</a></li>
                <li class="breadcrumb-item active text-white-50">Sekilas Perusahaan</li>
            </ol>
        </nav>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Company Overview Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Company Overview -->
                <div class="card border-0 shadow-sm mb-4 hover-lift">
                    <div class="card-body">
                        <h2 class="card-title text-primary mb-3">Tentang Kami</h2>
                        <p>PT Swabina Gatra adalah perusahaan terkemuka di Indonesia yang berspesialisasi dalam penyediaan layanan Facility Management dan berbagai solusi bisnis terpadu. Dengan pengalaman lebih dari 20 tahun, kami telah membangun reputasi solid sebagai mitra terpercaya bagi ribuan perusahaan di berbagai sektor industri.</p>
                        
                        <!-- Company Image -->
                        <div class="my-4">
                            <?php if (isset($component)) { $__componentOriginal3cb029201b89ff90589b1b1bf9728b02 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3cb029201b89ff90589b1b1bf9728b02 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.webp-image','data' => ['src' => 'assets/gambar-sekilas/slide1.jpeg','alt' => 'PT Swabina Gatra Team','class' => 'img-fluid rounded shadow-sm','width' => '600','height' => '400','loading' => 'lazy']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('webp-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => 'assets/gambar-sekilas/slide1.jpeg','alt' => 'PT Swabina Gatra Team','class' => 'img-fluid rounded shadow-sm','width' => '600','height' => '400','loading' => 'lazy']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3cb029201b89ff90589b1b1bf9728b02)): ?>
<?php $attributes = $__attributesOriginal3cb029201b89ff90589b1b1bf9728b02; ?>
<?php unset($__attributesOriginal3cb029201b89ff90589b1b1bf9728b02); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3cb029201b89ff90589b1b1bf9728b02)): ?>
<?php $component = $__componentOriginal3cb029201b89ff90589b1b1bf9728b02; ?>
<?php unset($__componentOriginal3cb029201b89ff90589b1b1bf9728b02); ?>
<?php endif; ?>
                        </div>
                        
                        <h3 class="mt-4 mb-3 text-secondary">Visi Kami</h3>
                        <p>Menjadi penyedia layanan Facility Management terdepan di Asia Tenggara yang dikenal dengan kualitas, inovasi, dan komitmen terhadap kepuasan pelanggan.</p>
                        
                        <h3 class="mt-4 mb-3 text-secondary">Misi Kami</h3>
                        <ul>
                            <li>Menyediakan solusi Facility Management yang comprehensive dan cost-effective</li>
                            <li>Mengembangkan SDM yang profesional dan terampil</li>
                            <li>Memanfaatkan teknologi terkini untuk meningkatkan efisiensi</li>
                            <li>Berkomitmen pada keberlanjutan lingkungan dan tanggung jawab sosial</li>
                            <li>Membangun kemitraan jangka panjang dengan stakeholder</li>
                        </ul>
                        
                        <!-- Second Company Image -->
                        <div class="mt-4">
                            <?php if (isset($component)) { $__componentOriginal3cb029201b89ff90589b1b1bf9728b02 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3cb029201b89ff90589b1b1bf9728b02 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.webp-image','data' => ['src' => 'assets/gambar-sekilas/slide2.jpg','alt' => 'PT Swabina Gatra Facility','class' => 'img-fluid rounded shadow-sm','width' => '600','height' => '400','loading' => 'lazy']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('webp-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => 'assets/gambar-sekilas/slide2.jpg','alt' => 'PT Swabina Gatra Facility','class' => 'img-fluid rounded shadow-sm','width' => '600','height' => '400','loading' => 'lazy']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3cb029201b89ff90589b1b1bf9728b02)): ?>
<?php $attributes = $__attributesOriginal3cb029201b89ff90589b1b1bf9728b02; ?>
<?php unset($__attributesOriginal3cb029201b89ff90589b1b1bf9728b02); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3cb029201b89ff90589b1b1bf9728b02)): ?>
<?php $component = $__componentOriginal3cb029201b89ff90589b1b1bf9728b02; ?>
<?php unset($__componentOriginal3cb029201b89ff90589b1b1bf9728b02); ?>
<?php endif; ?>
                        </div>
                    </div>
                </div>
        
        <!-- Company Highlights -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-trophy text-warning" style="font-size: 2.5rem;"></i>
                        <div class="mt-3 h3">20+</div>
                        <p class="text-muted">Tahun Pengalaman</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-people text-info" style="font-size: 2.5rem;"></i>
                        <div class="mt-3 h3">500+</div>
                        <p class="text-muted">Professional Staff</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-building text-success" style="font-size: 2.5rem;"></i>
                        <div class="mt-3 h3">1000+</div>
                        <p class="text-muted">Klien Setia</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-center h-100">
                    <div class="card-body">
                        <i class="bi bi-patch-check text-primary" style="font-size: 2.5rem;"></i>
                        <div class="mt-3 h3">ISO</div>
                        <p class="text-muted">Certified</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="col-lg-4">
        <!-- Leadership Image -->
        <div class="card border-0 shadow-sm mb-4 hover-lift">
            <?php if (isset($component)) { $__componentOriginal3cb029201b89ff90589b1b1bf9728b02 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3cb029201b89ff90589b1b1bf9728b02 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.webp-image','data' => ['src' => 'assets/gambar_landingpage/foto_direksi.jpeg','class' => 'card-img-top','alt' => 'Direksi PT Swabina Gatra','width' => '300','height' => '250','style' => 'height: 250px; object-fit: cover;','loading' => 'lazy']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('webp-image'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => 'assets/gambar_landingpage/foto_direksi.jpeg','class' => 'card-img-top','alt' => 'Direksi PT Swabina Gatra','width' => '300','height' => '250','style' => 'height: 250px; object-fit: cover;','loading' => 'lazy']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3cb029201b89ff90589b1b1bf9728b02)): ?>
<?php $attributes = $__attributesOriginal3cb029201b89ff90589b1b1bf9728b02; ?>
<?php unset($__attributesOriginal3cb029201b89ff90589b1b1bf9728b02); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3cb029201b89ff90589b1b1bf9728b02)): ?>
<?php $component = $__componentOriginal3cb029201b89ff90589b1b1bf9728b02; ?>
<?php unset($__componentOriginal3cb029201b89ff90589b1b1bf9728b02); ?>
<?php endif; ?>
            <div class="card-body text-center">
                <h5 class="card-title text-primary">Leadership Team</h5>
                <p class="card-text text-muted small">Tim kepemimpinan berpengalaman yang berkomitmen pada keunggulan</p>
            </div>
        </div>
        
        <!-- Quick Facts -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header">
                <i class="bi bi-lightbulb me-2"></i>Fakta Cepat
            </div>
            <div class="card-body">
                <ul style="list-style: none; padding: 0;">
                    <li class="mb-3 pb-3 border-bottom">
                        <strong>Didirikan:</strong><br>2003
                    </li>
                    <li class="mb-3 pb-3 border-bottom">
                        <strong>Lokasi Utama:</strong><br>Gresik, Jawa Timur
                    </li>
                    <li class="mb-3 pb-3 border-bottom">
                        <strong>Sektor Utama:</strong><br>Facility Management
                    </li>
                    <li>
                        <strong>Sertifikasi:</strong><br>ISO 9001, ISO 14001, SMK3
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Call to Action -->
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title">Tertarik Bekerja Sama?</h5>
                <p class="card-text text-muted">Hubungi tim kami untuk mendiskusikan kebutuhan Facility Management Anda.</p>
                <a href="<?php echo e(route('kontakkami')); ?>" class="btn btn-primary w-100">
                    <i class="bi bi-envelope me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </div>
        </div>
    </div>
</section>

<!-- Core Values Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-gem text-primary"></i> Nilai-Nilai Inti Kami
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">Prinsip yang memandu setiap keputusan dan tindakan kami</p>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <img src="<?php echo e(asset('assets/gambar_mengapa/integrity.jpg')); ?>" 
                         class="card-img-top" 
                         alt="Integritas" 
                         style="height: 180px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-body text-center">
                        <i class="bi bi-shield-check text-primary" style="font-size: 2.5rem;"></i>
                        <h4 class="card-title mt-3">Integritas</h4>
                        <p class="card-text text-muted">Kami berkomitmen pada kejujuran dan transparansi dalam setiap aspek bisnis kami.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <img src="<?php echo e(asset('assets/gambar_mengapa/excellent.jpg')); ?>" 
                         class="card-img-top" 
                         alt="Keunggulan" 
                         style="height: 180px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-body text-center">
                        <i class="bi bi-star text-warning" style="font-size: 2.5rem;"></i>
                        <h4 class="card-title mt-3">Keunggulan</h4>
                        <p class="card-text text-muted">Kami selalu berusaha memberikan kualitas terbaik dalam setiap layanan.</p>
                    </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm hover-lift">
                <img src="<?php echo e(asset('assets/gambar_mengapa/professional.jpg')); ?>" 
                     class="card-img-top" 
                     alt="Komitmen" 
                     style="height: 180px; object-fit: cover;"
                     loading="lazy">
                <div class="card-body text-center">
                    <i class="bi bi-heart text-danger" style="font-size: 2.5rem;"></i>
                    <h4 class="card-title mt-3">Komitmen</h4>
                    <p class="card-text text-muted">Dedikasi kami kepada kepuasan pelanggan adalah prioritas utama.</p>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/tentangkami/sekilas-professional.blade.php ENDPATH**/ ?>