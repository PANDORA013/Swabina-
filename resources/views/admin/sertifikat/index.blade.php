@extends($layout)

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><i class="fas fa-award me-2"></i>Manajemen Sertifikat & Penghargaan</h2>
            <p class="text-muted">Kelola sertifikat dan penghargaan perusahaan</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary" id="addSertifikatBtn" data-bs-toggle="modal" data-bs-target="#sertifikatModal">
                <i class="fas fa-plus me-2"></i>Tambah Sertifikat
            </button>
        </div>
    </div>

    @if($sertifikats->count() > 0)
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                @foreach($sertifikats as $sertifikat)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if($sertifikat->image)
                            <img src="{{ asset('storage/' . $sertifikat->image) }}" 
                                 class="card-img-top" 
                                 style="height: 250px; object-fit: cover;" 
                                 alt="Sertifikat" />
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 250px;">
                                <span class="text-muted">No Image</span>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $sertifikat->nama ?? 'N/A' }}</h5>
                            <p class="card-text text-muted small">{{ Str::limit($sertifikat->deskripsi ?? '', 80) }}</p>
                        </div>
                        <div class="card-footer bg-white border-top">
                            <button type="button" class="btn btn-sm btn-warning editBtn me-2" 
                                data-id="{{ $sertifikat->id }}"
                                data-nama="{{ $sertifikat->nama }}"
                                data-deskripsi="{{ $sertifikat->deskripsi }}"
                                data-image="{{ asset('storage/' . $sertifikat->image) }}"
                                data-bs-toggle="modal" 
                                data-bs-target="#sertifikatModal">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $sertifikat->id }}">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info" role="alert">
        <i class="fas fa-info-circle me-2"></i>
        Belum ada sertifikat. Silakan tambahkan sertifikat baru dengan klik tombol "Tambah Sertifikat".
    </div>
    @endif
</div>

<!-- Modal for Add/Edit Sertifikat -->
<div class="modal fade" id="sertifikatModal" tabindex="-1" aria-labelledby="sertifikatModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="sertifikatForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="sertifikatModalLabel">
                        <i class="fas fa-award me-2"></i>Tambah Sertifikat
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    
                    <!-- Nama Sertifikat -->
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold">Nama Sertifikat <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="nama" name="nama" 
                               placeholder="Contoh: ISO 9001:2015" required>
                        <small class="form-text text-muted">Masukkan nama atau jenis sertifikat</small>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi (Opsional)</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" 
                                  placeholder="Masukkan deskripsi sertifikat..."></textarea>
                        <small class="form-text text-muted">Jelaskan tentang sertifikat ini</small>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Gambar Sertifikat <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Max: 20MB</small>
                        <img id="previewImage" src="#" alt="Preview" class="img-fluid mt-3 rounded" style="max-width: 100%; display: none; max-height: 300px;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let isEditing = false;
    let editId = null;

    // Add Sertifikat button
    document.getElementById('addSertifikatBtn').addEventListener('click', function() {
        isEditing = false;
        editId = null;
        document.getElementById('sertifikatForm').reset();
        document.getElementById('sertifikatModalLabel').textContent = 'Tambah Sertifikat';
        document.getElementById('previewImage').style.display = 'none';
        document.getElementById('id').value = '';
    });

    // Edit Sertifikat buttons
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            isEditing = true;
            editId = this.getAttribute('data-id');
            const nama = this.getAttribute('data-nama');
            const deskripsi = this.getAttribute('data-deskripsi');
            const image = this.getAttribute('data-image');

            document.getElementById('sertifikatModalLabel').textContent = 'Edit Sertifikat';
            document.getElementById('id').value = editId;
            document.getElementById('nama').value = nama;
            document.getElementById('deskripsi').value = deskripsi;
            
            if (image && image !== 'null') {
                document.getElementById('previewImage').src = image;
                document.getElementById('previewImage').style.display = 'block';
            } else {
                document.getElementById('previewImage').style.display = 'none';
            }
        });
    });

    // Form submission
    document.getElementById('sertifikatForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!isEditing && !document.getElementById('image').files[0]) {
            Swal.fire('Error!', 'Gambar sertifikat harus diupload', 'error');
            return;
        }
        
        let imageInput = this.querySelector('input[type="file"]');
        if (imageInput && imageInput.files[0]) {
            let fileSize = imageInput.files[0].size / 1024 / 1024;
            if (fileSize > 20) {
                Swal.fire('Error!', 'Ukuran file melebihi 20 MB. Silakan pilih file yang lebih kecil.', 'error');
                return;
            }
        }
        
        let formData = new FormData(this);
        
        let url = isEditing 
            ? `{{ route('admin.sertifikat.update', '') }}/${editId}`
            : '{{ route('admin.sertifikat.store') }}';

        if (isEditing) {
            formData.append('_method', 'PUT');
        }

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Sukses!', data.message, 'success').then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', error.message || 'Terjadi kesalahan saat memproses data', 'error');
        });
    });

    // Delete Sertifikat buttons
    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Hapus Sertifikat?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('admin.sertifikat.destroy', '') }}/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire('Dihapus!', data.message, 'success').then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Gagal menghapus sertifikat');
                        }
                    })
                    .catch(error => {
                        Swal.fire('Error!', error.message || 'Terjadi kesalahan', 'error');
                    });
                }
            });
        });
    });

    // Image preview
    document.getElementById('image').addEventListener('change', function() {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('previewImage').style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>
@endpush

@endsection
