<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><i class="fas fa-newspaper me-2"></i>Manajemen Berita</h2>
            <p class="text-muted">Kelola berita dan artikel perusahaan Anda</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary" id="addBeritaBtn" data-bs-toggle="modal" data-bs-target="#beritaModal">
                <i class="fas fa-plus me-2"></i>Tambah Berita
            </button>
        </div>
    </div>

    <?php if($berita->count() > 0): ?>
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
                        <?php $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <?php if($item->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->image)); ?>" 
                                         class="img-thumbnail" 
                                         style="width: 70px; height: 50px; object-fit: cover;" 
                                         alt="Berita" />
                                <?php else: ?>
                                    <span class="badge bg-secondary">No Image</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <strong><?php echo e(isset($item->title['id']) ? $item->title['id'] : 'N/A'); ?></strong>
                            </td>
                            <td>
                                <span class="text-muted">
                                    <?php echo e(isset($item->description['id']) ? Str::limit($item->description['id'], 80) : 'N/A'); ?>

                                </span>
                            </td>
                            <td>
                                <small class="text-muted"><?php echo e($item->created_at->format('d M Y')); ?></small>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning editBtn me-1" 
                                    data-id="<?php echo e($item->id); ?>" 
                                    data-title-id="<?php echo e(isset($item->title['id']) ? $item->title['id'] : ''); ?>"
                                    data-title-en="<?php echo e(isset($item->title['en']) ? $item->title['en'] : ''); ?>"
                                    data-description-id="<?php echo e(isset($item->description['id']) ? $item->description['id'] : ''); ?>"
                                    data-description-en="<?php echo e(isset($item->description['en']) ? $item->description['en'] : ''); ?>"
                                    data-image="<?php echo e(asset('storage/' . $item->image)); ?>" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#beritaModal">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-sm btn-danger deleteBtn" data-id="<?php echo e($item->id); ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="alert alert-info" role="alert">
        <i class="fas fa-info-circle me-2"></i>
        Belum ada berita. Silakan tambahkan berita baru dengan klik tombol "Tambah Berita".
    </div>
    <?php endif; ?>
</div>

<!-- Modal for Add/Edit Berita -->
<div class="modal fade" id="beritaModal" tabindex="-1" aria-labelledby="beritaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="beritaForm" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="beritaModalLabel">
                        <i class="fas fa-newspaper me-2"></i>Tambah Berita
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    
                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Gambar Berita <span class="text-danger">*</span></label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Max: 20MB</small>
                        <img id="previewImage" src="#" alt="Preview" class="img-fluid mt-3 rounded" style="max-width: 100%; display: none; max-height: 300px;">
                    </div>

                    <!-- Indonesian Content -->
                    <div class="card mb-3">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-globe me-2"></i>Konten Indonesia</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title_id" class="form-label fw-bold">Judul (Indonesia) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title_id" name="title_id" 
                                       placeholder="Masukkan judul berita..." required>
                            </div>
                            <div class="mb-3">
                                <label for="description_id" class="form-label fw-bold">Deskripsi (Indonesia) <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="description_id" name="description_id" rows="5" 
                                          placeholder="Masukkan isi berita..." required></textarea>
                                <small class="form-text text-muted">Min. 50 karakter</small>
                            </div>
                        </div>
                    </div>

                    <!-- English Content -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h6 class="mb-0"><i class="fas fa-globe me-2"></i>Konten English (Opsional)</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="title_en" class="form-label fw-bold">Judul (English)</label>
                                <input type="text" class="form-control" id="title_en" name="title_en" 
                                       placeholder="Enter news title in English...">
                            </div>
                            <div class="mb-3">
                                <label for="description_en" class="form-label fw-bold">Deskripsi (English)</label>
                                <textarea class="form-control" id="description_en" name="description_en" rows="5" 
                                          placeholder="Enter news content in English..."></textarea>
                            </div>
                        </div>
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

<?php $__env->startPush('scripts'); ?>
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
    });

    // Edit Berita buttons
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            isEditing = true;
            editId = this.getAttribute('data-id');
            const titleId = this.getAttribute('data-title-id');
            const titleEn = this.getAttribute('data-title-en');
            const descId = this.getAttribute('data-description-id');
            const descEn = this.getAttribute('data-description-en');
            const image = this.getAttribute('data-image');

            document.getElementById('beritaModalLabel').textContent = 'Edit Berita';
            document.getElementById('id').value = editId;
            document.getElementById('title_id').value = titleId;
            document.getElementById('title_en').value = titleEn;
            document.getElementById('description_id').value = descId;
            document.getElementById('description_en').value = descEn;
            document.getElementById('previewImage').src = image;
            document.getElementById('previewImage').style.display = 'block';
        });
    });

    // Form submission
    document.getElementById('beritaForm').addEventListener('submit', function(e) {
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
            ? `<?php echo e(route('admin.berita.update', '')); ?>/${editId}`
            : '<?php echo e(route('admin.berita.store')); ?>';

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
                    fetch(`<?php echo e(route('admin.berita.destroy', '')); ?>/${id}`, {
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
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/admin/berita/index.blade.php ENDPATH**/ ?>