@extends('layouts.app-professional')

@section('head')
<x-seo-meta 
    title="Berita & Artikel Terbaru - PT Swabina Gatra"
    description="Berita terbaru, artikel, dan informasi seputar layanan PT Swabina Gatra. Tetap update dengan perkembangan perusahaan kami."
    :keywords="['berita swabina', 'artikel', 'news', 'company news', 'press release']"
    url="{{ route('berita') }}"
/>
<x-structured-data type="website" />
@endsection

@section('page-header')
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-newspaper"></i> Berita & Artikel
        </h1>
        <p class="lead">Informasi Terbaru dari PT Swabina Gatra</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item active text-white-50">Berita</li>
            </ol>
        </nav>
    </div>
</section>
@endsection

@section('content')
<!-- Berita Section -->
<section class="py-5">
    <div class="container">
        @if($berita->count() > 0)
        <div class="row g-4">
            @foreach($berita as $item)
            <div class="col-md-6 col-lg-4">
                <article class="card h-100 border-0 shadow-sm hover-lift news-card">
                    <div class="card-img-wrapper">
                        @if($item->gambar)
                            <img src="{{ asset('storage/beritas/' . $item->gambar) }}" 
                                 class="card-img-top" 
                                 alt="{{ $item->judul }}"
                                 width="400"
                                 height="250"
                                 style="height: 250px; object-fit: cover;"
                                 loading="lazy"
                                 decoding="async"
                                 fetchpriority="{{ $loop->index < 3 ? 'high' : 'low' }}">
                        @else
                            @php
                                $fallbackImages = ['berita1.jpg', 'berita2.jpeg', 'berita3.jpg', 'berita4.jpg', 'berita5.jpg', 'berita6.jpg', 'berita7.png'];
                                $randomImage = $fallbackImages[($loop->index % count($fallbackImages))];
                            @endphp
                            <img src="{{ asset('assets/gambar_berita/' . $randomImage) }}" 
                                 class="card-img-top" 
                                 alt="{{ $item->judul }}"
                                 width="400"
                                 height="250"
                                 style="height: 250px; object-fit: cover;"
                                 loading="lazy"
                                 decoding="async"
                                 fetchpriority="{{ $loop->index < 3 ? 'high' : 'low' }}">
                        @endif
                        <div class="news-date-badge">
                            <span class="badge bg-primary">
                                <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <div class="mb-2">
                            <span class="badge bg-light text-dark">
                                <i class="bi bi-tag-fill me-1"></i>Berita
                            </span>
                        </div>
                        <h5 class="card-title fw-bold mb-3">{{ $item->judul }}</h5>
                        <p class="card-text text-muted flex-grow-1" style="text-align: justify;">
                            {{ Str::limit(strip_tags($item->deskripsi), 120) }}
                        </p>
                        <button class="btn btn-outline-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#newsModal{{ $item->id }}">
                            <i class="bi bi-arrow-right-circle me-1"></i>Baca Selengkapnya
                        </button>
                    </div>
                </article>
            </div>

            <!-- Modal for News Detail -->
            <div class="modal fade" id="newsModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">{{ $item->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            @if($item->gambar)
                                <img src="{{ asset('storage/beritas/' . $item->gambar) }}" 
                                     class="img-fluid rounded mb-4" 
                                     alt="{{ $item->judul }}">
                            @endif
                            <div class="mb-3">
                                <span class="badge bg-primary me-2">
                                    <i class="bi bi-calendar3 me-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                                </span>
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-tag-fill me-1"></i>Berita
                                </span>
                            </div>
                            <div class="news-content" style="text-align: justify; line-height: 1.8;">
                                {!! nl2br(e($item->deskripsi)) !!}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 5rem;"></i>
            <h3 class="mt-4 text-muted">Belum Ada Berita</h3>
            <p class="text-muted">Berita akan ditampilkan di sini</p>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Butuh Informasi Lebih Lanjut?</h2>
                <p class="lead mb-4">Hubungi tim kami untuk mendapatkan informasi detail</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('kontakkami') }}" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                    </a>
                    <a href="{{ route('faq') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-question-circle-fill me-2"></i>FAQ
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.news-card {
    transition: all 0.3s ease;
    overflow: hidden;
    content-visibility: auto;
    contain-intrinsic-size: 0 500px;
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
    will-change: transform;
}

.news-card:hover .card-img-wrapper img {
    transform: scale(1.1);
}

.news-date-badge {
    position: absolute;
    top: 15px;
    right: 15px;
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
@endsection
