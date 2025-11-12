<!-- Lokasi & Kontak Section Component -->
<section class="py-5 {{ $bgClass ?? '' }}">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-geo-alt-fill text-primary"></i> {{ $title ?? 'Lokasi & Kontak Kami' }}
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">{{ $subtitle ?? 'Kunjungi kantor kami atau hubungi tim profesional kami' }}</p>
        </div>

        {{-- SINGLE SOURCE OF TRUTH - Semua data dari $companyInfo database saja, no fallbacks --}}
        @php
            $alamat = $companyInfo->alamat ?? $companyInfo->address ?? null;
            $telp = $companyInfo->no_telp ?? $companyInfo->phone ?? null;
            $email = $companyInfo->email ?? null;
            $whatsapp = $companyInfo->whatsapp ?? null;
            $telp_clean = $telp ? preg_replace('/[^0-9+]/', '', $telp) : null;
        @endphp

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
                                    @if($alamat)
                                        {{ $alamat }}
                                    @else
                                        <em class="text-muted">Tidak ada data alamat</em>
                                    @endif
                                </p>
                                @if($alamat)
                                <a href="https://www.google.com/maps/search/{{ urlencode($alamat) }}" 
                                   class="btn btn-sm btn-primary" target="_blank" rel="noopener noreferrer">
                                    <i class="bi bi-map"></i> Buka di Google Maps
                                </a>
                                @endif
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
                                    @if($telp)
                                        <a href="tel:{{ $telp_clean }}" class="text-decoration-none text-muted">{{ $telp }}</a>
                                    @else
                                        <em class="text-muted">-</em>
                                    @endif
                                </p>
                                <p class="text-muted mb-2">
                                    <strong>Email:</strong><br>
                                    @if($email)
                                        <a href="mailto:{{ $email }}" class="text-decoration-none text-muted">{{ $email }}</a>
                                    @else
                                        <em class="text-muted">-</em>
                                    @endif
                                </p>
                                @if($whatsapp)
                                <p class="text-muted">
                                    <strong>WhatsApp:</strong><br>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" class="btn btn-sm btn-success" target="_blank" rel="noopener noreferrer">
                                        <i class="bi bi-whatsapp"></i> Chat WhatsApp
                                    </a>
                                </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Maps Embed -->
        @if($showMap ?? true)
        <div class="row mt-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <div style="width: 100%; height: {{ $mapHeight ?? '400px' }}; border-radius: 8px; overflow: hidden;">
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
        @endif
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
