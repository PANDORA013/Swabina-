@extends($layout)

@section('page-title', 'Edit Sertifikat')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.sertifikat.index') }}">Sertifikat</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil-circle me-2"></i>Edit Sertifikat</h5>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i>
                        <strong>Validasi Gagal!</strong>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('admin.sertifikat.update', $sertifikat->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nama Sertifikat -->
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">
                                Nama Sertifikat <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" 
                                   name="nama" 
                                   placeholder="Contoh: ISO 9001:2015" 
                                   value="{{ old('nama', $sertifikat->nama) }}"
                                   required>
                            <small class="form-text text-muted">Masukkan nama atau jenis sertifikat</small>
                            @error('nama')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">Deskripsi (Opsional)</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4" 
                                      placeholder="Masukkan deskripsi sertifikat...">{{ old('deskripsi', $sertifikat->deskripsi) }}</textarea>
                            <small class="form-text text-muted">Jelaskan tentang sertifikat ini</small>
                            @error('deskripsi')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Gambar Saat Ini -->
                        @if($sertifikat->image)
                        <div class="mb-3">
                            <label class="form-label fw-bold">Gambar Saat Ini</label>
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $sertifikat->image) }}" 
                                     alt="{{ $sertifikat->nama }}" 
                                     style="max-height: 200px; max-width: 100%; border-radius: 4px; border: 1px solid #ddd; padding: 5px;" />
                            </div>
                        </div>
                        @endif

                        <!-- Gambar Baru -->
                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">
                                Gambar Sertifikat (Opsional - Kosongkan jika tidak ingin mengubah)
                            </label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/jpeg,image/png,image/jpg,image/webp">
                            <small class="form-text text-muted">Format: JPG, PNG, WebP. Max: 2MB</small>
                            @error('image')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                            <div id="imagePreview" style="margin-top: 15px; display: none;">
                                <p class="small text-muted mb-2">Preview Gambar Baru:</p>
                                <img id="previewImg" src="#" alt="Preview" style="max-height: 250px; max-width: 100%; border-radius: 4px;" />
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.sertifikat.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewImg').src = event.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush

@endsection
