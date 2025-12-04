@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Tambah Berita Baru</h5>
            
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Judul Berita <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Utama <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                    <small class="text-muted">Format: jpg, jpeg, png, webp. Max: 2MB.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    
                    <!-- Preview Image -->
                    <div class="mt-2" style="display: none;" id="imagePreviewContainer">
                        <img id="imagePreview" src="#" alt="Preview" style="max-width: 200px; height: auto;" class="rounded border shadow-sm">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Konten Berita <span class="text-danger">*</span></label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan Berita</button>
                    <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Script sederhana untuk preview gambar
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('imagePreview');
                const container = document.getElementById('imagePreviewContainer');
                preview.src = e.target.result;
                container.style.display = 'block';
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection
