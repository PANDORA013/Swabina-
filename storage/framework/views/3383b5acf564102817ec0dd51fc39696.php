

<?php $__env->startSection('head'); ?>
<?php if (isset($component)) { $__componentOriginal84f9df3f620371229981225e7ba608d7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal84f9df3f620371229981225e7ba608d7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo-meta','data' => ['title' => 'Hubungi Kami - PT Swabina Gatra','description' => 'Hubungi PT Swabina Gatra untuk informasi layanan, dukungan pelanggan, atau pertanyaan umum. Kami siap membantu Anda.','keywords' => ['hubungi kami', 'kontak', 'contact us', 'support', 'customer service'],'url' => ''.e(route('kontakkami')).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo-meta'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Hubungi Kami - PT Swabina Gatra','description' => 'Hubungi PT Swabina Gatra untuk informasi layanan, dukungan pelanggan, atau pertanyaan umum. Kami siap membantu Anda.','keywords' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['hubungi kami', 'kontak', 'contact us', 'support', 'customer service']),'url' => ''.e(route('kontakkami')).'']); ?>
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

<?php $__env->startSection('content'); ?>

<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); margin: -2rem -50vw 0; padding-left: 50vw; padding-right: 50vw;">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-telephone-fill"></i> Hubungi Kami
        </h1>
        <p class="lead">Kami Siap Membantu Anda</p>
    </div>
</section>

<!-- Contact Information Section (Synchronized) -->
<?php if (isset($component)) { $__componentOriginalc6c74ca4e358174f35f83170c5eec4e1 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc6c74ca4e358174f35f83170c5eec4e1 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.contact-info-cards','data' => ['companyInfo' => $companyInfo,'showTitle' => false]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('contact-info-cards'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['companyInfo' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($companyInfo),'showTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(false)]); ?>
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

<!-- Operating Hours Section -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Operating Hours -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white py-4">
                        <h5 class="mb-0">
                            <i class="bi bi-clock-fill me-2"></i>Jam Operasional
                        </h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="list-group list-group-flush">
                            <div class="list-group-item px-0 py-2 border-0">
                                <strong>Senin - Jumat:</strong> 08:00 - 17:00 WIB
                            </div>
                            <div class="list-group-item px-0 py-2 border-0">
                                <strong>Sabtu:</strong> 08:00 - 13:00 WIB
                            </div>
                            <div class="list-group-item px-0 py-2 border-0 text-danger">
                                <strong>Minggu & Hari Libur:</strong> Tutup
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if($faqs && $faqs->count() > 0): ?>
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">
            <i class="bi bi-question-circle me-2 text-primary"></i>Pertanyaan yang Sering Diajukan
        </h2>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-flush" id="faqAccordion">
                    <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="accordion-item border-0 mb-2 shadow-sm rounded">
                            <h2 class="accordion-header" id="heading<?php echo e($index); ?>">
                                <button 
                                    class="accordion-button py-3 fw-500 <?php if($index > 2): ?> collapsed <?php endif; ?>" 
                                    type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapse<?php echo e($index); ?>" 
                                    aria-expanded="<?php if($index <= 2): ?>true <?php else: ?> false <?php endif; ?>" 
                                    aria-controls="collapse<?php echo e($index); ?>">
                                    <i class="bi bi-chevron-right me-2"></i>
                                    <?php if(is_array($faq->question)): ?>
                                        <?php echo e($faq->question['id'] ?? ($faq->question['en'] ?? $faq->question)); ?>

                                    <?php else: ?>
                                        <?php echo e($faq->question); ?>

                                    <?php endif; ?>
                                </button>
                            </h2>
                            <div 
                                id="collapse<?php echo e($index); ?>" 
                                class="accordion-collapse collapse <?php if($index <= 2): ?> show <?php endif; ?>" 
                                aria-labelledby="heading<?php echo e($index); ?>" 
                                data-bs-parent="#faqAccordion">
                                <div class="accordion-body py-3">
                                    <?php if(is_array($faq->answer)): ?>
                                        <?php echo e($faq->answer['id'] ?? ($faq->answer['en'] ?? $faq->answer)); ?>

                                    <?php else: ?>
                                        <?php echo e($faq->answer); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="text-center mt-5">
                    <p class="text-muted mb-3">Tidak menemukan jawaban yang Anda cari?</p>
                    <a href="<?php echo e(route('faq')); ?>" class="btn btn-primary">
                        <i class="bi bi-arrow-right me-2"></i>Lihat Semua FAQ
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- CTA Section -->
<section class="py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%); color: white;">
    <div class="container text-center">
        <h2 class="fw-bold mb-3">
            <i class="bi bi-chat-dots me-2"></i>Siap Membantu Anda
        </h2>
        <p class="lead mb-4">
            Tim kami siap menjawab pertanyaan dan memberikan solusi terbaik untuk kebutuhan Anda.
        </p>
        <?php
            $telp = isset($companyInfo) ? ($companyInfo->no_telp ?? $companyInfo->phone ?? null) : null;
            $email = isset($companyInfo) ? ($companyInfo->email ?? null) : null;
            $telp_clean = $telp ? preg_replace('/[^0-9+]/', '', $telp) : null;
        ?>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <?php if($telp): ?>
            <a href="tel:<?php echo e($telp_clean); ?>" class="btn btn-light btn-lg">
                <i class="bi bi-telephone me-2"></i>Hubungi Telepon
            </a>
            <?php endif; ?>
            <?php if($email): ?>
            <a href="mailto:<?php echo e($email); ?>" class="btn btn-light btn-lg">
                <i class="bi bi-envelope me-2"></i>Kirim Email
            </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<style>
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
}

.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.accordion-button:not(.collapsed) {
    background-color: #e7f1ff;
    color: #0d6efd;
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.btn-outline-primary:hover {
    transform: scale(1.05);
}
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/kontak/kontak-professional.blade.php ENDPATH**/ ?>