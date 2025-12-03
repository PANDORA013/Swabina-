@extends($layout)

@section('page-title', 'Edit ' . $layanan->title)

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.layanan.index') }}">Halaman Layanan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit {{ $layanan->title }}</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <form action="{{ route('admin.layanan.update', $layanan->slug) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Informasi Utama</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Judul Layanan <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $layanan->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('subtitle') is-invalid @enderror" 
                                   id="subtitle" name="subtitle" value="{{ old('subtitle', $layanan->subtitle) }}" required>
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="6" required>{{ old('description', $layanan->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="features" class="form-label">Fitur/Keunggulan (Optional)</label>
                            <textarea class="form-control" id="features" name="features" rows="4" 
                                      placeholder="Masukkan fitur/keunggulan, pisahkan dengan baris baru">{{ old('features', $layanan->features) }}</textarea>
                            <small class="text-muted">Masukkan setiap fitur dalam baris terpisah</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">Pengaturan</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon Bootstrap</label>
                            <input type="text" class="form-control" id="icon" name="icon" 
                                   value="{{ old('icon', $layanan->icon) }}" 
                                   placeholder="bi-briefcase">
                            <small class="text-muted">
                                Gunakan class Bootstrap Icons, contoh: bi-briefcase, bi-building
                                <a href="https://icons.getbootstrap.com/" target="_blank">Lihat icons</a>
                            </small>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            @if($layanan->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $layanan->image) }}" 
                                         class="img-fluid rounded" 
                                         alt="{{ $layanan->title }}">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Format: JPG, PNG, WEBP. Max: 2MB</small>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" 
                                       value="1" {{ old('is_active', $layanan->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Aktifkan Layanan
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="fas fa-save me-2"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary w-100">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
