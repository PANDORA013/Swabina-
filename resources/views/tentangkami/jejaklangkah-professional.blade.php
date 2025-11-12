@extends('layouts.app-professional')

@section('head')
<x-seo-meta 
    title="Jejak Langkah Perusahaan - PT Swabina Gatra"
    description="Sejarah dan perjalanan PT Swabina Gatra dari awal berdiri hingga menjadi perusahaan terkemuka di bidang facility management dan layanan terpadu."
    :keywords="['sejarah swabina', 'jejak langkah', 'perjalanan perusahaan', 'milestone swabina', 'company history']"
    url="{{ route('jejaklangkah') }}"
/>
<x-structured-data type="article" :data="[
    'headline' => 'Jejak Langkah Perusahaan',
    'description' => 'Sejarah dan perjalanan PT Swabina Gatra'
]" />
@endsection

@section('page-header')
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-clock-history"></i> Jejak Langkah
        </h1>
        <p class="lead">Perjalanan dan Pencapaian PT Swabina Gatra</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#" class="text-white">Tentang Kami</a></li>
                <li class="breadcrumb-item active text-white-50">Jejak Langkah</li>
            </ol>
        </nav>
    </div>
</section>
@endsection

@section('content')
<!-- Timeline Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-calendar-event text-primary"></i> Timeline Pencapaian
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">Perjalanan kami dari waktu ke waktu</p>
        </div>

        <div class="timeline">
            @foreach($jejakLangkahs as $index => $jejak)
            <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}">
                <div class="timeline-card card border-0 shadow-sm hover-lift">
                    <div class="card-body p-4">
                        <div class="timeline-year">
                            <span class="badge bg-primary fs-5 px-4 py-2">{{ $jejak->tahun }}</span>
                        </div>
                        <h3 class="card-title h5 fw-bold text-primary mb-3">{{ $jejak->judul }}</h3>
                        <p class="card-text text-muted mb-0" style="text-align: justify; line-height: 1.8;">
                            {{ $jejak->deskripsi }}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Buat Sejarah Bersama Kami</h2>
                <p class="lead mb-4">Mari bergabung dan menjadi bagian dari pencapaian kami selanjutnya</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('sekilas') }}" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-building me-2"></i>Tentang Kami
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
.timeline {
    position: relative;
    padding: 2rem 0;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    bottom: 0;
    width: 4px;
    background: linear-gradient(to bottom, #0d6efd, #0a58ca);
    transform: translateX(-50%);
}

.timeline-item {
    position: relative;
    margin-bottom: 3rem;
    width: 50%;
    padding: 0 2rem;
}

.timeline-item.left {
    left: 0;
    text-align: right;
}

.timeline-item.right {
    left: 50%;
    text-align: left;
}

.timeline-item::before {
    content: '';
    position: absolute;
    top: 20px;
    width: 20px;
    height: 20px;
    background: #0d6efd;
    border: 4px solid white;
    border-radius: 50%;
    box-shadow: 0 0 0 4px #0d6efd;
    z-index: 1;
}

.timeline-item.left::before {
    right: -10px;
}

.timeline-item.right::before {
    left: -10px;
}

.timeline-card {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,.175)!important;
}

.timeline-year {
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .timeline::before {
        left: 20px;
    }
    
    .timeline-item {
        width: 100%;
        left: 0 !important;
        text-align: left !important;
        padding-left: 60px;
        padding-right: 1rem;
    }
    
    .timeline-item::before {
        left: 11px !important;
    }
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
