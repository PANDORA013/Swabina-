<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><i class="fas fa-building-columns me-2"></i>Sekilas Perusahaan</h2>
            <p class="text-muted">Kelola informasi sekilas tentang perusahaan</p>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-primary" id="editSekilasBtn" data-bs-toggle="modal" data-bs-target="#sekilasModal">
                <i class="fas fa-edit me-2"></i>Edit Sekilas
            </button>
        </div>
    </div>

    <?php if($sekilas): ?>
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="row">
                <?php if($sekilas->image): ?>
                <div class="col-md-4">
                    <img src="<?php echo e(asset('storage/' . $sekilas->image)); ?>" 
                         class="img-fluid rounded" 
                         alt="Sekilas Perusahaan" />
                </div>
                <?php endif; ?>
                <div class="col-md-8">
                    <h4><?php echo e($sekilas->judul ?? 'Sekilas Perusahaan'); ?></h4>
                    <p class="text-muted"><?php echo e($sekilas->deskripsi ?? 'Belum ada deskripsi'); ?></p>
                    
                    <?php if($sekilas->tahun_berdiri): ?>
                    <div class="mt-3">
                        <strong>Tahun Berdiri:</strong> <?php echo e($sekilas->tahun_berdiri); ?>

                    </div>
                    <?php endif; ?>
                    
                    <?php if($sekilas->jumlah_karyawan): ?>
                    <div class="mt-2">
                        <strong>Jumlah Karyawan:</strong> <?php echo e($sekilas->jumlah_karyawan); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="alert alert-info" role="alert">
        <i class="fas fa-info-circle me-2"></i>
        Belum ada data sekilas perusahaan. Silakan tambahkan dengan klik tombol "Edit Sekilas".
    </div>
    <?php endif; ?>
</div>

<!-- Modal for Edit Sekilas Perusahaan -->
<div class="modal fade" id="sekilasModal" tabindex="-1" aria-labelledby="sekilasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="sekilasForm" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="sekilasModalLabel">
                        <i class="fas fa-building-columns me-2"></i>Edit Sekilas Perusahaan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id" value="<?php echo e($sekilas->id ?? ''); ?>">
                    
                    <!-- Judul -->
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-bold">Judul <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="judul" name="judul" 
                               placeholder="Contoh: Sekilas Perusahaan" value="<?php echo e($sekilas->judul ?? ''); ?>" required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-bold">Deskripsi <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" 
                                  placeholder="Masukkan deskripsi sekilas perusahaan..." required><?php echo e($sekilas->deskripsi ?? ''); ?></textarea>
                        <small class="form-text text-muted">Jelaskan sekilas tentang perusahaan Anda</small>
                    </div>

                    <!-- Tahun Berdiri -->
                    <div class="mb-3">
                        <label for="tahun_berdiri" class="form-label fw-bold">Tahun Berdiri</label>
                        <input type="number" class="form-control" id="tahun_berdiri" name="tahun_berdiri" 
                               placeholder="Contoh: 2010" min="1900" max="2100" value="<?php echo e($sekilas->tahun_berdiri ?? ''); ?>">
                    </div>

                    <!-- Jumlah Karyawan -->
                    <div class="mb-3">
                        <label for="jumlah_karyawan" class="form-label fw-bold">Jumlah Karyawan</label>
                        <input type="number" class="form-control" id="jumlah_karyawan" name="jumlah_karyawan" 
                               placeholder="Contoh: 150" min="0" value="<?php echo e($sekilas->jumlah_karyawan ?? ''); ?>">
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Gambar (Opsional)</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="form-text text-muted">Format: JPG, PNG, GIF. Max: 20MB</small>
                        <?php if($sekilas && $sekilas->image): ?>
                        <div class="mt-2">
                            <small class="text-muted">Gambar saat ini:</small><br>
                            <img src="<?php echo e(asset('storage/' . $sekilas->image)); ?>" 
                                 style="max-width: 200px; max-height: 150px; object-fit: cover; border-radius: 5px;" />
                        </div>
                        <?php endif; ?>
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

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Edit Sekilas button
    document.getElementById('editSekilasBtn').addEventListener('click', function() {
        document.getElementById('sekilasForm').reset();
        <?php if($sekilas): ?>
            document.getElementById('id').value = '<?php echo e($sekilas->id); ?>';
            document.getElementById('judul').value = '<?php echo e($sekilas->judul); ?>';
            document.getElementById('deskripsi').value = '<?php echo e($sekilas->deskripsi); ?>';
            document.getElementById('tahun_berdiri').value = '<?php echo e($sekilas->tahun_berdiri); ?>';
            document.getElementById('jumlah_karyawan').value = '<?php echo e($sekilas->jumlah_karyawan); ?>';
        <?php endif; ?>
        document.getElementById('previewImage').style.display = 'none';
    });

    // Form submission
    document.getElementById('sekilasForm').addEventListener('submit', function(e) {
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
        const id = document.getElementById('id').value;
        
        let url = id 
            ? `<?php echo e(route('admin.sekilas.update', '')); ?>/${id}`
            : '<?php echo e(route('admin.sekilas.store')); ?>';

        if (id) {
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

<?php echo $__env->make($layout, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/admin/sekilas_perusahaan/index.blade.php ENDPATH**/ ?>