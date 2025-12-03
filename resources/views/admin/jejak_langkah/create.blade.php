@extends($layout)

@section('page-title', 'Tambah Jejak Langkah')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.jejak.index') }}">Jejak Langkah</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Tambah Jejak Langkah Baru</h5>
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

                    <form action="{{ route('admin.jejak.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Tahun -->
                        <div class="mb-3">
                            <label for="tahun" class="form-label fw-bold">
                                Tahun <span class="text-danger">*</span>
                            </label>
                            <input type="number" 
                                   class="form-control @error('tahun') is-invalid @enderror" 
                                   id="tahun" 
                                   name="tahun" 
                                   placeholder="Contoh: 2020" 
                                   min="1900" 
                                   max="2100" 
                                   value="{{ old('tahun') }}"
                                   required>
                            <small class="form-text text-muted">Masukkan tahun milestone</small>
                            @error('tahun')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-bold">
                                Deskripsi <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="5" 
                                      placeholder="Masukkan deskripsi milestone...">{{ old('deskripsi') }}</textarea>
                            <small class="form-text text-muted">Jelaskan pencapaian atau milestone pada tahun tersebut</small>
                            @error('deskripsi')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Gambar -->
                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">
                                Gambar <span class="text-danger">*</span>
                            </label>
                            <input type="file" 
                                   class="form-control @error('image') is-invalid @enderror" 
                                   id="image" 
                                   name="image" 
                                   accept="image/jpeg,image/png,image/jpg,image/webp"
                                   required>
                            <small class="form-text text-muted">Format: JPG, PNG, WebP. Max: 2MB</small>
                            @error('image')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                            <div id="imagePreview" style="margin-top: 15px; display: none;">
                                <img id="previewImg" src="#" alt="Preview" style="max-height: 250px; max-width: 100%; border-radius: 4px;" />
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan Jejak Langkah
                            </button>
                            <a href="{{ route('admin.jejak.index') }}" class="btn btn-secondary">
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
