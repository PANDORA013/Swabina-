@extends($layout)

@section('page-title', 'Edit Social Media')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.social-media.index') }}">Social Media</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h4 class="mb-2">Edit Social Media</h4>
            <p class="text-muted">Perbarui semua link social media perusahaan</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.social-media.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        <strong>Validation Error!</strong>
        <ul class="mb-0 mt-2">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <form action="{{ route('admin.social-media.update', $social->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="row">
                    <!-- Facebook -->
                    <div class="col-md-6 mb-4">
                        <label for="facebook" class="form-label">
                            <i class="bi bi-facebook" style="color: #0a66c2;"></i> Facebook
                        </label>
                        <input type="url" 
                            class="form-control @error('facebook') is-invalid @enderror" 
                            id="facebook" 
                            name="facebook" 
                            placeholder="https://facebook.com/yourpage"
                            value="{{ old('facebook', $social->facebook) }}">
                        @error('facebook')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">Format: https://facebook.com/username</small>
                    </div>

                    <!-- Instagram -->
                    <div class="col-md-6 mb-4">
                        <label for="instagram" class="form-label">
                            <i class="bi bi-instagram" style="color: #e4405f;"></i> Instagram
                        </label>
                        <input type="url" 
                            class="form-control @error('instagram') is-invalid @enderror" 
                            id="instagram" 
                            name="instagram" 
                            placeholder="https://instagram.com/yourprofile"
                            value="{{ old('instagram', $social->instagram) }}">
                        @error('instagram')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">Format: https://instagram.com/username</small>
                    </div>

                    <!-- YouTube -->
                    <div class="col-md-6 mb-4">
                        <label for="youtube" class="form-label">
                            <i class="bi bi-youtube" style="color: #ff0000;"></i> YouTube
                        </label>
                        <input type="url" 
                            class="form-control @error('youtube') is-invalid @enderror" 
                            id="youtube" 
                            name="youtube" 
                            placeholder="https://youtube.com/@yourchannel"
                            value="{{ old('youtube', $social->youtube) }}">
                        @error('youtube')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">Format: https://youtube.com/@channel atau https://youtube.com/c/channelname</small>
                    </div>

                    <!-- YouTube Landing -->
                    <div class="col-md-6 mb-4">
                        <label for="youtube_landing" class="form-label">
                            <i class="bi bi-youtube" style="color: #ff0000;"></i> YouTube Landing
                        </label>
                        <input type="url" 
                            class="form-control @error('youtube_landing') is-invalid @enderror" 
                            id="youtube_landing" 
                            name="youtube_landing" 
                            placeholder="https://youtube.com/@yourchannel"
                            value="{{ old('youtube_landing', $social->youtube_landing) }}">
                        @error('youtube_landing')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">Link landing page YouTube (untuk fitur tertentu)</small>
                    </div>

                    <!-- WhatsApp -->
                    <div class="col-md-6 mb-4">
                        <label for="whatsapp" class="form-label">
                            <i class="bi bi-whatsapp" style="color: #25d366;"></i> WhatsApp
                        </label>
                        <input type="text" 
                            class="form-control @error('whatsapp') is-invalid @enderror" 
                            id="whatsapp" 
                            name="whatsapp" 
                            placeholder="+62812345678 atau 6281234567890"
                            value="{{ old('whatsapp', $social->whatsapp) }}">
                        @error('whatsapp')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">Format: +62 diikuti nomor atau 0 diikuti nomor tanpa +62</small>
                    </div>

                    <!-- LinkedIn -->
                    <div class="col-md-6 mb-4">
                        <label for="linkedin" class="form-label">
                            <i class="bi bi-linkedin" style="color: #0a66c2;"></i> LinkedIn
                        </label>
                        <input type="url" 
                            class="form-control @error('linkedin') is-invalid @enderror" 
                            id="linkedin" 
                            name="linkedin" 
                            placeholder="https://linkedin.com/company/yourcompany"
                            value="{{ old('linkedin', $social->linkedin) }}">
                        @error('linkedin')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-1">Format: https://linkedin.com/company/companyname</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex gap-2 mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
            </button>
            <a href="{{ route('admin.social-media.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-x-circle me-2"></i>Batal
            </a>
        </div>
    </form>
</div>
@endsection
