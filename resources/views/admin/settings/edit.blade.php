@extends($layout)

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="mb-0">⚙️ Pengaturan Website</h2>
            <small class="text-muted">Kelola semua pengaturan website dari satu tempat</small>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>✅ Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>❌ Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" class="needs-validation">
        @csrf

        <!-- ========== INFORMASI KONTAK ========== -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">📞 Informasi Kontak</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact_telepon" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control @error('contact_telepon') is-invalid @enderror" 
                               id="contact_telepon" name="contact_telepon" 
                               value="{{ $companyContact->telepon ?? '' }}"
                               placeholder="+62-31-123456">
                        @error('contact_telepon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="contact_email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                               id="contact_email" name="contact_email" 
                               value="{{ $companyContact->email ?? '' }}"
                               placeholder="info@perusahaan.com">
                        @error('contact_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="contact_alamat" class="form-label">Alamat</label>
                    <textarea class="form-control @error('contact_alamat') is-invalid @enderror" 
                              id="contact_alamat" name="contact_alamat" rows="3"
                              placeholder="Jl. Merdeka No. 1, Gresik, Jawa Timur">{{ $companyContact->alamat ?? '' }}</textarea>
                    @error('contact_alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="contact_jam_operasional" class="form-label">Jam Operasional</label>
                    <input type="text" class="form-control @error('contact_jam_operasional') is-invalid @enderror" 
                           id="contact_jam_operasional" name="contact_jam_operasional" 
                           value="{{ $companyContact->jam_operasional ?? '' }}"
                           placeholder="Senin - Jumat: 08:00 - 17:00 WIB">
                    @error('contact_jam_operasional')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- ========== LINK SOSIAL MEDIA ========== -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">📱 Link Sosial Media</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="social_facebook" class="form-label">Facebook</label>
                        <input type="url" class="form-control @error('social_facebook') is-invalid @enderror" 
                               id="social_facebook" name="social_facebook" 
                               value="{{ $socialLinks->facebook ?? '' }}"
                               placeholder="https://facebook.com/...">
                        @error('social_facebook')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="social_instagram" class="form-label">Instagram</label>
                        <input type="url" class="form-control @error('social_instagram') is-invalid @enderror" 
                               id="social_instagram" name="social_instagram" 
                               value="{{ $socialLinks->instagram ?? '' }}"
                               placeholder="https://instagram.com/...">
                        @error('social_instagram')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="social_linkedin" class="form-label">LinkedIn</label>
                        <input type="url" class="form-control @error('social_linkedin') is-invalid @enderror" 
                               id="social_linkedin" name="social_linkedin" 
                               value="{{ $socialLinks->linkedin ?? '' }}"
                               placeholder="https://linkedin.com/company/...">
                        @error('social_linkedin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="social_youtube" class="form-label">YouTube</label>
                        <input type="url" class="form-control @error('social_youtube') is-invalid @enderror" 
                               id="social_youtube" name="social_youtube" 
                               value="{{ $socialLinks->youtube ?? '' }}"
                               placeholder="https://youtube.com/@...">
                        @error('social_youtube')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="social_whatsapp" class="form-label">WhatsApp</label>
                        <input type="url" class="form-control @error('social_whatsapp') is-invalid @enderror" 
                               id="social_whatsapp" name="social_whatsapp" 
                               value="{{ $socialLinks->whatsapp ?? '' }}"
                               placeholder="https://wa.me/...">
                        @error('social_whatsapp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== PROFIL PERUSAHAAN ========== -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">🏢 Profil Perusahaan</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="profile_visi" class="form-label">Visi</label>
                    <textarea class="form-control @error('profile_visi') is-invalid @enderror" 
                              id="profile_visi" name="profile_visi" rows="3"
                              placeholder="Masukkan visi perusahaan...">{{ $companyProfile->visi ?? '' }}</textarea>
                    @error('profile_visi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="profile_misi" class="form-label">Misi <small class="text-muted">(Pisahkan per baris)</small></label>
                    <textarea class="form-control @error('profile_misi') is-invalid @enderror" 
                              id="profile_misi" name="profile_misi" rows="5"
                              placeholder="Misi 1&#10;Misi 2&#10;Misi 3">{{ $companyProfile->misi ? implode("\n", $companyProfile->misi) : '' }}</textarea>
                    <small class="form-text text-muted">Setiap baris akan menjadi satu misi</small>
                    @error('profile_misi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="profile_budaya" class="form-label">Budaya Perusahaan</label>
                    <input type="text" class="form-control @error('profile_budaya') is-invalid @enderror" 
                           id="profile_budaya" name="profile_budaya" 
                           value="{{ $companyProfile->budaya ?? '' }}"
                           placeholder="Integritas, Profesionalisme, Inovasi">
                    @error('profile_budaya')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- ========== TOMBOL SUBMIT ========== -->
        <div class="row mb-4">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </form>
</div>

<style>
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        border-radius: 0.5rem;
    }

    .card-header {
        border-radius: 0.5rem 0.5rem 0 0;
        padding: 1.25rem;
    }

    .form-label {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #333;
    }

    .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    }

    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
</style>
@endsection
