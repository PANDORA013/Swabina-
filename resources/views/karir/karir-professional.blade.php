@extends('layouts.app-professional')

@section('head')
<x-seo-meta 
    title="Karir & Lowongan Kerja - PT Swabina Gatra"
    description="Bergabunglah dengan PT Swabina Gatra. Lihat lowongan kerja terbaru dan kembangkan karir Anda bersama kami."
    :keywords="['karir swabina', 'lowongan kerja', 'job vacancy', 'careers', 'bergabung swabina']"
    url="{{ route('karir') }}"
/>
<x-structured-data type="organization" />
@endsection

@section('page-header')
<!-- Hero Section -->
<section class="hero-section bg-primary text-white py-5" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
    <div class="container text-center py-5">
        <h1 class="display-4 fw-bold mb-3">
            <i class="bi bi-briefcase-fill"></i> Karir
        </h1>
        <p class="lead">Bergabunglah Bersama Tim Profesional Kami</p>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center">
                <li class="breadcrumb-item"><a href="{{ route('beranda') }}" class="text-white">Beranda</a></li>
                <li class="breadcrumb-item active text-white-50">Karir</li>
            </ol>
        </nav>
    </div>
</section>
@endsection

@section('content')
<!-- Why Join Us Section -->
<section class="py-5 bg-light">
    <div class="container">
        <!-- Hero Image -->
        <div class="row mb-5">
            <div class="col-12">
                <div class="card border-0 shadow-sm overflow-hidden">
                    <img src="{{ asset('assets/gambar_karir/karir.png') }}" 
                         class="img-fluid w-100" 
                         alt="Karir di PT Swabina Gatra"
                         style="max-height: 400px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-img-overlay d-flex align-items-center justify-content-center" 
                         style="background: rgba(4, 84, 163, 0.7);">
                        <div class="text-center text-white">
                            <h2 class="display-5 fw-bold mb-3">Bangun Karir Impian Anda</h2>
                            <p class="lead">Bersama PT Swabina Gatra</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-star-fill text-warning"></i> Mengapa Bergabung dengan Kami?
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">Keuntungan berkarir di PT Swabina Gatra</p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm text-center hover-lift">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-graph-up-arrow text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Pengembangan Karir</h5>
                        <p class="card-text text-muted">Program pelatihan dan pengembangan berkelanjutan</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm text-center hover-lift">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-people-fill text-success" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Lingkungan Kerja</h5>
                        <p class="card-text text-muted">Budaya kerja yang positif dan kolaboratif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm text-center hover-lift">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-gift-fill text-danger" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Benefit Menarik</h5>
                        <p class="card-text text-muted">Kompensasi kompetitif dan fasilitas lengkap</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm text-center hover-lift">
                    <div class="card-body p-4">
                        <div class="icon-wrapper mb-3">
                            <i class="bi bi-award-fill text-warning" style="font-size: 3rem;"></i>
                        </div>
                        <h5 class="card-title fw-bold">Prestasi & Penghargaan</h5>
                        <p class="card-text text-muted">Apresiasi untuk kinerja terbaik</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Job Openings Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-card-checklist text-primary"></i> Lowongan Tersedia
            </h2>
            <div class="title-underline"></div>
            <p class="text-muted mt-3">Posisi yang sedang kami buka</p>
        </div>

        <div class="text-center py-5">
            <div class="mb-4">
                <i class="bi bi-inbox text-muted" style="font-size: 5rem;"></i>
            </div>
            <h3 class="h4 fw-bold mb-3">Saat Ini Belum Ada Lowongan</h3>
            <p class="text-muted mb-4">Kami akan mengumumkan lowongan baru di sini. Pantau terus halaman ini!</p>
            <p class="text-muted">Atau kirimkan CV Anda untuk kesempatan di masa depan:</p>
            <a href="mailto:hr@swabina.co.id" class="btn btn-primary btn-lg px-4 mt-3">
                <i class="bi bi-envelope-fill me-2"></i>Kirim Lamaran
            </a>
        </div>

        <!-- Template untuk lowongan (uncomment ketika ada lowongan) -->
        <!--
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm hover-lift h-100">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="card-title fw-bold mb-2">Posisi Jabatan</h5>
                                <p class="text-muted mb-0"><i class="bi bi-geo-alt-fill me-1"></i>Lokasi</p>
                            </div>
                            <span class="badge bg-primary">Full Time</span>
                        </div>
                        <p class="card-text text-muted mb-3">Deskripsi singkat posisi dan tanggung jawab utama.</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge bg-light text-dark"><i class="bi bi-mortarboard me-1"></i>S1</span>
                            <span class="badge bg-light text-dark"><i class="bi bi-clock me-1"></i>2-3 Tahun</span>
                        </div>
                        <button class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-arrow-right-circle me-1"></i>Lihat Detail
                        </button>
                    </div>
                </div>
            </div>
        </div>
        -->
    </div>
</section>

<!-- How to Apply Section -->
<section class="py-5">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">
                <i class="bi bi-file-earmark-text text-success"></i> Cara Melamar
            </h2>
            <div class="title-underline"></div>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="text-center">
                    <div class="step-number mb-3">
                        <span class="badge bg-primary rounded-circle p-3" style="width: 60px; height: 60px; font-size: 1.5rem;">1</span>
                    </div>
                    <h5 class="fw-bold">Pilih Posisi</h5>
                    <p class="text-muted small">Pilih posisi yang sesuai dengan keahlian Anda</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="step-number mb-3">
                        <span class="badge bg-primary rounded-circle p-3" style="width: 60px; height: 60px; font-size: 1.5rem;">2</span>
                    </div>
                    <h5 class="fw-bold">Siapkan Dokumen</h5>
                    <p class="text-muted small">CV, Surat Lamaran, Portfolio (jika ada)</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="step-number mb-3">
                        <span class="badge bg-primary rounded-circle p-3" style="width: 60px; height: 60px; font-size: 1.5rem;">3</span>
                    </div>
                    <h5 class="fw-bold">Kirim Lamaran</h5>
                    <p class="text-muted small">Email ke hr@swabina.co.id dengan subjek posisi</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="text-center">
                    <div class="step-number mb-3">
                        <span class="badge bg-primary rounded-circle p-3" style="width: 60px; height: 60px; font-size: 1.5rem;">4</span>
                    </div>
                    <h5 class="fw-bold">Tunggu Konfirmasi</h5>
                    <p class="text-muted small">Tim HR akan menghubungi kandidat terpilih</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="card border-0 shadow-lg" style="background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);">
            <div class="card-body text-center text-white py-5">
                <h2 class="h3 fw-bold mb-3">Siap Bergabung dengan Tim Kami?</h2>
                <p class="lead mb-4">Mulai karir profesional Anda bersama PT Swabina Gatra</p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="mailto:hr@swabina.co.id" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-envelope-fill me-2"></i>Kirim CV
                    </a>
                    <a href="{{ route('kontakkami') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-telephone-fill me-2"></i>Hubungi HRD
                    </a>
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

.step-number .badge {
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
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
