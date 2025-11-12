@extends($layout)

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><i class="fas fa-timeline me-2"></i>Manajemen Jejak Langkah</h2>
            <p class="text-muted">Kelola timeline dan milestone perusahaan</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary" id="addJejakBtn" data-bs-toggle="modal" data-bs-target="#jejakModal">
                <i class="fas fa-plus me-2"></i>Tambah Jejak Langkah
            </button>
        </div>
    </div>

    @if($jejakLangkahs->count() > 0)
    <div class="card shadow-sm">
        <div class="card-body">
            <!-- Timeline View -->
            <div class="timeline">
                @foreach($jejakLangkahs->sortByDesc('tahun') as $jejak)
                <div class="timeline-item" data-id="{{ $jejak->id }}">
                    <div class="timeline-marker">
                        <span class="timeline-year">{{ $jejak->tahun ?? 'N/A' }}</span>
                    </div>
                    <div class="timeline-content">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                @if($jejak->image)
                                    <img src="{{ asset('storage/' . $jejak->image) }}" 
                                         class="img-thumbnail mb-2" 
                                         style="width: 150px; height: 100px; object-fit: cover;" 
                                         alt="Jejak Langkah" />
                                @endif
                                <p class="mb-0">{{ $jejak->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                            </div>
                            <div class="btn-group ms-3" role="group">
                                <button type="button" class="btn btn-sm btn-warning editBtn" 
                                    data-id="{{ $jejak->id }}"
                                    data-tahun="{{ $jejak->tahun }}"
                                    data-deskripsi="{{ $jejak->deskripsi }}"
                                    data-image="{{ asset('storage/' . $jejak->image) }}"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#jejakModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $jejak->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
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
        Belum ada jejak langkah. Silakan tambahkan jejak langkah baru dengan klik tombol "Tambah Jejak Langkah".
    </div>
    @endif
</div>

<!-- Modal for Add/Edit Jejak Langkah -->
<div class="modal fade" id="jejakModal" tabindex="-1" aria-labelledby="jejakModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="jejakForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="jejakModalLabel">
                        <i class="fas fa-timeline me-2"></i>Tambah Jejak Langkah
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    
                    <!-- Tahun -->
                    <div class="mb-3">
                        <label for="tahun" class="form-label fw-bold">Tahun <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="tahun" name="tahun" 
                               placeholder="Contoh: 2020" min="1900" max="2100" required>
                        <small class="form-text text-muted">Masukkan tahun milestone</small>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" 
                                  placeholder="Masukkan deskripsi milestone..." required></textarea>
                        <small class="form-text text-muted">Jelaskan pencapaian atau milestone pada tahun tersebut</small>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Gambar (Opsional)</label>
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

<style>
    .timeline {
        position: relative;
        padding: 20px 0;
    }

    .timeline-item {
        display: flex;
        margin-bottom: 30px;
        position: relative;
    }

    .timeline-marker {
        position: relative;
        width: 120px;
        text-align: center;
        flex-shrink: 0;
    }

    .timeline-year {
        display: inline-block;
        background: linear-gradient(135deg, #0454a3 0%, #00a8e8 100%);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .timeline-content {
        flex-grow: 1;
        padding-left: 20px;
        border-left: 3px solid #e0e0e0;
        padding-bottom: 20px;
    }

    .timeline-content:last-child {
        border-left-color: transparent;
    }

    .timeline-item:hover .timeline-content {
        border-left-color: #0454a3;
    }

    .timeline-item img {
        border: 2px solid #e0e0e0;
    }

    .timeline-item:hover img {
        border-color: #0454a3;
    }
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let isEditing = false;
    let editId = null;

    // Add Jejak button
    document.getElementById('addJejakBtn').addEventListener('click', function() {
        isEditing = false;
        editId = null;
        document.getElementById('jejakForm').reset();
        document.getElementById('jejakModalLabel').textContent = 'Tambah Jejak Langkah';
        document.getElementById('previewImage').style.display = 'none';
        document.getElementById('id').value = '';
    });

    // Edit Jejak buttons
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            isEditing = true;
            editId = this.getAttribute('data-id');
            const tahun = this.getAttribute('data-tahun');
            const deskripsi = this.getAttribute('data-deskripsi');
            const image = this.getAttribute('data-image');

            document.getElementById('jejakModalLabel').textContent = 'Edit Jejak Langkah';
            document.getElementById('id').value = editId;
            document.getElementById('tahun').value = tahun;
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
    document.getElementById('jejakForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
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
            ? `{{ route('admin.jejak.update', '') }}/${editId}`
            : '{{ route('admin.jejak.store') }}';

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

    // Delete Jejak buttons
    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Hapus Jejak Langkah?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('admin.jejak.destroy', '') }}/${id}`, {
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
                            throw new Error(data.message || 'Gagal menghapus jejak langkah');
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
