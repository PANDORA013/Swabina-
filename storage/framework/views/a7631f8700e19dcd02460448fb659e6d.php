'

<?php $__env->startSection('head'); ?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => 'Mengapa Memilih Kami - PT Swabina Gatra','description' => 'Alasan mengapa Anda harus memilih PT Swabina Gatra sebagai mitra terpercaya untuk solusi facility management dan layanan terpadu.','keywords' => ['keunggulan swabina', 'mengapa memilih', 'why choose us', 'benefit', 'advantage'],'url' => ''.e(route('memilihkami')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Mengapa Memilih Kami - PT Swabina Gatra','description' => 'Alasan mengapa Anda harus memilih PT Swabina Gatra sebagai mitra terpercaya untuk solusi facility management dan layanan terpadu.','keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['keunggulan swabina', 'mengapa memilih', 'why choose us', 'benefit', 'advantage']),'url' => ''.e(route('memilihkami')).'']); ?>
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
    'headline' => 'Mengapa Memilih PT Swabina Gatra',
    'description' => 'Keunggulan dan benefit memilih PT Swabina Gatra'
]]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('structured-data'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'article','data' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute([
    'headline' => 'Mengapa Memilih PT Swabina Gatra',
    'description' => 'Keunggulan dan benefit memilih PT Swabina Gatra'
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
            <i class="bi bi-hand-thumbs-up-fill"></i> Mengapa Memilih Kami?
        </h1>
        <p class="lead">Keunggulan PT Swabina Gatra sebagai Mitra Terpercaya</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="<?php echo e(route('beranda')); ?>" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-white">Tentang Kami</a></li>
                <li class="breadcrumb-item active text-white-50">Mengapa Memilih Kami</li>
            </ol>
        </nav>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Keunggulan Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-star-fill text-warning"></i> Keunggulan Kami
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">Yang membuat kami berbeda dari yang lain</p>
        </div>

        <?php if(isset($MK) && $MK->count() > 0): ?>
        <div class="row g-4">
            <?php $__currentLoopData = $MK; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $icons = ['bi-shield-check', 'bi-people-fill', 'bi-trophy-fill', 'bi-clock-history', 'bi-gear-fill', 'bi-award-fill'];
                $colors = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
                $iconIndex = $index % 6;
            ?>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift feature-card">
                    <?php if($item->gambar): ?>
                    <div class="card-img-wrapper">
                        <img src="<?php echo e(asset('storage/mks/' . $item->gambar)); ?>" 
                             class="card-img-top" 
                             alt="<?php echo e($item->judul); ?>"
                             style="height: 200px; object-fit: cover;">
                        <div class="card-img-overlay-icon">
                            <i class="bi <?php echo e($icons[$iconIndex]); ?> text-<?php echo e($colors[$iconIndex]); ?>"></i>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="card-body-icon text-center pt-4">
                        <div class="icon-wrapper">
                            <i class="bi <?php echo e($icons[$iconIndex]); ?> text-<?php echo e($colors[$iconIndex]); ?>" style="font-size: 4rem;"></i>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="card-body <?php echo e($item->gambar ? 'pt-3' : ''); ?>">
                        <h5 class="card-title fw-bold text-<?php echo e($colors[$iconIndex]); ?> mb-3">
                            <i class="bi <?php echo e($icons[$iconIndex]); ?> me-2"></i><?php echo e($item->judul); ?>

                        </h5>
                        <p class="card-text text-muted" style="text-align: justify; line-height: 1.8;">
                            <?php echo e($item->deskripsi); ?>

                        </p>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php else: ?>
        <!-- Default Keunggulan jika belum ada data -->
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-shield-check text-primary" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold text-primary mb-3">Terpercaya & Bersertifikat</h5>
                        <p class="card-text text-muted">Memiliki sertifikasi ISO dan pengalaman puluhan tahun</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-people-fill text-success" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold text-success mb-3">Tim Profesional</h5>
                        <p class="card-text text-muted">Didukung oleh tenaga ahli yang kompeten dan berpengalaman</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-trophy-fill text-warning" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold text-warning mb-3">Kualitas Terjamin</h5>
                        <p class="card-text text-muted">Layanan berkualitas tinggi dengan standar internasional</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-clock-history text-danger" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold text-danger mb-3">Responsif 24/7</h5>
                        <p class="card-text text-muted">Siap melayani kebutuhan Anda kapan saja</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-gear-fill text-info" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold text-info mb-3">Teknologi Modern</h5>
                        <p class="card-text text-muted">Menggunakan peralatan dan sistem terkini</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift text-center">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-award-fill text-secondary" style="font-size: 4rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold text-secondary mb-3">Budaya 5R</h5>
                        <p class="card-text text-muted">Menerapkan prinsip Ringkas, Rapi, Resik, Rawat, Rajin</p>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Keunggulan Layanan Section -->
<section class="mb-5">
    <div class="container">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-star text-primary"></i> Keunggulan Layanan Kami
            </h2>
            <div class="title-underline"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-shield-check" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Terpercaya & Profesional</h5>
                        <p class="card-text text-muted small">Pengalaman lebih dari 20 tahun melayani klien terkemuka dengan standar profesional tinggi.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-award" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Tersertifikasi ISO</h5>
                        <p class="card-text text-muted small">Memiliki sertifikasi ISO 9001, ISO 14001, dan ISO 45001 yang menjamin kualitas layanan.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-people" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Tim Berpengalaman</h5>
                        <p class="card-text text-muted small">Dipimpin oleh profesional berpengalaman dengan tim terlatih siap melayani Anda 24/7.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonial Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-chat-quote-fill text-primary"></i> Testimoni Klien
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">Apa kata mereka tentang kami</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="card-text text-muted fst-italic mb-3">
                            "Pelayanan sangat profesional dan responsif. Sangat merekomendasikan PT Swabina Gatra."
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-placeholder bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0 fw-bold">Klien Korporat</h6>
                                <small class="text-muted">Perusahaan Manufaktur</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="card-text text-muted fst-italic mb-3">
                            "Kualitas layanan sangat baik dengan harga yang kompetitif. Sangat puas!"
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-placeholder bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0 fw-bold">Mitra Bisnis</h6>
                                <small class="text-muted">Perusahaan Retail</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        <p class="card-text text-muted fst-italic mb-3">
                            "Tim yang solid dan berpengalaman. Sangat membantu operasional kami."
                        </p>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-placeholder bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                    <i class="bi bi-person-fill" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0 fw-bold">Partner</h6>
                                <small class="text-muted">Industri Properti</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SWA Academy Keunggulan Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-mortarboard text-primary"></i> Keunggulan SWA Academy
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">Program pelatihan dan pengembangan SDM terbaik</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-book" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Kurikulum Terstruktur</h5>
                        <p class="card-text text-muted small">Kurikulum yang dirancang khusus sesuai kebutuhan industri dan perkembangan terkini.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-person-check" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Instruktur Profesional</h5>
                        <p class="card-text text-muted small">Dibimbing oleh praktisi berpengalaman dan ahli di bidangnya masing-masing.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-certificate" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Sertifikat Resmi</h5>
                        <p class="card-text text-muted small">Peserta mendapatkan sertifikat yang diakui industri setelah menyelesaikan program.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-briefcase" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Praktik Langsung</h5>
                        <p class="card-text text-muted small">Kombinasi teori dan praktik hands-on untuk pemahaman yang mendalam.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-graph-up" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Pengembangan Karir</h5>
                        <p class="card-text text-muted small">Program dirancang untuk meningkatkan kompetensi dan peluang karir peserta.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body text-center">
                        <div class="feature-icon mb-3">
                            <i class="bi bi-people-fill" style="font-size: 2.5rem; color: var(--primary-color);"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-2">Networking</h5>
                        <p class="card-text text-muted small">Kesempatan networking dengan profesional dan pengusaha dari berbagai industri.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="<?php echo e(route('swaacademy')); ?>" class="btn btn-primary btn-lg">
                <i class="bi bi-arrow-right-circle"></i> Pelajari SWA Academy Lebih Lanjut
            </a>
        </div>
    </div>
</section>

<!-- Contact Information Cards (Synchronized) -->
<?php if (isset($component)) { $__componentOriginalc6c74ca4e358174f35f83170c5eec4e1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc6c74ca4e358174f35f83170c5eec4e1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.contact-info-cards','data' => ['companyInfo' => $companyInfo,'title' => 'Hubungi Kami','showTitle' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('contact-info-cards'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['companyInfo' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($companyInfo),'title' => 'Hubungi Kami','showTitle' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc6c74ca4e358174f35f83170c5eec4e1)): ?>
<?php $attributes = $__attributesOriginalc6c74ca4e358174f35f83170c5eec4e1; ?>
<?php unset($__attributesOriginalc6c74ca4e358174f35f83170c5eec4e1); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc6c74ca4e358174f35f83170c5eec4e1)): ?>
<?php $component = $__componentOriginalc6c74ca4e358174f35f83170c5eec4e1; ?>
<?php unset($__componentOriginalc6c74ca4e358174f35f83170c5eec4e1); ?>
<?php endif; ?>

<!-- Lokasi & Kontak Section -->
<?php if (isset($component)) { $__componentOriginal1a51877a65d95132b52e3a11433cd97f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a51877a65d95132b52e3a11433cd97f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.lokasi-kontak','data' => ['companyInfo' => $companyInfo]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('lokasi-kontak'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['companyInfo' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($companyInfo)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a51877a65d95132b52e3a11433cd97f)): ?>
<?php $attributes = $__attributesOriginal1a51877a65d95132b52e3a11433cd97f; ?>
<?php unset($__attributesOriginal1a51877a65d95132b52e3a11433cd97f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a51877a65d95132b52e3a11433cd97f)): ?>
<?php $component = $__componentOriginal1a51877a65d95132b52e3a11433cd97f; ?>
<?php unset($__componentOriginal1a51877a65d95132b52e3a11433cd97f); ?>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-5">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Siap Bermitra dengan Kami?</h2>
                <p class="lead mb-4">Percayakan kebutuhan Anda pada ahlinya</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="<?php echo e(route('kontakkami')); ?>" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                    </a>
                    <a href="<?php echo e(route('facility-management')); ?>" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-briefcase-fill me-2"></i>Lihat Layanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
.feature-card {
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

.feature-card:hover .card-img-wrapper img {
    transform: scale(1.1);
}

.card-img-overlay-icon {
    position: absolute;
    top: 15px;
    right: 15px;
    background: white;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.icon-wrapper {
    display: inline-block;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
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

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/memilihkami/mengapa-professional.blade.php ENDPATH**/ ?>