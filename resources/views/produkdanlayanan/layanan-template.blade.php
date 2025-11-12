@extends('layouts.app-professional')

@section('head')
<x-seo-meta 
    title="{{ $title ?? 'Layanan' }} - PT Swabina Gatra"
    description="{{ $description ?? 'Layanan profesional dari PT Swabina Gatra' }}"
    :keywords="$keywords ?? ['swabina', 'layanan', 'facility management']"
    url="{{ route('facility-management') }}"
/>
@endsection

@section('page-header')
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi {{ $icon ?? 'bi-briefcase' }}"></i> {{ $title ?? 'Layanan Kami' }}
        </h1>
        <p class="lead">{{ $subtitle ?? 'Solusi Profesional untuk Bisnis Anda' }}</p>
    </div>
</section>
@endsection

@section('content')
<div class="container py-5">
    <!-- Overview Section -->
    <section class="mb-5">
        <div class="section-header text-center mb-4">
            <h2 class="section-title">
                <i class="bi bi-info-circle text-primary"></i> Tentang Layanan Kami
            </h2>
            <div class="title-underline"></div>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-8 mx-auto">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <p class="text-muted mb-0" style="text-align: justify; line-height: 1.8; font-size: 1.1rem;">
                            {{ $companyInfo?->company_description ?? 'PT Swabina Gatra menyediakan solusi layanan profesional dengan standar kualitas internasional.' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Tertarik dengan Layanan Kami?</h2>
                <p class="lead mb-4">Hubungi tim profesional kami untuk konsultasi gratis dan solusi terbaik untuk kebutuhan bisnis Anda.</p>
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
    </section>
</div>
@endsection

@section('styles')
<style>
.feature-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 60px;
    height: 60px;
    margin: 0 auto;
    background: rgba(13, 110, 253, 0.1);
    border-radius: 50%;
}

.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15) !important;
}

.section-title {
    font-size: 2rem;
    font-weight: 700;
    color: #0d6efd;
}

.title-underline {
    width: 60px;
    height: 4px;
    background: #0d6efd;
    border-radius: 2px;
    margin: 1rem auto;
}
</style>
@endsection
