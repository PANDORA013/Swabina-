@extends('layouts.app-professional')

@section('head')
<x-seo-meta 
    title="SWA Segar AMDK - Air Minum Dalam Kemasan | PT Swabina Gatra"
    description="SWA Segar menyediakan air minum dalam kemasan berkualitas tinggi dengan standar kesehatan yang terjamin untuk kebutuhan perusahaan dan rumah tangga."
    keywords="air minum kemasan, AMDK, air mineral, SWA Segar, air minum berkualitas"
/>
<x-structured-data 
    type="service"
    name="SWA Segar AMDK"
    description="Layanan penyediaan air minum dalam kemasan berkualitas tinggi"
/>
@endsection

@section('page-header')
@if($carousels && $carousels->count() > 0)
<section class="hero-carousel">
    <div id="segarCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach($carousels as $index => $carousel)
            <button type="button" data-bs-target="#segarCarousel" data-bs-slide-to="{{ $index }}" 
                    class="{{ $index === 0 ? 'active' : '' }}" aria-current="{{ $index === 0 ? 'true' : 'false' }}" 
                    aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach($carousels as $index => $carousel)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ asset('images/' . $carousel->gambar) }}" class="d-block w-100" alt="{{ $carousel->judul ?? 'SWA Segar' }}" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-flex flex-column justify-content-center align-items-center h-100">
                    @if($carousel->judul)
                    <h1 class="display-4 fw-bold mb-3" data-aos="fade-up">{{ $carousel->judul }}</h1>
                    @endif
                    @if($carousel->deskripsi)
                    <p class="lead fs-5 mb-4" data-aos="fade-up" data-aos-delay="100">{{ $carousel->deskripsi }}</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#segarCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#segarCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
@else
<section class="hero-section bg-gradient-primary text-white py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-4" data-aos="fade-up">SWA Segar AMDK</h1>
                <p class="lead fs-5 mb-4" data-aos="fade-up" data-aos-delay="100">
                    Air Minum Dalam Kemasan Berkualitas untuk Kesehatan Keluarga
                </p>
            </div>
        </div>
    </div>
</section>
@endif
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="#">Produk</a></li>
        <li class="breadcrumb-item active" aria-current="page">SWA Segar AMDK</li>
    </ol>
</nav>
@endsection

@section('content')
<!-- Tentang Produk Section -->
@if($textss && $textss->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        @foreach($textss as $text)
        <div class="row mb-4" data-aos="fade-up">
            <div class="col-12">
                @if($text->judul)
                <h2 class="section-title mb-4">{{ $text->judul }}</h2>
                @endif
                @if($text->deskripsi)
                <div class="text-muted lh-lg fs-6">
                    {!! nl2br(e($text->deskripsi)) !!}
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</section>
@endif

<!-- Keunggulan Produk Section -->
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Keunggulan SWA Segar</h2>
            <p class="text-muted">Mengapa memilih SWA Segar untuk kebutuhan air minum Anda</p>
        </div>

        <div class="row g-4">
            <!-- Feature 1 -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <img src="{{ asset('assets/gambar_swas/swa-baru.jpg') }}" 
                         class="card-img-top" 
                         alt="Standar Kesehatan"
                         style="height: 200px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-body text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-shield-check text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Standar Kesehatan</h5>
                        <p class="card-text text-muted">
                            Memenuhi standar kesehatan nasional dan internasional
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-droplet-fill text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Sumber Air Alami</h5>
                        <p class="card-text text-muted">
                            Berasal dari sumber air pegunungan yang terjaga kualitasnya
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <img src="{{ asset('assets/gambar_swas/swas2.jpg') }}" 
                         class="card-img-top" 
                         alt="Bersertifikat"
                         style="height: 200px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-body text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-award-fill text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Bersertifikat</h5>
                        <p class="card-text text-muted">
                            Telah tersertifikasi BPOM dan lulus uji laboratorium
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 4 -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="0">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-boxes text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Berbagai Ukuran</h5>
                        <p class="card-text text-muted">
                            Tersedia dalam berbagai ukuran kemasan sesuai kebutuhan
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 5 -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-truck text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Pengiriman Cepat</h5>
                        <p class="card-text text-muted">
                            Layanan pengiriman yang cepat dan tepat waktu
                        </p>
                    </div>
                </div>
            </div>

            <!-- Feature 6 -->
            <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-currency-dollar text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold mb-3">Harga Kompetitif</h5>
                        <p class="card-text text-muted">
                            Harga terjangkau dengan kualitas terjamin
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Section -->
@if($gambarSS && ($gambarSS->gambar1 || $gambarSS->gambar2 || $gambarSS->gambar3 || $gambarSS->gambar4))
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Galeri Produk</h2>
            <p class="text-muted">Produk SWA Segar dalam berbagai kemasan</p>
        </div>

        <div class="row g-4">
            @if($gambarSS->gambar1)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="0">
                <div class="gallery-item">
                    <img src="{{ asset('images/' . $gambarSS->gambar1) }}" alt="Produk 1" class="img-fluid rounded shadow-sm">
                </div>
            </div>
            @endif
            
            @if($gambarSS->gambar2)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="gallery-item">
                    <img src="{{ asset('images/' . $gambarSS->gambar2) }}" alt="Produk 2" class="img-fluid rounded shadow-sm">
                </div>
            </div>
            @endif
            
            @if($gambarSS->gambar3)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="gallery-item">
                    <img src="{{ asset('images/' . $gambarSS->gambar3) }}" alt="Produk 3" class="img-fluid rounded shadow-sm">
                </div>
            </div>
            @endif
            
            @if($gambarSS->gambar4)
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="gallery-item">
                    <img src="{{ asset('images/' . $gambarSS->gambar4) }}" alt="Produk 4" class="img-fluid rounded shadow-sm">
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- CTA Section -->
<section class="py-5 bg-gradient-primary text-white">
    <div class="container">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8" data-aos="fade-up">
                <h2 class="mb-4 fw-bold">Pesan SWA Segar Sekarang</h2>
                <p class="lead mb-4">
                    Dapatkan harga khusus untuk pemesanan dalam jumlah besar. Hubungi kami untuk informasi lebih lanjut
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('kontakkami') }}" class="btn btn-light btn-lg px-5">
                        <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                    </a>
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-outline-light btn-lg px-5">
                        <i class="bi bi-whatsapp me-2"></i>WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
}

.icon-wrapper i {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.gallery-item {
    overflow: hidden;
    border-radius: 0.5rem;
    position: relative;
}

.gallery-item img {
    transition: transform 0.5s ease;
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.gallery-item:hover img {
    transform: scale(1.1);
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
}

.section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #0d6efd;
    position: relative;
    padding-bottom: 15px;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #0d6efd, #0a58ca);
    border-radius: 2px;
}

.hero-section {
    min-height: 400px;
    display: flex;
    align-items: center;
}

.carousel-item {
    height: 500px;
}

.carousel-caption {
    background: rgba(0, 0, 0, 0.5);
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 2rem;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    padding: 20px;
}
</style>
@endsection
