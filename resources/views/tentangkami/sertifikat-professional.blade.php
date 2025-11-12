@extends('layouts.app-professional')

@section('head')
<x-seo-meta 
    title="Sertifikat & Penghargaan - PT Swabina Gatra"
    description="Sertifikat dan penghargaan yang telah diraih PT Swabina Gatra sebagai bukti komitmen kami dalam memberikan layanan berkualitas tinggi."
    :keywords="['sertifikat swabina', 'penghargaan', 'sertifikasi', 'awards', 'ISO certification']"
    url="{{ route('sertif') }}"
/>
<x-structured-data type="article" :data="[
    'headline' => 'Sertifikat & Penghargaan',
    'description' => 'Sertifikat dan penghargaan PT Swabina Gatra'
]" />
@endsection

@section('page-header')
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-award-fill"></i> Sertifikat & Penghargaan
        </h1>
        <p class="lead">Bukti Komitmen Kami dalam Memberikan Layanan Terbaik</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-white">Tentang Kami</a></li>
                <li class="breadcrumb-item active text-white-50">Sertifikat & Penghargaan</li>
            </ol>
        </nav>
    </div>
</section>
@endsection

@section('content')
<!-- Sertifikat Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-trophy text-warning"></i> Pencapaian Kami
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">Sertifikasi dan penghargaan yang membuktikan kualitas layanan kami</p>
        </div>

        <div class="row g-4">
            @if($sertifikatPenghargaan && $sertifikatPenghargaan->count() > 0)
            @foreach($sertifikatPenghargaan as $sertifikat)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm hover-lift certificate-card">
                    <div class="card-img-wrapper">
                        @if($sertifikat->gambar)
                            <img src="{{ asset('storage/sertifikat_penghargaans/' . $sertifikat->gambar) }}" 
                                 class="card-img-top" 
                                 alt="{{ $sertifikat->judul }}"
                                 style="height: 300px; object-fit: cover;">
                        @else
                            <div class="placeholder-img bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                <i class="bi bi-award text-muted" style="font-size: 4rem;"></i>
                            </div>
                        @endif
                        <div class="card-img-overlay-hover">
                            <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#certificateModal{{ $sertifikat->id }}">
                                <i class="bi bi-zoom-in"></i> Lihat Detail
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="certificate-badge mb-2">
                            <span class="badge bg-primary">
                                <i class="bi bi-patch-check-fill me-1"></i>Verified
                            </span>
                        </div>
                        <h5 class="card-title fw-bold">{{ $sertifikat->judul }}</h5>
                        <p class="card-text text-muted small">{{ $sertifikat->deskripsi }}</p>
                    </div>
                </div>
            </div>

            <!-- Modal for Certificate Detail -->
            <div class="modal fade" id="certificateModal{{ $sertifikat->id }}" tabindex="-1">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">{{ $sertifikat->judul }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center">
                            @if($sertifikat->gambar)
                                <img src="{{ asset('storage/sertifikat_penghargaans/' . $sertifikat->gambar) }}" 
                                     class="img-fluid" 
                                     alt="{{ $sertifikat->judul }}">
                            @endif
                            <p class="mt-3 text-muted">{{ $sertifikat->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="alert alert-info text-center py-5" role="alert">
                <i class="bi bi-info-circle me-2"></i>
                <span>Sertifikat dan penghargaan akan segera ditampilkan.</span>
            </div>
        @endif
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Percayakan Kebutuhan Anda pada Kami</h2>
                <p class="lead mb-4">Dengan sertifikasi dan pengalaman yang telah teruji</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('facility-management') }}" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-briefcase-fill me-2"></i>Lihat Layanan
                    </a>
                    <a href="{{ route('kontakkami') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-envelope-fill me-2"></i>Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.certificate-card {
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

.certificate-card:hover .card-img-wrapper img {
    transform: scale(1.1);
}

.card-img-overlay-hover {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.certificate-card:hover .card-img-overlay-hover {
    opacity: 1;
}

.certificate-badge {
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
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
