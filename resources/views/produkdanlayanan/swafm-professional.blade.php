@extends('layouts.app-professional')

@section('head')
<x-seo-meta 
    title="SWA Facility Management - PT Swabina Gatra"
    description="Layanan Facility Management profesional dari PT Swabina Gatra. Solusi lengkap untuk pengelolaan gedung, maintenance, cleaning service, dan security."
    :keywords="['facility management', 'building management', 'cleaning service', 'security service', 'maintenance', 'swabina fm']"
    url="{{ route('facility-management') }}"
/>
<x-structured-data type="service" :data="[
    'name' => 'SWA Facility Management',
    'description' => 'Layanan Facility Management profesional',
    'provider' => 'PT Swabina Gatra'
]" />
@endsection

@section('page-header')
<!-- Hero Carousel Section -->
@if($carousels && $carousels->count() > 0)
<section class="hero-carousel">
    <div id="fmHeroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($carousels as $index => $carousel)
            <button type="button" data-bs-target="#fmHeroCarousel" data-bs-slide-to="{{ $index }}" 
                    class="{{ $index == 0 ? 'active' : '' }}" 
                    aria-current="{{ $index == 0 ? 'true' : 'false' }}" 
                    aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($carousels as $index => $carousel)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <img src="{{ asset('storage/carousel_fms/' . $carousel->gambar) }}" 
                     class="d-block w-100" 
                     alt="{{ $carousel->judul }}"
                     style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-start h-100">
                    <div class="container">
                        <h1 class="display-4 fw-bold text-white mb-3" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
                            {{ $carousel->judul }}
                        </h1>
                        <p class="lead text-white mb-4" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">
                            {{ $carousel->deskripsi }}
                        </p>
                        <div class="d-flex gap-3">
                            <a href="#layanan" class="btn btn-primary btn-lg px-4">
                                <i class="bi bi-briefcase me-2"></i>Lihat Layanan
                            </a>
                            <a href="{{ route('kontakkami') }}" class="btn btn-outline-light btn-lg px-4">
                                <i class="bi bi-envelope me-2"></i>Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($carousels->count() > 1)
        <button class="carousel-control-prev" type="button" data-bs-target="#fmHeroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#fmHeroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        @endif
    </div>
</section>
@else
<!-- Default Hero -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-building-gear"></i> SWA Facility Management
        </h1>
        <p class="lead">Solusi Profesional untuk Pengelolaan Gedung Anda</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-white">Layanan</a></li>
                <li class="breadcrumb-item active text-white-50">Facility Management</li>
            </ol>
        </nav>
    </div>
</section>
@endif
@endsection

@section('content')
<!-- Tentang Layanan Section -->
<section class="py-5" id="layanan">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-info-circle text-primary"></i> Tentang SWA Facility Management
            </h2>
            <div class="title-underline"></div>
        </div>

        @if($texts && $texts->count() > 0)
        <div class="row g-4">
            @foreach($texts as $text)
            <div class="col-12">
                <div class="card border-0 shadow-sm hover-lift">
                    <div class="card-body p-4">
                        <h3 class="h5 fw-bold text-primary mb-3">{{ $text->judul }}</h3>
                        <p class="text-muted mb-0" style="text-align: justify; line-height: 1.8;">
                            {{ $text->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>

<!-- Layanan Kami Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-gear-fill text-primary"></i> Layanan Kami
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">Solusi lengkap untuk kebutuhan facility management Anda</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center hover-lift">
                    <img src="{{ asset('assets/gambar_swafm/fm1.jpeg') }}" 
                         class="card-img-top" 
                         alt="Cleaning Service"
                         style="height: 200px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-brush-fill text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Cleaning Service</h5>
                        <p class="card-text text-muted">Layanan kebersihan profesional untuk gedung dan area kerja</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center hover-lift">
                    <img src="{{ asset('assets/gambar_swafm/satpam-baru.jpeg') }}" 
                         class="card-img-top" 
                         alt="Security Service"
                         style="height: 200px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-shield-check text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Security Service</h5>
                        <p class="card-text text-muted">Sistem keamanan dan personil security terlatih</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center hover-lift">
                    <img src="{{ asset('assets/gambar_swafm/fm2.jpg') }}" 
                         class="card-img-top" 
                         alt="Maintenance"
                         style="height: 200px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-tools text-warning" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Maintenance</h5>
                        <p class="card-text text-muted">Perawatan dan perbaikan fasilitas gedung</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center hover-lift">
                    <img src="{{ asset('assets/gambar_swafm/fm3.jpg') }}" 
                         class="card-img-top" 
                         alt="Landscaping"
                         style="height: 200px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-tree-fill text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Landscaping</h5>
                        <p class="card-text text-muted">Penataan dan perawatan taman</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center hover-lift">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-droplet-fill text-info" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Pest Control</h5>
                        <p class="card-text text-muted">Pengendalian hama yang efektif dan aman</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center hover-lift">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-clipboard-data text-danger" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Building Management</h5>
                        <p class="card-text text-muted">Pengelolaan gedung secara menyeluruh</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
@if($gambarFM && ($gambarFM->gambar1 || $gambarFM->gambar2 || $gambarFM->gambar3 || $gambarFM->gambar4))
<section class="py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-images text-primary"></i> Galeri Proyek
            </h2>
            <div class="title-underline"></div>
        </div>

        <div class="row g-4">
            @if($gambarFM->gambar1)
            <div class="col-md-6 col-lg-3">
                <div class="gallery-item">
                    <img src="{{ asset('storage/gambar_fms/' . $gambarFM->gambar1) }}" 
                         class="img-fluid rounded shadow-sm" 
                         alt="Galeri 1"
                         style="height: 250px; width: 100%; object-fit: cover;">
                </div>
            </div>
            @endif
            @if($gambarFM->gambar2)
            <div class="col-md-6 col-lg-3">
                <div class="gallery-item">
                    <img src="{{ asset('storage/gambar_fms/' . $gambarFM->gambar2) }}" 
                         class="img-fluid rounded shadow-sm" 
                         alt="Galeri 2"
                         style="height: 250px; width: 100%; object-fit: cover;">
                </div>
            </div>
            @endif
            @if($gambarFM->gambar3)
            <div class="col-md-6 col-lg-3">
                <div class="gallery-item">
                    <img src="{{ asset('storage/gambar_fms/' . $gambarFM->gambar3) }}" 
                         class="img-fluid rounded shadow-sm" 
                         alt="Galeri 3"
                         style="height: 250px; width: 100%; object-fit: cover;">
                </div>
            </div>
            @endif
            @if($gambarFM->gambar4)
            <div class="col-md-6 col-lg-3">
                <div class="gallery-item">
                    <img src="{{ asset('storage/gambar_fms/' . $gambarFM->gambar4) }}" 
                         class="img-fluid rounded shadow-sm" 
                         alt="Galeri 4"
                         style="height: 250px; width: 100%; object-fit: cover;">
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Tertarik dengan Layanan Kami?</h2>
                <p class="lead mb-4">Hubungi tim kami untuk konsultasi gratis</p>
                @php
                    $whatsapp = isset($companyInfo) ? ($companyInfo->whatsapp ?? null) : null;
                @endphp
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('kontakkami') }}" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                    </a>
                    @if($whatsapp)
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" class="btn btn-outline-light btn-lg px-4" target="_blank">
                        <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-10px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
}

.icon-wrapper {
    display: inline-block;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.gallery-item {
    overflow: hidden;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: scale(1.05);
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.15);
}

.gallery-item img {
    transition: transform 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.hero-carousel .carousel-item {
    height: 500px;
}

.hero-carousel .carousel-caption {
    position: absolute;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.3) 100%);
}

.section-title {
    position: relative;
    display: inline-block;
}

.title-underline {
    width: 60px;
    height: 3px;
    background: linear-gradient(to right, #0d6efd, #0a58ca);
    margin: 1rem auto;
    border-radius: 2px;
}
</style>
@endsection
