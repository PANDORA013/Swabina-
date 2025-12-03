@extends($layout)

@section('page-title', 'Tambah Item - Mengapa Memilih Kami')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.why-choose-us.index') }}">Mengapa Memilih Kami</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Tambah Item Baru</h5>
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

                    <form action="{{ route('admin.why-choose-us.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Judul -->
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">
                                Judul <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('title') is-invalid @enderror" 
                                   id="title" 
                                   name="title" 
                                   placeholder="Contoh: Pengalaman Terpercaya" 
                                   value="{{ old('title') }}"
                                   required>
                            @error('title')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-3">
                            <label for="description" class="form-label fw-bold">
                                Deskripsi <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="5" 
                                      placeholder="Masukkan deskripsi item..."
                                      required>{{ old('description') }}</textarea>
                            @error('description')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div class="mb-3">
                            <label for="icon" class="form-label fw-bold">
                                Icon <span class="text-danger">*</span>
                            </label>
                            <input type="file" 
                                   class="form-control @error('icon') is-invalid @enderror" 
                                   id="icon" 
                                   name="icon" 
                                   accept="image/jpeg,image/png,image/jpg,image/webp"
                                   required>
                            <small class="form-text text-muted">Format: PNG, JPG, WebP. Max: 2MB</small>
                            @error('icon')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                            <div id="iconPreview" style="margin-top: 15px; display: none;">
                                <p class="small text-muted mb-2">Preview Icon:</p>
                                <img id="previewImg" src="#" alt="Preview" style="max-height: 150px; max-width: 150px; object-fit: contain;" />
                            </div>
                        </div>

                        <!-- Order -->
                        <div class="mb-3">
                            <label for="order" class="form-label fw-bold">Urutan Tampil</label>
                            <input type="number" 
                                   class="form-control @error('order') is-invalid @enderror" 
                                   id="order" 
                                   name="order" 
                                   value="{{ old('order', 0) }}"
                                   min="0">
                            <small class="form-text text-muted">Nilai lebih kecil tampil lebih awal (opsional)</small>
                            @error('order')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label fw-bold">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status">
                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Aktif</option>
                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan Item
                            </button>
                            <a href="{{ route('admin.why-choose-us.index') }}" class="btn btn-secondary">
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
    document.getElementById('icon').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                document.getElementById('previewImg').src = event.target.result;
                document.getElementById('iconPreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush

@endsection
