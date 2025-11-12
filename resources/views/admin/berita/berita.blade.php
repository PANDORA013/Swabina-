@extends($layout)

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1">Berita & Artikel</h1>
            <p class="text-muted">Kelola berita dan artikel perusahaan</p>
        </div>
        <button class="btn btn-primary" id="addBeritaBtn" data-bs-toggle="modal" data-bs-target="#beritaModal">
            <i class="fas fa-plus me-2"></i>Tambah Berita
        </button>
    </div>
    
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 100px;">Gambar</th>
                        <th>Judul Berita</th>
                        <th>Deskripsi</th>
                        <th style="width: 200px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
            @foreach($berita as $item)
            <tr>
                <td>
                    <img src="{{ asset('storage/' . $item->image) }}" 
                         class="img-thumbnail" 
                         style="width: 80px; height: 60px; object-fit: cover;" 
                         alt="Berita Image" />
                </td>
                <td>
                    <strong>{{ isset($item->title['id']) ? $item->title['id'] : '' }}</strong>
                </td>
                <td>
                    <span class="text-muted">
                        {{ isset($item->description['id']) ? Str::limit($item->description['id'], 100) : '' }}
                    </span>
                </td>
                <td>
                    <button class="btn btn-sm btn-warning editBtn me-1" 
                        data-id="{{ $item->id }}" 
                        data-title-id="{{ isset($item->title['id']) ? $item->title['id'] : '' }}"
                        data-description-id="{{ isset($item->description['id']) ? $item->description['id'] : '' }}"
                        data-image="{{ asset('storage/' . $item->image) }}" 
                        data-bs-toggle="modal" 
                        data-bs-target="#beritaModal">
                        <i class="fas fa-edit"></i> Edit
                    </button>
                    <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $item->id }}">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="beritaModal" tabindex="-1" aria-labelledby="beritaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="beritaForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="beritaModalLabel">
                        <i class="fas fa-newspaper me-2"></i>Tambah/Edit Berita
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group mb-3">
                        <label for="image" class="form-label fw-bold">Gambar Berita <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Max: 20MB</small>
                        <img id="previewImage" src="#" alt="Preview" class="img-fluid mt-3 rounded" style="max-width: 100%; display: none;">
                    </div>
                    <div class="form-group mb-3">
                        <label for="title" class="form-label fw-bold">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" 
                               placeholder="Masukkan judul berita..." required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="form-label fw-bold">Deskripsi/Isi Berita <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="6" 
                                  placeholder="Masukkan isi berita..." required></textarea>
                        <small class="form-text text-muted">Min. 50 karakter</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    let isEditing = false;
    let editId = null;

    document.getElementById('addBeritaBtn').addEventListener('click', function() {
        isEditing = false;
        editId = null;
        document.getElementById('beritaForm').reset();
        document.getElementById('beritaModalLabel').textContent = 'Add Berita';
        document.getElementById('previewImage').style.display = 'none';
        document.getElementById('id').value = '';
    });

    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            isEditing = true;
            editId = this.getAttribute('data-id');
            var title = this.getAttribute('data-title-id');
            var description = this.getAttribute('data-description-id');
            var image = this.getAttribute('data-image');

            document.getElementById('beritaModalLabel').textContent = 'Edit Berita';
            document.getElementById('id').value = editId;
            document.getElementById('title').value = title;
            document.getElementById('description').value = description;
            document.getElementById('previewImage').src = image;
            document.getElementById('previewImage').style.display = 'block';
        });
    });

    document.getElementById('beritaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let imageInput = this.querySelector('input[type="file"]');
        if (imageInput && imageInput.files[0]) {
            let fileSize = imageInput.files[0].size / 1024 / 1024; // konversi ke MB
            if (fileSize > 20) {
                Swal.fire('Error!', 'Ukuran file melebihi 20 MB. Silakan pilih file yang lebih kecil.', 'error');
                return;
            }
        }
        
        let formData = new FormData(this);
        
        let url = isEditing 
            ? '{{ route("admin.berita.berita.update", ":id") }}'.replace(':id', editId)
            : '{{ route("admin.berita.berita.store") }}';

        let method = isEditing ? 'POST' : 'POST';
        
        if (isEditing) {
            formData.append('_method', 'PUT');
        }

        fetch(url, {
            method: method,
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire('Success!', data.message, 'success').then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'Unknown error occurred');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', error.message || 'An unexpected error occurred. Please try again.', 'error');
        });
    });

    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            var id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ route('admin.berita.berita.destroy', ':id') }}`.replace(':id', id), {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Failed to delete item');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire({
                            title: 'Error!',
                            text: error.message || 'An unexpected error occurred.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                }
            });
        });
    });

    document.getElementById('image').addEventListener('change', function() {
        var reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('previewImage').src = e.target.result;
            document.getElementById('previewImage').style.display = 'block';
        };
        reader.readAsDataURL(this.files[0]);
    });
</script>
@endsection