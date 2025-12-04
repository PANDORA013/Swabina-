@extends('layouts.app-professional')

@section('title', 'Layanan Kami - ' . ($companyInfo->company_name ?? 'Swabina Gatra'))

@section('meta')
<meta name="description" content="Layanan profesional PT Swabina Gatra: Academy, Facility Management, Digital Solution, Tour Organizer, dan AMDK">
<meta name="keywords" content="layanan swabina, facility management, digital solution, tour organizer, training">
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center min-vh-40">
            <div class="col-lg-10 mx-auto text-center">
                <h1 class="display-4 fw-bold mb-3">Layanan Kami</h1>
                <p class="lead mb-0">Solusi Terintegrasi untuk Kebutuhan Bisnis Anda</p>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="py-5">
    <div class="container">
        <div class="row g-4">
            @forelse($services as $service)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-scale">
                    <div class="card-body p-4">
                        <!-- Icon -->
                        @if($service->icon)
                        <div class="mb-4 text-center">
                            <div class="icon-box">
                                <i class="bi {{ $service->icon }} display-3 text-primary"></i>
                            </div>
                        </div>
                        @endif

                        <!-- Title -->
                        <h3 class="h4 mb-3 text-center">{{ $service->title }}</h3>

                        <!-- Subtitle -->
                        <p class="text-muted text-center mb-4">{{ $service->subtitle }}</p>

                        <!-- Description (short) -->
                        <p class="small text-muted mb-4">
                            {{ Str::limit($service->description, 120) }}
                        </p>

                        <!-- Button -->
                        <div class="text-center">
                            <a href="{{ route('layanan.show', $service->slug) }}" class="btn btn-outline-primary">
                                Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="bi bi-info-circle me-2"></i>
                    Layanan akan segera tersedia.
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h2 class="h3 mb-3">Butuh Konsultasi?</h2>
                <p class="text-muted mb-4">Tim ahli kami siap membantu Anda menemukan solusi terbaik untuk kebutuhan bisnis Anda</p>
                <a href="{{ route('kontakkami') }}" class="btn btn-primary btn-lg">
                    <i class="bi bi-telephone me-2"></i>Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<style>
    .min-vh-40 {
        min-height: 40vh;
    }
    
    .hover-scale {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .hover-scale:hover {
        transform: translateY(-10px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }
    
    .icon-box {
        display: inline-block;
        padding: 20px;
        background: rgba(0, 86, 179, 0.1);
        border-radius: 50%;
    }
</style>
@endpush
