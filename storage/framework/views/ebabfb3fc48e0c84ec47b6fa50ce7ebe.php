<?php $__env->startSection('page-title', 'Kelola Admin'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page">Admin Management</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <p class="text-muted">Manage admin users and their permissions</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?php echo e(route('admin.admin-management.create')); ?>" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Admin Baru
            </a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Daftar Admin
                <span class="badge bg-primary float-end"><?php echo e($admins->total()); ?></span>
            </h5>
        </div>
        <div class="card-body">
            <?php if($admins->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%">Nama</th>
                                <th width="25%">Email</th>
                                <th width="20%">Role</th>
                                <th width="15%">Dibuat</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration + ($admins->currentPage() - 1) * $admins->perPage()); ?></td>
                                    <td>
                                        <strong><?php echo e($admin->name); ?></strong>
                                        <?php if($admin->isSuperAdmin()): ?>
                                            <span class="badge bg-danger ms-2">Super Admin</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($admin->email); ?></td>
                                    <td>
                                        <?php if($admin->isSuperAdmin()): ?>
                                            <span class="badge bg-danger">Super Administrator</span>
                                        <?php elseif($admin->adminRole): ?>
                                            <span class="badge bg-info"><?php echo e($admin->adminRole->display_name); ?></span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">No Role</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            <?php echo e($admin->created_at->format('d M Y H:i')); ?>

                                        </small>
                                    </td>
                                    <td>
                                        <?php if(!$admin->isSuperAdmin()): ?>
                                            <a href="<?php echo e(route('admin.admin-management.edit', $admin)); ?>" 
                                               class="btn btn-sm btn-warning" title="Edit" aria-label="Edit admin <?php echo e($admin->name); ?>">
                                                <i class="fas fa-edit" aria-hidden="true"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" 
                                                    onclick="deleteAdmin(<?php echo e($admin->id); ?>, '<?php echo e($admin->name); ?>')" 
                                                    title="Delete" aria-label="Delete admin <?php echo e($admin->name); ?>">
                                                <i class="fas fa-trash" aria-hidden="true"></i>
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4">
                    <?php echo e($admins->links()); ?>

                </nav>
            <?php else: ?>
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    Belum ada admin user. <a href="<?php echo e(route('admin.admin-management.create')); ?>">Buat admin baru</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Admin Roles Info -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h5 class="mb-3">
                <i class="fas fa-shield-alt me-2"></i>Daftar Role
            </h5>
        </div>
        <?php $__currentLoopData = $adminRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            <span class="badge bg-primary"><?php echo e($role->display_name); ?></span>
                        </h6>
                        <p class="card-text small text-muted"><?php echo e($role->description); ?></p>
                        <small class="text-secondary">
                            <strong>Pengguna:</strong> <?php echo e($role->users->count()); ?>

                        </small>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">
                    <i class="fas fa-trash me-2"></i>Hapus Admin
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus admin <strong id="adminName"></strong>?</p>
                <p class="text-danger small">
                    <i class="fas fa-warning me-2"></i>
                    Tindakan ini tidak dapat dibatalkan!
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Hapus</button>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
let deleteAdminId = null;

function deleteAdmin(adminId, adminName) {
    deleteAdminId = adminId;
    document.getElementById('adminName').textContent = adminName;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (deleteAdminId) {
        fetch(`/admin/admin-management/${deleteAdminId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: data.message,
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Terjadi kesalahan: ' + error.message,
                confirmButtonText: 'OK'
            });
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/admin/admin-management/index.blade.php ENDPATH**/ ?>