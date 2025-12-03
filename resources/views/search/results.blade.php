@extends('layouts.app-professional')

@section('title', 'Hasil Pencarian: ' . $query)
@section('meta_description', 'Hasil pencarian untuk "' . $query . '" di website PT Swabina Gatra')

@section('page-header')
<div class="container">
    <h1><i class="bi bi-search"></i> Hasil Pencarian</h1>
    <p>Ditemukan <strong>{{ $totalResults }}</strong> hasil untuk "<strong>{{ $query }}</strong>"</p>
</div>
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="{{ route('beranda') }}">Beranda</a></li>
<li class="breadcrumb-item active">Hasil Pencarian</li>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            {{-- Search Again --}}
            <div class="card mb-4">
                <div class="card-body">
                    <x-search-bar />
                </div>
            </div>

            @if($totalResults > 0)
                {{-- Layanan Results --}}
                @if(isset($results['layanan']) && count($results['layanan']) > 0)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h2 class="mb-0" style="font-size: 1.25rem;">
                            <i class="bi bi-briefcase"></i> Layanan ({{ count($results['layanan']) }})
                        </h2>
                    </div>
                    <div class="card-body">
                        @foreach($results['layanan'] as $item)
                        <div class="search-result-item">
                            <h3 style="font-size: 1rem;">
                                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                            </h3>
                            <p class="text-muted mb-2">{{ $item['description'] }}</p>
                            <small class="text-primary">
                                <i class="bi bi-link-45deg"></i> {{ $item['url'] }}
                            </small>
                        </div>
                        @if(!$loop->last)
                        <hr>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Berita Results --}}
                @if(isset($results['berita']) && count($results['berita']) > 0)
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h2 class="mb-0" style="font-size: 1.25rem;">
                            <i class="bi bi-newspaper"></i> Berita ({{ count($results['berita']) }})
                        </h2>
                    </div>
                    <div class="card-body">
                        @foreach($results['berita'] as $item)
                        <div class="search-result-item">
                            <h3 style="font-size: 1rem;">
                                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                            </h3>
                            <p class="text-muted mb-2">{{ $item['description'] }}</p>
                            <small class="text-muted">
                                <i class="bi bi-calendar"></i> {{ $item['date'] ?? 'N/A' }}
                            </small>
                        </div>
                        @if(!$loop->last)
                        <hr>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- FAQ Results --}}
                @if(isset($results['faq']) && count($results['faq']) > 0)
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h2 class="mb-0" style="font-size: 1.25rem;">
                            <i class="bi bi-question-circle"></i> FAQ ({{ count($results['faq']) }})
                        </h2>
                    </div>
                    <div class="card-body">
                        @foreach($results['faq'] as $item)
                        <div class="search-result-item">
                            <h3 style="font-size: 1rem;">
                                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                            </h3>
                            <p class="text-muted mb-0">{{ $item['description'] }}</p>
                        </div>
                        @if(!$loop->last)
                        <hr>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Tentang Kami Results --}}
                @if(isset($results['tentang']) && count($results['tentang']) > 0)
                <div class="card mb-4">
                    <div class="card-header bg-warning text-white">
                        <h2 class="mb-0" style="font-size: 1.25rem;">
                            <i class="bi bi-info-circle"></i> Tentang Kami ({{ count($results['tentang']) }})
                        </h2>
                    </div>
                    <div class="card-body">
                        @foreach($results['tentang'] as $item)
                        <div class="search-result-item">
                            <h3 style="font-size: 1rem;">
                                <a href="{{ $item['url'] }}">{{ $item['title'] }}</a>
                            </h3>
                            <p class="text-muted mb-0">{{ $item['description'] }}</p>
                        </div>
                        @if(!$loop->last)
                        <hr>
                        @endif
                        @endforeach
                    </div>
                </div>
                @endif
            @else
                {{-- No Results --}}
                <div class="card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-search" style="font-size: 4rem; color: #ccc;"></i>
                        <h2 class="mt-3">Tidak Ada Hasil</h2>
                        <p class="text-muted">
                            Maaf, kami tidak menemukan hasil untuk "<strong>{{ $query }}</strong>".
                        </p>
                        <p class="text-muted mb-4">Saran:</p>
                        <ul class="list-unstyled text-muted">
                            <li>• Periksa ejaan kata kunci</li>
                            <li>• Coba gunakan kata kunci yang lebih umum</li>
                            <li>• Coba gunakan kata kunci yang berbeda</li>
                        </ul>
                    </div>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="col-lg-4">
            {{-- Popular Searches --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-fire"></i> Pencarian Populer
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ url('/search?q=facility+management') }}" class="badge bg-primary text-decoration-none">Facility Management</a>
                        <a href="{{ url('/search?q=training') }}" class="badge bg-primary text-decoration-none">Training</a>
                        <a href="{{ url('/search?q=digital+solution') }}" class="badge bg-primary text-decoration-none">Digital Solution</a>
                        <a href="{{ url('/search?q=sertifikat') }}" class="badge bg-primary text-decoration-none">Sertifikat</a>
                        <a href="{{ url('/search?q=kontak') }}" class="badge bg-primary text-decoration-none">Kontak</a>
                        <a href="{{ url('/search?q=karir') }}" class="badge bg-primary text-decoration-none">Karir</a>
                    </div>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-link-45deg"></i> Link Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <a href="{{ route('facility-management') }}" class="text-decoration-none">
                                <i class="bi bi-chevron-right"></i> Facility Management
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('swaacademy') }}" class="text-decoration-none">
                                <i class="bi bi-chevron-right"></i> SWA Academy
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('digitalsolution') }}" class="text-decoration-none">
                                <i class="bi bi-chevron-right"></i> Digital Solution
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('berita') }}" class="text-decoration-none">
                                <i class="bi bi-chevron-right"></i> Berita Terbaru
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('faq') }}" class="text-decoration-none">
                                <i class="bi bi-chevron-right"></i> FAQ
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="{{ route('kontakkami') }}" class="text-decoration-none">
                                <i class="bi bi-chevron-right"></i> Kontak Kami
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- Need Help? --}}
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <i class="bi bi-headset" style="font-size: 3rem;"></i>
                    <h5 class="mt-3">Butuh Bantuan?</h5>
                    <p class="mb-3">Tim kami siap membantu Anda</p>
                    <a href="{{ route('kontakkami') }}" class="btn btn-light">
                        <i class="bi bi-envelope"></i> Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.search-result-item h6 a {
    color: var(--primary-color, #0056b3);
    text-decoration: none;
    font-size: 1.1rem;
    font-weight: 600;
}

.search-result-item h6 a:hover {
    text-decoration: underline;
}

.search-result-item {
    padding: 1rem 0;
}

.search-result-item:first-child {
    padding-top: 0;
}

.search-result-item:last-child {
    padding-bottom: 0;
}

.badge {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
    font-weight: 500;
}
</style>
@endsection
