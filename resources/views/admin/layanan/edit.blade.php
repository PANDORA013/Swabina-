@extends($layout)

@section('page-title', 'Edit Layanan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.layanan.index') }}">Layanan</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $layanan->title }}</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">
                        <i class="bi bi-pencil me-2"></i>Edit Layanan: {{ $layanan->title }}
                    </h5>
                    
                    {{-- Alert Messages --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <strong>Error!</strong>
                            <ul class="mb-0 ms-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Edit Form --}}
                    <form action="{{ route('admin.layanan.update', $layanan->slug) }}" 
                          method="POST" 
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="mb-3">
                            <label for="title" class="form-label fw-semibold">Judul Layanan</label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title', $layanan->title) }}"
                                   placeholder="Contoh: Swa Academy">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Subtitle --}}
                        <div class="mb-3">
                            <label for="subtitle" class="form-label fw-semibold">Subtitle</label>
                            <input type="text" 
                                   class="form-control @error('subtitle') is-invalid @enderror" 
                                   id="subtitle" 
                                   name="subtitle" 
                                   value="{{ old('subtitle', $layanan->subtitle) }}"
                                   placeholder="Deskripsi singkat layanan">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Icon --}}
                        <div class="mb-3">
                            <label for="icon" class="form-label fw-semibold">Bootstrap Icon Class</label>
                            <input type="text" 
                                   class="form-control @error('icon') is-invalid @enderror" 
                                   id="icon" 
                                   name="icon" 
                                   value="{{ old('icon', $layanan->icon) }}"
                                   placeholder="Contoh: bi-book, bi-computer, bi-briefcase">
                            <small class="form-text text-muted">Lihat https://icons.getbootstrap.com/</small>
                            @error('icon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div class="mb-3">
                            <label for="image" class="form-label fw-semibold">Gambar Layanan</label>
                            @if($layanan->image && \Storage::disk('public')->exists($layanan->image))
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $layanan->image) }}" 
                                         alt="{{ $layanan->title }}" 
                                         class="img-thumbnail"
                                         style="max-width: 200px; max-height: 150px; object-fit: cover;">
                                    <p class="text-muted small mt-2">Gambar saat ini</p>
                                </div>
                            @endif
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image"
                                   accept="image/*">
                            <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, PNG, WebP. Max: 2MB</small>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label for="description" class="form-label fw-semibold">Deskripsi Lengkap</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="6"
                                      placeholder="Deskripsi lengkap layanan...">{{ old('description', $layanan->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Features --}}
                        <div class="mb-3">
                            <label for="features" class="form-label fw-semibold">Fitur (JSON atau teks)</label>
                            <textarea class="form-control @error('features') is-invalid @enderror" 
                                      id="features" 
                                      name="features" 
                                      rows="4"
                                      placeholder="Format JSON: [&quot;Fitur 1&quot;, &quot;Fitur 2&quot;]">{{ old('features', $layanan->features) }}</textarea>
                            @error('features')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection