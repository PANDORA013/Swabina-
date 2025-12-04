@extends('layouts.app')

@section('title', 'Tentang Kami - ' . ($companyInfo->company_name ?? 'Swabina Gatra'))

@section('meta')
<meta name="description" content="Tentang PT Swabina Gatra - Visi, Misi, Sejarah, dan Pencapaian perusahaan layanan terintegrasi terkemuka di Indonesia">
<meta name="keywords" content="tentang swabina, profil perusahaan, visi misi, sejarah, sertifikat">
@endsection

@section('content')
<!-- Hero Section -->
<section id="hero" class="hero-section py-5 bg-gradient-primary text-white">
    <div class="container">
        <div class="row align-items-center min-vh-50">
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="display-3 fw-bold mb-4">Tentang Kami</h1>
                <p class="lead mb-4">Membangun Masa Depan Bersama dengan Profesionalisme dan Integritas</p>
                
                <!-- Quick Navigation -->
                <div class="d-flex flex-wrap justify-content-center gap-3 mt-5">
                    <a href="#sekilas" class="btn btn-light btn-sm smooth-scroll">
                        <i class="bi bi-building me-1"></i> Sekilas
                    </a>
                    <a href="#visi-misi" class="btn btn-light btn-sm smooth-scroll">
                        <i class="bi bi-bullseye me-1"></i> Visi & Misi
                    </a>
                    <a href="#jejak-langkah" class="btn btn-light btn-sm smooth-scroll">
                        <i class="bi bi-clock-history me-1"></i> Jejak Langkah
                    </a>
                    <a href="#sertifikat" class="btn btn-light btn-sm smooth-scroll">
                        <i class="bi bi-award me-1"></i> Sertifikat
                    </a>
                    <a href="#mengapa-kami" class="btn btn-light btn-sm smooth-scroll">
                        <i class="bi bi-star me-1"></i> Mengapa Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sekilas Perusahaan Section -->
<section id="sekilas" class="py-5">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <h2 class="display-5 fw-bold mb-4">Sekilas Perusahaan</h2>
                @if($companyInfo)
                <div class="text-muted lh-lg">
                    <p class="lead">{{ $companyInfo->company_name ?? 'PT Swabina Gatra' }}</p>
                    <p>{{ $companyInfo->description ?? 'Perusahaan penyedia layanan terintegrasi yang berfokus pada kualitas dan kepuasan klien.' }}</p>
                    
                    @if($companyInfo->established_year)
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-calendar-check text-primary fs-4 me-3"></i>
                        <div>
                            <strong>Didirikan:</strong> {{ $companyInfo->established_year }}
                        </div>
                    </div>
                    @endif
                </div>
                @endif
            </div>
            <div class="col-lg-6">
                @if($companyInfo && $companyInfo->logo)
                <img 
                    src="{{ asset('storage/' . $companyInfo->logo) }}" 
                    alt="{{ $companyInfo->company_name }}" 
                    class="img-fluid rounded shadow-lg"
                    loading="lazy"
                    width="600"
                    height="400"
                >
                @else
                <div class="bg-light rounded p-5 text-center">
                    <i class="bi bi-building display-1 text-muted"></i>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Visi & Misi Section -->
<section id="visi-misi" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Visi & Misi</h2>
            <p class="text-muted">Arah dan Tujuan Kami</p>
        </div>
        
        <div class="row g-4">
            <!-- Visi -->
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="icon-circle bg-primary text-white mx-auto mb-3">
                                <i class="bi bi-eye display-4"></i>
                            </div>
                            <h3 class="h4 fw-bold">Visi</h3>
                        </div>
                        @if($companyInfo && $companyInfo->vision)
                        <p class="text-center text-muted lh-lg">{{ $companyInfo->vision }}</p>
                        @else
                        <p class="text-center text-muted lh-lg">
                            Menjadi perusahaan penyedia layanan terintegrasi terkemuka di Indonesia yang dipercaya dan profesional.
                        </p>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Misi -->
            <div class="col-lg-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <div class="icon-circle bg-success text-white mx-auto mb-3">
                                <i class="bi bi-bullseye display-4"></i>
                            </div>
                            <h3 class="h4 fw-bold">Misi</h3>
                        </div>
                        @if($companyInfo && $companyInfo->mission)
                        <div class="text-muted lh-lg">
                            {!! nl2br(e($companyInfo->mission)) !!}
                        </div>
                        @else
                        <ul class="list-unstyled text-muted">
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Memberikan layanan berkualitas tinggi</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Mengembangkan SDM profesional</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Berinovasi secara berkelanjutan</li>
                            <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Membangun kemitraan jangka panjang</li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Jejak Langkah (Timeline) Section -->
<section id="jejak-langkah" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Jejak Langkah</h2>
            <p class="text-muted">Perjalanan dan Pencapaian Kami</p>
        </div>
        
        @if($jejakLangkahs->isNotEmpty())
        <div class="timeline">
            @foreach($jejakLangkahs as $index => $jejak)
            <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}">
                <div class="timeline-content">
                    <div class="timeline-year">{{ $jejak->year }}</div>
                    <h4 class="h5 mb-3">{{ $jejak->title }}</h4>
                    <p class="text-muted">{{ $jejak->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle me-2"></i>
            Timeline akan segera tersedia.
        </div>
        @endif
    </div>
</section>

<!-- Sertifikat & Penghargaan Section -->
<section id="sertifikat" class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Sertifikat & Penghargaan</h2>
            <p class="text-muted">Pengakuan atas Komitmen Kualitas Kami</p>
        </div>
        
        @if($sertifikats->isNotEmpty())
        <div class="row g-4">
            @foreach($sertifikats as $sertifikat)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100 border-0 shadow-sm hover-lift">
                    @if($sertifikat->image)
                    <img 
                        src="{{ asset('storage/' . $sertifikat->image) }}" 
                        alt="{{ $sertifikat->name }}"
                        class="card-img-top"
                        loading="lazy"
                        width="300"
                        height="400"
                    >
                    @else
                    <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                        <i class="bi bi-award display-3 text-muted"></i>
                    </div>
                    @endif
                    <div class="card-body text-center">
                        <h5 class="h6 mb-2">{{ $sertifikat->name }}</h5>
                        @if($sertifikat->year)
                        <p class="text-muted small mb-0">{{ $sertifikat->year }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i>
                    Informasi sertifikat dan penghargaan akan segera tersedia.
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Mengapa Memilih Kami Section -->
<section id="mengapa-kami" class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold">Mengapa Memilih Kami?</h2>
            <p class="text-muted">Keunggulan yang Membedakan Kami</p>
        </div>
        
        @if($whyChooseUs->isNotEmpty())
        <div class="row g-4">
            @foreach($whyChooseUs as $reason)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    @if($reason->icon)
                    <div class="mb-3">
                        <i class="bi {{ $reason->icon }} display-4 text-primary"></i>
                    </div>
                    @endif
                    <h4 class="h5 mb-3">{{ $reason->title }}</h4>
                    <p class="text-muted">{{ $reason->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="row g-4">
            <!-- Default reasons if database is empty -->
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-award display-4 text-primary"></i>
                    </div>
                    <h4 class="h5 mb-3">Berpengalaman</h4>
                    <p class="text-muted">Pengalaman puluhan tahun melayani berbagai industri</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-people display-4 text-primary"></i>
                    </div>
                    <h4 class="h5 mb-3">Tim Profesional</h4>
                    <p class="text-muted">SDM terlatih dan bersertifikat internasional</p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="mb-3">
                        <i class="bi bi-shield-check display-4 text-primary"></i>
                    </div>
                    <h4 class="h5 mb-3">Terpercaya</h4>
                    <p class="text-muted">Dipercaya oleh perusahaan terkemuka di Indonesia</p>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="h3 mb-3">Ingin Bekerja Sama dengan Kami?</h2>
                <p class="mb-4">Mari wujudkan kesuksesan bersama dengan solusi terbaik dari kami</p>
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="{{ route('kontakkami') }}" class="btn btn-light btn-lg">
                        <i class="bi bi-envelope me-2"></i>Hubungi Kami
                    </a>
                    <a href="{{ route('layanan.index') }}" class="btn btn-outline-light btn-lg">
                        <i class="bi bi-grid me-2"></i>Lihat Layanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .min-vh-50 {
        min-height: 50vh;
    }
    
    .bg-gradient-primary {
        background: linear-gradient(135deg, #0056b3 0%, #003d82 100%);
    }
    
    .smooth-scroll {
        scroll-behavior: smooth;
    }
    
    .icon-circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    /* Timeline Styles */
    .timeline {
        position: relative;
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px 0;
    }
    
    .timeline::after {
        content: '';
        position: absolute;
        width: 4px;
        background-color: #0056b3;
        top: 0;
        bottom: 0;
        left: 50%;
        margin-left: -2px;
    }
    
    .timeline-item {
        padding: 10px 40px;
        position: relative;
        background-color: inherit;
        width: 50%;
    }
    
    .timeline-item.left {
        left: 0;
    }
    
    .timeline-item.right {
        left: 50%;
    }
    
    .timeline-item::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        right: -10px;
        background-color: white;
        border: 4px solid #0056b3;
        top: 15px;
        border-radius: 50%;
        z-index: 1;
    }
    
    .timeline-item.right::after {
        left: -10px;
    }
    
    .timeline-content {
        padding: 20px 30px;
        background-color: white;
        position: relative;
        border-radius: 6px;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    }
    
    .timeline-year {
        display: inline-block;
        background: #0056b3;
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    
    .hover-lift {
        transition: transform 0.3s ease;
    }
    
    .hover-lift:hover {
        transform: translateY(-10px);
    }
    
    /* Mobile Responsive */
    @media screen and (max-width: 768px) {
        .timeline::after {
            left: 31px;
        }
        
        .timeline-item {
            width: 100%;
            padding-left: 70px;
            padding-right: 25px;
        }
        
        .timeline-item.right {
            left: 0%;
        }
        
        .timeline-item::after {
            left: 21px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Smooth scroll for anchor links
    document.querySelectorAll('a.smooth-scroll[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
</script>
@endpush
