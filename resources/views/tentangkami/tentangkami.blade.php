<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - PT Swabina Gatra</title>
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/professional-header.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/professional-layout.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/professional-footer.css')}}">
</head>
<body>
    <!-- Professional Header -->
    @include('partials.professional-header')
    
    <!-- Navbar -->
    @include('partials.professional-nav')
    
    <!-- Breadcrumb -->
    @include('partials.breadcrumb')
    
    <!-- Main Content -->
    <section class="container my-5">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="mb-4" style="color: #0454a3;">Tentang Kami</h1>
                
                <!-- Company Overview -->
                <div class="mb-5">
                    <h2 style="color: #0454a3; border-bottom: 3px solid #0454a3; padding-bottom: 10px;">Sekilas Perusahaan</h2>
                    <p class="mt-3">
                        {{ $companyInfo->company_description ?? 'PT Swabina Gatra adalah perusahaan terkemuka di bidang facility management dan layanan bisnis terpadu.' }}
                    </p>
                </div>
                
                <!-- Vision & Mission -->
                <div class="mb-5">
                    <h2 style="color: #0454a3; border-bottom: 3px solid #0454a3; padding-bottom: 10px;">Visi & Misi</h2>
                    
                    @if($visi->isNotEmpty())
                        <h4 class="mt-4">🎯 VISI</h4>
                        @foreach($visi as $item)
                            <p>{!! nl2br(e($item->content['id'] ?? '')) !!}</p>
                        @endforeach
                    @endif
                    
                    @if($misi->isNotEmpty())
                        <h4 class="mt-4">📋 MISI</h4>
                        @foreach($misi as $item)
                            <p>{!! nl2br(e($item->content['id'] ?? '')) !!}</p>
                        @endforeach
                    @endif
                    
                    @if($budaya->isNotEmpty())
                        <h4 class="mt-4">💼 BUDAYA PERUSAHAAN</h4>
                        @foreach($budaya as $item)
                            <p><strong>{{ $item->title ?? 'SIAP BISA' }}</strong></p>
                            <p>{!! nl2br(e($item->content['id'] ?? '')) !!}</p>
                        @endforeach
                    @endif
                </div>
                
                <!-- Company Milestones -->
                <div class="mb-5">
                    <h2 style="color: #0454a3; border-bottom: 3px solid #0454a3; padding-bottom: 10px;">Jejak Langkah</h2>
                    
                    @if($jejakLangkahs->isNotEmpty())
                        <div class="timeline mt-4">
                            @foreach($jejakLangkahs->sortBy('tahun') as $jejak)
                                <div class="timeline-item mb-4">
                                    <div class="timeline-marker" style="background: #0454a3; width: 12px; height: 12px; border-radius: 50%; display: inline-block; margin-right: 15px;"></div>
                                    <strong>{{ $jejak->tahun }}</strong> - {{ $jejak->deskripsi }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    
    <!-- Footer -->
    @include('partials.professional-footer')
    
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
