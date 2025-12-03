@extends('layouts.app-professional')

{{-- SEO Meta Tags --}}
@section('head')
<x-seo-meta 
    title="Berita & Artikel - PT Swabina Gatra"
    description="Berita terkini, artikel, dan update dari PT Swabina Gatra mengenai Facility Management, Digital Solution, dan layanan profesional lainnya."
    :keywords="['Berita Swabina', 'Artikel', 'Update', 'News', 'Facility Management', 'Swabina Gatra']"
    :image="asset('images/og-berita.jpg')"
/>
<x-structured-data type="website" />
@endsection

{{-- Page Header --}}
@section('page-header')
<div class="page-header bg-gradient" style="background: linear-gradient(135deg, var(--primary-blue) 0%, var(--primary-color) 100%); padding: 4rem 0; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">
                    <i class="bi bi-newspaper"></i> Berita & Artikel
                </h1>
                <p class="lead mb-0">Informasi dan update terkini dari PT Swabina Gatra</p>
            </div>
            <div class="col-lg-4 text-end">
                <i class="bi bi-newspaper" style="font-size: 5rem; opacity: 0.2;"></i>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- Main Content --}}
@section('content')
<div class="container py-5">
    @if($berita && $berita->count() > 0)
        <div class="row g-4">
            @foreach($berita as $item)
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="berita-card card h-100 border-0 shadow-sm hover-lift">
                    <div class="card-body text-center d-flex flex-column">
                        {{-- Image/Icon Section --}}
                        @if($item->image)
                            <div class="berita-image mb-3">
                                <img src="{{ asset('storage/' . $item->image) }}" 
                                     alt="{{ is_array($item->title) ? $item->title[app()->getLocale()] ?? $item->title['id'] : $item->title }}"
                                     loading="lazy"
                                     class="img-fluid"
                                     style="width: 100%; height: 160px; object-fit: cover; border-radius: 8px;">
                            </div>
                        @else
                            <div class="berita-icon mb-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); height: 160px; display: flex; align-items: center; justify-content: center; border-radius: 8px;">
                                <i class="bi bi-newspaper" style="font-size: 3rem; color: white;"></i>
                            </div>
                        @endif
                        
                        {{-- Date --}}
                        <small class="text-muted mb-2" style="font-size: 0.85rem;">
                            <i class="bi bi-calendar-event"></i> 
                            {{ $item->created_at->format('d M Y') }}
                        </small>
                        
                        {{-- Title --}}
                        <h5 class="card-title fw-bold mb-2" style="min-height: 50px; display: flex; align-items: center; justify-content: center;">
                            {{ Str::limit(is_array($item->title) ? $item->title[app()->getLocale()] ?? $item->title['id'] : $item->title, 60) }}
                        </h5>
                        
                        {{-- Description --}}
                        <p class="card-text" style="font-size: 0.9rem; color: var(--text-gray); min-height: 60px;">
                            {{ Str::limit(is_array($item->description) ? $item->description[app()->getLocale()] ?? $item->description['id'] : $item->description, 90) }}
                        </p>
                        
                        {{-- Read More Button --}}
                        <div class="mt-auto pt-3 border-top">
                            <a href="{{ route('berita.show', $item->id) }}" class="btn btn-primary btn-sm w-100">
                                <i class="bi bi-arrow-right"></i> Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="alert alert-info text-center py-5" role="alert">
            <i class="bi bi-info-circle" style="font-size: 3rem; display: block; margin-bottom: 1rem; opacity: 0.5;"></i>
            <h5>Belum Ada Berita</h5>
            <p class="text-muted mb-0">Mohon tunggu, berita akan segera ditambahkan.</p>
        </div>
    @endif
</div>

{{-- Call to Action Section --}}
<section class="bg-light py-5">
    <div class="container text-center">
        <h3 class="mb-4">Ingin Mengetahui Lebih Lanjut?</h3>
        <p class="text-muted mb-4">Hubungi kami untuk informasi lengkap tentang layanan dan penawaran terbaru dari PT Swabina Gatra.</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="{{ route('kontakkami') }}" class="btn btn-primary">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
            <a href="{{ route('faq') }}" class="btn btn-outline-primary">
                <i class="bi bi-question-circle"></i> FAQ
            </a>
            <a href="{{ route('beranda') }}" class="btn btn-outline-secondary">
                <i class="bi bi-house"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

@endsection

@section('styles')
<style>
    .berita-card {
        border: none;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .berita-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .berita-card .card-body {
        padding: 1.5rem;
    }

    .berita-image img {
        transition: transform 0.3s ease;
    }

    .berita-card:hover .berita-image img {
        transform: scale(1.05);
    }

    .page-header {
        margin-bottom: 3rem;
    }

    .page-header h1 {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
    }
</style>
@endsection
