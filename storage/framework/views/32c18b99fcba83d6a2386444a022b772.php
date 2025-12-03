<?php $__env->startSection('page-title', 'Manajemen FAQ'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <p class="text-muted">Kelola pertanyaan yang sering ditanyakan</p>
        </div>
        <div class="col-md-4 text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#faqModal" id="addFaqBtn">
                <i class="fas fa-plus"></i> Tambah FAQ
            </button>
        </div>
    </div>
    <?php if($faqs->count() > 0): ?>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Pertanyaan</th>
                    <th width="40%">Jawaban</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($key + 1); ?></td>
                    <td>
                        <strong><?php echo e($faq->question); ?></strong>
                    </td>
                    <td>
                        <span class="text-muted"><?php echo e(Str::limit($faq->answer, 100)); ?></span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning editBtn" 
                            data-id="<?php echo e($faq->id); ?>"
                            data-question="<?php echo e($faq->question); ?>"
                            data-answer="<?php echo e($faq->answer); ?>"
                            data-bs-toggle="modal" 
                            data-bs-target="#faqModal">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="<?php echo e($faq->id); ?>">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php else: ?>
    <div class="alert alert-info" role="alert">
        <i class="fas fa-info-circle"></i> Belum ada FAQ. Silakan tambahkan FAQ baru.
    </div>
    <?php endif; ?>
</div>

<!-- Modal for Add/Edit FAQ -->
<div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="faqForm" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="faqModalLabel">Tambah FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    
                    <div class="mb-3">
                        <label for="question" class="form-label">Pertanyaan</label>
                        <textarea class="form-control" id="question" name="question" rows="2" required></textarea>
                        <small class="text-muted">Masukkan pertanyaan</small>
                    </div>

                    <div class="mb-3">
                        <label for="answer" class="form-label">Jawaban</label>
                        <textarea class="form-control" id="answer" name="answer" rows="4" required></textarea>
                        <small class="text-muted">Masukkan jawaban</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
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

    // Add FAQ button
    document.getElementById('addFaqBtn').addEventListener('click', function() {
        isEditing = false;
        editId = null;
        document.getElementById('faqForm').reset();
        document.getElementById('faqModalLabel').textContent = 'Tambah FAQ';
        document.getElementById('id').value = '';
    });

    // Edit FAQ buttons
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            isEditing = true;
            editId = this.getAttribute('data-id');
            const question = this.getAttribute('data-question');
            const answer = this.getAttribute('data-answer');

            document.getElementById('faqModalLabel').textContent = 'Edit FAQ';
            document.getElementById('id').value = editId;
            document.getElementById('question').value = question;
            document.getElementById('answer').value = answer;
        });
    });

    // Form submission
    document.getElementById('faqForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        let url = isEditing 
            ? `<?php echo e(url('admin/faq/update')); ?>/${editId}`
            : '<?php echo e(route('admin.faq.store')); ?>';

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
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: error.message || 'Terjadi kesalahan saat memproses data',
                timer: 3000,
                showConfirmButton: false
            });
        });
    });

    // Delete FAQ buttons
    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');

            Swal.fire({
                title: 'Hapus FAQ?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('_method', 'DELETE');

                    fetch(`<?php echo e(url('admin/faq/delete')); ?>/${id}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
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
                            Swal.fire({
                                icon: 'success',
                                title: 'Dihapus!',
                                text: data.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Gagal menghapus FAQ');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: error.message || 'Terjadi kesalahan saat menghapus',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    });
                }
            });
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/admin/faq/index.blade.php ENDPATH**/ ?>