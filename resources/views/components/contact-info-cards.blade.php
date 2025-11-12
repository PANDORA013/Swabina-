<!-- Contact Information Cards Component -->
<section class="py-5 {{ $bgClass ?? '' }}">
    <div class="container">
        @if($showTitle ?? true)
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-info-circle text-primary"></i> {{ $title ?? 'Informasi Kontak' }}
            </h2>
            <div class="title-underline"></div>
        </div>
        @endif

        @php
            // SINGLE SOURCE OF TRUTH - Semua data dari $companyInfo database saja, NO fallbacks
            $alamat = $companyInfo->alamat ?? $companyInfo->address ?? null;
            $telp = $companyInfo->no_telp ?? $companyInfo->phone ?? null;
            $email = $companyInfo->email ?? null;
            $telp_clean = $telp ? preg_replace('/[^0-9+]/', '', $telp) : null;
        @endphp

        <div class="row g-4 {{ $rowClass ?? 'mb-5' }}">
            <!-- Main Address -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift" style="transition: all 0.3s ease;">
                    <div class="card-body text-center">
                        <div class="display-6 text-primary mb-3">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <h5 class="card-title fw-bold">Kantor Pusat</h5>
                        <p class="card-text text-muted">
                            @if($alamat)
                                {{ $alamat }}
                            @else
                                <em class="text-muted">-</em>
                            @endif
                        </p>
                        @if($alamat && ($showMapButton ?? false))
                        <a href="https://www.google.com/maps/search/{{ urlencode($alamat) }}" 
                           class="btn btn-sm btn-primary mt-3" target="_blank" rel="noopener noreferrer">
                            <i class="bi bi-map me-2"></i>Buka Maps
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Email Contact -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift" style="transition: all 0.3s ease;">
                    <div class="card-body text-center">
                        <div class="display-6 text-primary mb-3">
                            <i class="bi bi-envelope-fill"></i>
                        </div>
                        <h5 class="card-title fw-bold">Email</h5>
                        <p class="card-text text-muted">
                            @if($email)
                                <a href="mailto:{{ $email }}" class="text-decoration-none text-primary fw-500 hover-link">
                                    {{ $email }}
                                </a>
                            @else
                                <em class="text-muted">-</em>
                            @endif
                        </p>
                    </div>
                </div>
            </div>

            <!-- Phone Contact -->
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift" style="transition: all 0.3s ease;">
                    <div class="card-body text-center">
                        <div class="display-6 text-primary mb-3">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <h5 class="card-title fw-bold">Telepon</h5>
                        <p class="card-text text-muted">
                            @if($telp)
                                <a href="tel:{{ $telp_clean }}" class="text-decoration-none text-primary fw-500 hover-link">
                                    {{ $telp }}
                                </a>
                            @else
                                <em class="text-muted">-</em>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hover-lift {
    transition: all 0.3s ease !important;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
}

.hover-link {
    transition: color 0.3s ease;
}

.hover-link:hover {
    color: #0d6efd !important;
    text-decoration: underline !important;
}
</style>
