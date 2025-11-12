@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1 class="h3">Edit Item "Mengapa Memilih Kami"</h1>
            <p class="text-muted">Update informasi item</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.why-choose-us.update', $whyChooseUs->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="title" class="form-label">Judul <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $whyChooseUs->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="5" required>{{ old('description', $whyChooseUs->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon Bootstrap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('icon') is-invalid @enderror" 
                                           id="icon" name="icon" value="{{ old('icon', $whyChooseUs->icon) }}" 
                                           placeholder="e.g., bi-brain, bi-heart, bi-lightning" required>
                                    <small class="text-muted">
                                        Lihat: <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>
                                    </small>
                                    @error('icon')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Urutan <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                           id="order" name="order" value="{{ old('order', $whyChooseUs->order) }}" required>
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            @if($whyChooseUs->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/why-choose-us/' . $whyChooseUs->image) }}" 
                                         alt="{{ $whyChooseUs->title }}" style="max-width: 150px; border-radius: 5px;">
                                    <p class="text-muted small mt-1">Gambar saat ini</p>
                                </div>
                            @endif
                            <input type="file" class="form-control @error('image') is-invalid @enderror" 
                                   id="image" name="image" accept="image/*">
                            <small class="text-muted">PNG, JPG, GIF (Max 2MB) - Biarkan kosong untuk tidak mengubah</small>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="active" {{ old('status', $whyChooseUs->status) === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status', $whyChooseUs->status) === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update
                            </button>
                            <a href="{{ route('admin.why-choose-us.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Preview Icon</h5>
                </div>
                <div class="card-body text-center">
                    <i id="iconPreview" class="bi {{ $whyChooseUs->icon }}" style="font-size: 5rem; color: #0d6efd;"></i>
                    <p class="text-muted mt-3" id="iconName">{{ $whyChooseUs->icon }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('icon').addEventListener('input', function(e) {
    let iconClass = e.target.value || 'bi-star';
    let preview = document.getElementById('iconPreview');
    let name = document.getElementById('iconName');
    
    preview.className = 'bi ' + iconClass;
    name.textContent = iconClass;
});
</script>
@endsection
