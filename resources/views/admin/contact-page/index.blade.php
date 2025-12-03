@extends($layout)

@section('title', 'Kelola Halaman Kontak')

@section('page-title', 'Kelola Halaman Kontak')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Halaman Kontak</li>
@endsection

@section('content')
<div class="container-fluid px-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted">Edit konten yang tampil di halaman kontak public</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-gear"></i> Pengaturan Halaman Kontak</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.contact-page.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Page Title -->
                        <div class="mb-4">
                            <label for="page_title" class="form-label fw-bold">Judul Halaman <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('page_title') is-invalid @enderror" 
                                   id="page_title" 
                                   name="page_title" 
                                   value="{{ old('page_title', $contactPage->page_title) }}" 
                                   required>
                            @error('page_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Judul utama yang ditampilkan di halaman kontak</small>
                        </div>

                        <!-- Page Subtitle -->
                        <div class="mb-4">
                            <label for="page_subtitle" class="form-label fw-bold">Sub Judul</label>
                            <input type="text" 
                                   class="form-control @error('page_subtitle') is-invalid @enderror" 
                                   id="page_subtitle" 
                                   name="page_subtitle" 
                                   value="{{ old('page_subtitle', $contactPage->page_subtitle) }}">
                            @error('page_subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Sub judul atau tagline halaman kontak</small>
                        </div>

                        <!-- Page Description -->
                        <div class="mb-4">
                            <label for="page_description" class="form-label fw-bold">Deskripsi Halaman</label>
                            <textarea class="form-control @error('page_description') is-invalid @enderror" 
                                      id="page_description" 
                                      name="page_description" 
                                      rows="4">{{ old('page_description', $contactPage->page_description) }}</textarea>
                            @error('page_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Deskripsi singkat tentang halaman kontak</small>
                        </div>

                        <!-- Additional Info -->
                        <div class="mb-4">
                            <label for="additional_info" class="form-label fw-bold">Informasi Tambahan</label>
                            <textarea class="form-control @error('additional_info') is-invalid @enderror" 
                                      id="additional_info" 
                                      name="additional_info" 
                                      rows="6">{{ old('additional_info', $contactPage->additional_info) }}</textarea>
                            @error('additional_info')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Informasi tambahan seperti jam operasional, catatan khusus, dll</small>
                        </div>

                        <!-- Map Embed URL -->
                        <div class="mb-4">
                            <label for="map_embed_url" class="form-label fw-bold">URL Google Maps Embed</label>
                            <input type="url" 
                                   class="form-control @error('map_embed_url') is-invalid @enderror" 
                                   id="map_embed_url" 
                                   name="map_embed_url" 
                                   value="{{ old('map_embed_url', $contactPage->map_embed_url) }}" 
                                   placeholder="https://www.google.com/maps/embed?pb=...">
                            @error('map_embed_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">URL iframe embed dari Google Maps</small>
                        </div>

                        <!-- Display Options -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Opsi Tampilan</label>
                            
                            <div class="form-check form-switch mb-2">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="show_map" 
                                       name="show_map" 
                                       value="1"
                                       {{ old('show_map', $contactPage->show_map) ? 'checked' : '' }}>
                                <label class="form-check-label" for="show_map">
                                    Tampilkan Peta Google Maps
                                </label>
                            </div>

                            <div class="form-check form-switch">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="show_contact_form" 
                                       name="show_contact_form" 
                                       value="1"
                                       {{ old('show_contact_form', $contactPage->show_contact_form) ? 'checked' : '' }}>
                                <label class="form-check-label" for="show_contact_form">
                                    Tampilkan Form Kontak
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Simpan Perubahan
                            </button>
                            <a href="{{ route('kontakkami') }}" class="btn btn-outline-secondary" target="_blank">
                                <i class="bi bi-eye"></i> Lihat Halaman
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-info">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="bi bi-info-circle"></i> Informasi</h6>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Data Kontak Perusahaan</strong></p>
                    <p class="text-muted small mb-0">
                        Alamat, telepon, email, dan jam operasional perusahaan dikelola di menu 
                        <a href="{{ route('admin.company-info.index') }}" class="text-decoration-none">Company Info</a>.
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow-sm border-warning">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0"><i class="bi bi-lightbulb"></i> Tips</h6>
                </div>
                <div class="card-body">
                    <p class="mb-2"><strong>Google Maps Embed URL</strong></p>
                    <p class="text-muted small mb-0">
                        Buka Google Maps → Pilih lokasi → Share → Embed a map → Copy URL dari iframe src
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
