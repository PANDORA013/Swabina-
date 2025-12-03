@extends($layout)

@section('page-title', 'Manajemen Berita')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Berita</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <p class="text-muted">Kelola berita dan artikel perusahaan Anda</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary" id="addBeritaBtn" data-bs-toggle="modal" data-bs-target="#beritaModal" aria-label="Tambah berita baru">
                <i class="fas fa-plus me-2" aria-hidden="true"></i>Tambah Berita
            </button>
        </div>
    </div>

    @if($beritas->count() > 0)
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="80px">Gambar</th>
                            <th width="30%">Judul</th>
                            <th width="40%">Deskripsi</th>
                            <th width="15%">Tanggal</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($beritas as $berita)
                        <tr>
                            <td>
                                @if($berita->image)
                                    <img src="{{ asset('storage/' . $berita->image) }}" 
                                         class="img-thumbnail" 
                                         style="width: 70px; height: 50px; object-fit: cover;" 
                                         alt="Gambar untuk berita: {{ $berita->title }}" />
                                @else
                                    <span class="badge bg-secondary">No Image</span>
                                @endif
                            </td>
                            <td>
                                <strong>{{ $berita->title ?? 'N/A' }}</strong>
                            </td>
                            <td>
                                <span class="text-muted">
                                    {{ Str::limit($berita->description ?? '', 80) }}
                                </span>
                            </td>
                            <td>
                                <small class="text-muted">{{ $berita->created_at->format('d M Y') }}</small>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning editBtn me-1" 
                                    data-id="{{ $berita->id }}" 
                                    data-title="{{ $berita->title }}"
                                    data-description="{{ $berita->description }}"
                                    data-image="{{ asset('storage/' . $berita->image) }}" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#beritaModal"
                                    aria-label="Edit berita: {{ $berita->title }}">
                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-id="{{ $berita->id }}" aria-label="Hapus berita: {{ $berita->title }}">
                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="alert alert-info" role="alert">
        <i class="fas fa-info-circle me-2"></i>
        Belum ada berita. Silakan tambahkan berita baru dengan klik tombol "Tambah Berita".
    </div>
    @endif
</div>

<!-- Modal for Add/Edit Berita -->
<div class="modal fade" id="beritaModal" tabindex="-1" aria-labelledby="beritaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="beritaForm" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="beritaModalLabel">
                        <i class="fas fa-newspaper me-2" aria-hidden="true"></i>Tambah Berita
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    
                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Gambar Berita <span class="text-danger" aria-label="required">*</span></label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Max: 20MB</small>
                        <img id="previewImage" src="#" alt="" class="img-fluid mt-3 rounded" style="max-width: 100%; display: none; max-height: 300px;">
                    </div>

                    <!-- Title -->
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Judul <span class="text-danger" aria-label="required">*</span></label>
                        <input type="text" class="form-control" id="title" name="title" 
                               placeholder="Masukkan judul berita..." maxlength="255">
                        <small class="form-text text-muted">Maksimal 255 karakter</small>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label fw-bold">Deskripsi <span class="text-danger" aria-label="required">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="5" 
                                  placeholder="Masukkan isi berita..." minlength="10"></textarea>
                        <small class="form-text text-muted">Minimal 10 karakter</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Batal">
                        <i class="fas fa-times me-2" aria-hidden="true"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary" aria-label="Simpan berita">
                        <i class="fas fa-save me-2" aria-hidden="true"></i>Simpan Berita
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

    // Add Berita button
    document.getElementById('addBeritaBtn').addEventListener('click', function() {
        isEditing = false;
        editId = null;
        document.getElementById('beritaForm').reset();
        document.getElementById('beritaModalLabel').textContent = 'Tambah Berita';
        document.getElementById('previewImage').style.display = 'none';
        document.getElementById('id').value = '';
        // Make image required for new berita
        document.getElementById('image').required = true;
    });

    // Edit Berita buttons
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            isEditing = true;
            editId = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const image = this.getAttribute('data-image');

            document.getElementById('beritaModalLabel').textContent = 'Edit Berita';
            document.getElementById('id').value = editId;
            document.getElementById('title').value = title;
            document.getElementById('description').value = description;
            document.getElementById('previewImage').src = image;
            document.getElementById('previewImage').style.display = 'block';
            // Make image optional for editing
            document.getElementById('image').required = false;
        });
    });

    // Form submission
    document.getElementById('beritaForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        console.clear();
        console.log('%c🚀 BERITA FORM SUBMISSION STARTED', 'font-size: 14px; color: blue; font-weight: bold');
        console.log('Time:', new Date().toLocaleTimeString());
        console.log('Is editing:', isEditing);
        console.log('Edit ID:', editId);
        
        // Validate required fields
        let title = document.getElementById('title').value.trim();
        let description = document.getElementById('description').value.trim();
        let imageInput = this.querySelector('input[type="file"]');
        
        console.log('Image selected:', imageInput.files.length > 0);
        console.log('Title:', title);
        console.log('Description length:', description.length);
        
        if (!title) {
            Swal.fire('Error!', 'Judul berita harus diisi', 'error');
            return;
        }
        
        if (description.length < 10) {
            Swal.fire('Error!', 'Deskripsi minimal 10 karakter', 'error');
            return;
        }
        
        // For new berita, image is required
        if (!isEditing && (!imageInput || !imageInput.files[0])) {
            Swal.fire('Error!', 'Gambar berita harus dipilih', 'error');
            return;
        }
        
        // Check file size if image is selected
        if (imageInput && imageInput.files[0]) {
            let fileSize = imageInput.files[0].size / 1024 / 1024;
            if (fileSize > 20) {
                Swal.fire('Error!', 'Ukuran file melebihi 20 MB. Silakan pilih file yang lebih kecil.', 'error');
                return;
            }
        }
        
        let formData = new FormData(this);
        console.log('FormData contents:');
        for (let [key, value] of formData.entries()) {
            if (key === 'image' && value instanceof File) {
                console.log(`  ${key}: File (${value.name}, ${(value.size/1024).toFixed(2)}KB)`);
            } else {
                console.log(`  ${key}:`, value);
            }
        }
        
        let url = isEditing 
            ? '{{ route("admin.berita.update", ":id") }}'.replace(':id', editId)
            : '{{ route("admin.berita.store") }}';

        console.log('Request URL:', url);
        console.log('Request method:', isEditing ? 'PUT' : 'POST');
        console.log('Store route name resolved to:', '{{ route("admin.berita.store") }}');
        console.log('Window location origin:', window.location.origin);
        console.log('Full request URL:', window.location.origin + (url.startsWith('/') ? '' : '/') + url);

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
        .then(response => {
            console.log('✅ FETCH RESPONSE RECEIVED');
            console.log('Response status:', response.status);
            console.log('Response ok:', response.ok);
            console.log('Response type:', response.type);
            console.log('Response URL:', response.url);
            console.log('Response headers:', {
                'content-type': response.headers.get('content-type'),
                'content-length': response.headers.get('content-length')
            });
            
            // Clone response to read body multiple times
            return response.text().then(text => {
                console.log('Raw response text:', text);
                console.log('Text length:', text.length);
                try {
                    const json = JSON.parse(text);
                    console.log('✅ Parsed as JSON:', json);
                    return json;
                } catch(e) {
                    console.error('❌ Failed to parse JSON:', e.message);
                    console.error('Text was:', text.substring(0, 500));
                    throw new Error('Invalid JSON response: ' + text.substring(0, 200));
                }
            });
        })
        .then(data => {
            console.log('✅ SUCCESS THEN - Received data:', data);
            if (data && data.success) {
                console.log('✅ DATA.SUCCESS IS TRUE - Showing success alert');
                Swal.fire('Sukses!', data.message, 'success').then(() => {
                    console.log('✅ RELOADING PAGE');
                    window.location.reload();
                });
            } else {
                console.warn('⚠️ DATA.SUCCESS IS FALSE OR MISSING');
                let errorMsg = data?.message || 'Terjadi kesalahan';
                if (data?.errors) {
                    errorMsg = Object.values(data.errors).flat().join(', ');
                }
                throw new Error(errorMsg);
            }
        })
        .catch(error => {
            console.error('❌ FETCH ERROR CAUGHT:', error);
            console.error('Error message:', error.message);
            console.error('Error stack:', error.stack);
            Swal.fire('Error!', error.message || 'Terjadi kesalahan saat memproses data', 'error');
        });
    });

    // Delete Berita buttons
    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            Swal.fire({
                title: 'Hapus Berita?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`{{ url('admin/berita/delete') }}/${id}`, {
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
                            throw new Error(data.message || 'Gagal menghapus berita');
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
