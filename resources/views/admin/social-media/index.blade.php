@extends($layout)

@section('page-title', 'Pengaturan Social Media')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Social Media</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <p class="text-muted">Kelola semua link social media perusahaan</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.social-media.edit', $social->id) }}" class="btn btn-primary">
                <i class="bi bi-pencil-circle me-2"></i>Edit Social Media
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <!-- Facebook -->
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center p-3 border rounded">
                        <i class="bi bi-facebook" style="font-size: 2rem; color: #0a66c2; margin-right: 15px;"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Facebook</h6>
                            @if($social->facebook)
                                <a href="{{ $social->facebook }}" target="_blank" class="text-muted small">
                                    {{ Str::limit($social->facebook, 40) }}
                                </a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Instagram -->
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center p-3 border rounded">
                        <i class="bi bi-instagram" style="font-size: 2rem; color: #e4405f; margin-right: 15px;"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">Instagram</h6>
                            @if($social->instagram)
                                <a href="{{ $social->instagram }}" target="_blank" class="text-muted small">
                                    {{ Str::limit($social->instagram, 40) }}
                                </a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- YouTube -->
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center p-3 border rounded">
                        <i class="bi bi-youtube" style="font-size: 2rem; color: #ff0000; margin-right: 15px;"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">YouTube</h6>
                            @if($social->youtube)
                                <a href="{{ $social->youtube }}" target="_blank" class="text-muted small">
                                    {{ Str::limit($social->youtube, 40) }}
                                </a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- YouTube Landing -->
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center p-3 border rounded">
                        <i class="bi bi-youtube" style="font-size: 2rem; color: #ff0000; margin-right: 15px;"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">YouTube Landing</h6>
                            @if($social->youtube_landing)
                                <a href="{{ $social->youtube_landing }}" target="_blank" class="text-muted small">
                                    {{ Str::limit($social->youtube_landing, 40) }}
                                </a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center p-3 border rounded">
                        <i class="bi bi-whatsapp" style="font-size: 2rem; color: #25d366; margin-right: 15px;"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">WhatsApp</h6>
                            @if($social->whatsapp)
                                <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $social->whatsapp) }}" target="_blank" class="text-muted small">
                                    {{ Str::limit($social->whatsapp, 40) }}
                                </a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- LinkedIn -->
                <div class="col-md-6 mb-4">
                    <div class="d-flex align-items-center p-3 border rounded">
                        <i class="bi bi-linkedin" style="font-size: 2rem; color: #0a66c2; margin-right: 15px;"></i>
                        <div class="flex-grow-1">
                            <h6 class="mb-1">LinkedIn</h6>
                            @if($social->linkedin)
                                <a href="{{ $social->linkedin }}" target="_blank" class="text-muted small">
                                    {{ Str::limit($social->linkedin, 40) }}
                                </a>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
