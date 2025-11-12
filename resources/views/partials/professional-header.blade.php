<header class="professional-header">
    <!-- Header Main with White Background -->
    <div class="header-main bg-white">
        <div class="container py-3">
            <div class="row align-items-center">
                <div class="col-md-4 col-lg-3 text-center text-md-start mb-3 mb-md-0">
                    <div class="logo-wrapper">
                        <img src="{{ asset('assets/gambar_landingpage/logo_swabina.png') }}" 
                             alt="PT Swabina Gatra Logo" 
                             class="main-logo"
                             style="max-height: 80px; width: auto; object-fit: contain;">
                    </div>
                </div>
                <div class="col-md-4 col-lg-6 text-center mb-3 mb-md-0">
                    <div class="company-title">
                        <h1 class="mb-1" style="color: #0454a3; font-size: 1.8rem; font-weight: 700;">PT Swabina Gatra</h1>
                        <p class="mb-0 text-muted" style="font-size: 0.95rem; font-weight: 500;">Leading Facility Management & Services</p>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 text-center text-md-end">
                    <div class="certification-logos d-flex justify-content-center justify-content-md-end align-items-center flex-wrap gap-2">
                        <img src="{{ asset('assets/gambar_landingpage/logo_iso1.png') }}" 
                             alt="ISO 9001" 
                             title="ISO 9001:2015"
                             style="height: 55px; width: auto; object-fit: contain;">
                        <img src="{{ asset('assets/gambar_landingpage/logo_iso2.png') }}" 
                             alt="ISO 14001" 
                             title="ISO 14001"
                             style="height: 55px; width: auto; object-fit: contain;">
                        <img src="{{ asset('assets/gambar_landingpage/logo_iso3.png') }}" 
                             alt="ISO 45001" 
                             title="ISO 45001"
                             style="height: 55px; width: auto; object-fit: contain;">
                        <img src="{{ asset('assets/gambar_landingpage/logo_smk3.png') }}" 
                             alt="SMK3" 
                             title="SMK3"
                             style="height: 55px; width: auto; object-fit: contain;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
.professional-header {
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.header-main {
    border-bottom: 3px solid #0454a3;
}

.logo-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
}

.main-logo {
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
    transition: transform 0.3s ease;
}

.main-logo:hover {
    transform: scale(1.05);
}

.company-title h1 {
    margin: 0;
    line-height: 1.2;
}

.certification-logos img {
    transition: transform 0.3s ease, filter 0.3s ease;
    filter: grayscale(20%);
}

.certification-logos img:hover {
    transform: scale(1.1);
    filter: grayscale(0%);
}

@media (max-width: 768px) {
    .header-top {
        font-size: 0.8rem;
    }
    
    .contact-info {
        gap: 1rem;
    }
    
    .info-item span {
        font-size: 0.85rem;
    }
    
    .company-title h1 {
        font-size: 1.5rem !important;
    }
    
    .company-title p {
        font-size: 0.85rem !important;
    }
    
    .certification-logos img {
        height: 45px !important;
    }
}
</style>
