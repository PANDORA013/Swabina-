<!-- Lokasi & Kontak Section Component -->
<section class="py-5 <?php echo e($bgClass ?? ''); ?>">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-geo-alt-fill text-primary"></i> <?php echo e($title ?? 'Lokasi & Kontak Kami'); ?>

            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3"><?php echo e($subtitle ?? 'Kunjungi kantor kami atau hubungi tim profesional kami'); ?></p>
        </div>

        
        <?php
            $alamat = $companyInfo->alamat ?? $companyInfo->address ?? null;
            $telp = $companyInfo->no_telp ?? $companyInfo->phone ?? null;
            $email = $companyInfo->email ?? null;
            $whatsapp = $companyInfo->whatsapp ?? null;
            $telp_clean = $telp ? preg_replace('/[^0-9+]/', '', $telp) : null;
        ?>

        <div class="row g-4">
            <!-- Alamat Card -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start gap-3 mb-4">
                            <div class="flex-shrink-0">
                                <div class="icon-box bg-primary bg-opacity-10 rounded-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-geo-alt-fill text-primary" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title fw-bold mb-2">Alamat Kantor</h5>
                                <p class="text-muted mb-3" style="line-height: 1.8;">
                                    <?php if($alamat): ?>
                                        <?php echo e($alamat); ?>

                                    <?php else: ?>
                                        <em class="text-muted">Tidak ada data alamat</em>
                                    <?php endif; ?>
                                </p>
                                <?php if($alamat): ?>
                                <a href="https://www.google.com/maps/search/<?php echo e(urlencode($alamat)); ?>" 
                                   class="btn btn-sm btn-primary" target="_blank" rel="noopener noreferrer">
                                    <i class="bi bi-map"></i> Buka di Google Maps
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kontak Card -->
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="flex-shrink-0">
                                <div class="icon-box bg-success bg-opacity-10 rounded-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                    <i class="bi bi-telephone-fill text-success" style="font-size: 1.5rem;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="card-title fw-bold mb-2">Hubungi Kami</h5>
                                <p class="text-muted mb-2">
                                    <strong>Telepon:</strong><br>
                                    <?php if($telp): ?>
                                        <a href="tel:<?php echo e($telp_clean); ?>" class="text-decoration-none text-muted"><?php echo e($telp); ?></a>
                                    <?php else: ?>
                                        <em class="text-muted">-</em>
                                    <?php endif; ?>
                                </p>
                                <p class="text-muted mb-2">
                                    <strong>Email:</strong><br>
                                    <?php if($email): ?>
                                        <a href="mailto:<?php echo e($email); ?>" class="text-decoration-none text-muted"><?php echo e($email); ?></a>
                                    <?php else: ?>
                                        <em class="text-muted">-</em>
                                    <?php endif; ?>
                                </p>
                                <?php if($whatsapp): ?>
                                <p class="text-muted">
                                    <strong>WhatsApp:</strong><br>
                                    <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $whatsapp)); ?>" class="btn btn-sm btn-success" target="_blank" rel="noopener noreferrer">
                                        <i class="bi bi-whatsapp"></i> Chat WhatsApp
                                    </a>
                                </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Maps Embed -->
        <?php if($showMap ?? true): ?>
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div style="width: 100%; height: <?php echo e($mapHeight ?? '400px'); ?>; border-radius: 8px; overflow: hidden;">
                        <iframe 
                            width="100%" 
                            height="100%" 
                            frameborder="0" 
                            style="border:0" 
                            src="https://www.google.com/maps/embed/v1/place?key=AIzaSyAQhkbPKN5hXhBbhABT96bvGXhf1qCJxlk&q=PT%20Swabina%20Gatra%20Jakarta" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<style>
.icon-box {
    transition: all 0.3s ease;
}

.hover-lift:hover .icon-box {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15) !important;
}

.btn-sm {
    font-size: 0.875rem;
    padding: 0.5rem 1rem;
}

.btn-sm:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.1) !important;
}
</style>
<?php /**PATH C:\xampp\htdocs\project_magang\resources\views/components/lokasi-kontak.blade.php ENDPATH**/ ?>