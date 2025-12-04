<footer class="professional-footer">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-md-3 footer-section">
                <h5>PT Swabina Gatra</h5>
                <p style="font-size: 0.9rem; line-height: 1.8;">
                    Perusahaan terdepan dalam Facility Management & Services dengan sertifikasi ISO lengkap dan pengalaman lebih dari 20 tahun melayani klien di berbagai sektor industri.
                </p>
                <div class="social-links" style="margin-top: 1rem;">
                    <a href="https://www.facebook.com/swabina.gatra.2025/" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-secondary me-2" style="padding: 0.5rem 0.75rem;" title="Facebook PT Swabina Gatra">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="https://www.linkedin.com/company/pt-swabina-gatra/about/" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-secondary me-2" style="padding: 0.5rem 0.75rem;" title="LinkedIn PT Swabina Gatra">
                        <i class="bi bi-linkedin"></i>
                    </a>
                    <a href="https://www.instagram.com/swabina.official?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-secondary me-2" style="padding: 0.5rem 0.75rem;" title="Instagram @swabina.official">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="https://youtube.com/@swabinaofficial6517?si=uAyKkDWyV2Y7PK21" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-secondary me-2" style="padding: 0.5rem 0.75rem;" title="YouTube Swabina Official">
                        <i class="bi bi-youtube"></i>
                    </a>
                </div>
            </div>
            
            <!-- Services -->
            <div class="col-md-3 footer-section">
                <h5>Layanan Kami</h5>
                <ul>
                    <li><a href="<?php echo e(route('layanan.show', 'swa-academy')); ?>">Swa Academy</a></li>
                    <li><a href="<?php echo e(route('layanan.show', 'facility-management')); ?>">Facility Management</a></li>
                    <li><a href="<?php echo e(route('layanan.show', 'digital-solution')); ?>">Digital Solution</a></li>
                    <li><a href="<?php echo e(route('layanan.show', 'swa-tour-organizer')); ?>">Swa Tour Organizer</a></li>
                    <li><a href="<?php echo e(route('layanan.show', 'swasegar-amdk')); ?>">Swasegar AMDK</a></li>
                </ul>
            </div>
            
            <!-- Quick Links -->
            <div class="col-md-3 footer-section">
                <h5>Tautan Cepat</h5>
                <ul>
                    <li><a href="<?php echo e(route('tentangkami')); ?>">Tentang Kami</a></li>
                    <li><a href="<?php echo e(route('berita')); ?>">Berita & Update</a></li>
                    <li><a href="<?php echo e(route('faq')); ?>">FAQ</a></li>
                    <li><a href="<?php echo e(route('kebijakandanpedoman')); ?>">Kebijakan & Pedoman</a></li>
                    <li><a href="<?php echo e(route('kontakkami')); ?>">Hubungi Kami</a></li>
                </ul>
            </div>
            
            <!-- Contact Info -->
            <div class="col-md-3 footer-section">
                <h5>Hubungi Kami</h5>
                <ul style="list-style: none; padding: 0;">
                    <?php
                        $telp = isset($companyInfo) ? ($companyInfo->no_telp ?? $companyInfo->phone ?? null) : null;
                        $email = isset($companyInfo) ? ($companyInfo->email ?? null) : null;
                        $alamat = isset($companyInfo) ? ($companyInfo->alamat ?? $companyInfo->address ?? null) : null;
                        $telp_clean = $telp ? preg_replace('/[^0-9+]/', '', $telp) : null;
                    ?>
                    
                    <?php if($telp): ?>
                    <li style="margin-bottom: 1rem;">
                        <i class="bi bi-telephone me-2"></i>
                        <a href="tel:<?php echo e($telp_clean); ?>" style="color: #ccc; text-decoration: none;">
                            <?php echo e($telp); ?>

                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if($email): ?>
                    <li style="margin-bottom: 1rem;">
                        <i class="bi bi-envelope me-2"></i>
                        <a href="mailto:<?php echo e($email); ?>" style="color: #ccc; text-decoration: none;">
                            <?php echo e($email); ?>

                        </a>
                    </li>
                    <?php endif; ?>
                    
                    <?php if($alamat): ?>
                    <li>
                        <i class="bi bi-geo-alt me-2"></i>
                        <a href="https://www.google.com/maps/search/<?php echo e(urlencode($alamat)); ?>" 
                           target="_blank" 
                           style="color: #ccc; text-decoration: none;" 
                           title="Lihat di Google Maps">
                            <?php echo e($alamat); ?>

                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        
        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <p style="margin: 0;">
                &copy; <?php echo e(date('Y')); ?> PT Swabina Gatra. All rights reserved. | 
                <a href="<?php echo e(route('kebijakandanpedoman')); ?>" style="color: #999; text-decoration: none;">Privacy Policy</a>
            </p>
        </div>
    </div>
</footer>
<?php /**PATH C:\xampp\htdocs\project_magang\resources\views/partials/professional-footer.blade.php ENDPATH**/ ?>