@extends('layouts.app')

@section('page-title', 'Dashboard Admin')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('content')

<div class="container-fluid py-4">
    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Berita</p>
                            <h3 class="mb-0">{{ $beritas->count() }}</h3>
                        </div>
                        <div class="icon icon-shape bg-gradient-primary shadow text-center rounded-circle">
                            <i class="fas fa-newspaper text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Sertifikat</p>
                            <h3 class="mb-0">{{ $sertifikats->count() }}</h3>
                        </div>
                        <div class="icon icon-shape bg-gradient-danger shadow text-center rounded-circle">
                            <i class="fas fa-certificate text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">FAQ</p>
                            <h3 class="mb-0">{{ $faqs->count() }}</h3>
                        </div>
                        <div class="icon icon-shape bg-gradient-success shadow text-center rounded-circle">
                            <i class="fas fa-question-circle text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1">Pedoman</p>
                            <h3 class="mb-0">{{ $pedomans->count() }}</h3>
                        </div>
                        <div class="icon icon-shape bg-gradient-warning shadow text-center rounded-circle">
                            <i class="fas fa-book text-lg opacity-10"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Akses Cepat</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-newspaper me-2"></i> Kelola Berita
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('admin.sertifikat.index') }}" class="btn btn-outline-danger w-100">
                                <i class="fas fa-certificate me-2"></i> Kelola Sertifikat
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('admin.faq.index') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-question-circle me-2"></i> Kelola FAQ
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="{{ route('admin.company-info.index') }}" class="btn btn-outline-info w-100">
                                <i class="fas fa-building me-2"></i> Info Perusahaan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .icon-shape {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0,0,0,0.075);
    }
    
    .card:hover {
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,0.15);
        transition: all 0.3s ease;
    }
</style>

@endsection
