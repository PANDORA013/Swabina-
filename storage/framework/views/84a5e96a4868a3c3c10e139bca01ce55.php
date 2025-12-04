<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0">Mengapa Memilih Kami</h5>
                <a href="<?php echo e(route('admin.why-choose-us.create')); ?>" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah Item
                </a>
            </div>
            
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show"><?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th><h6 class="fw-semibold mb-0">No</h6></th>
                            <th><h6 class="fw-semibold mb-0">Icon</h6></th>
                            <th><h6 class="fw-semibold mb-0">Judul</h6></th>
                            <th><h6 class="fw-semibold mb-0">Deskripsi</h6></th>
                            <th><h6 class="fw-semibold mb-0">Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <?php if($item->icon): ?>
                                    <img src="<?php echo e(asset('assets/icons/' . $item->icon)); ?>" width="40" alt="Icon">
                                <?php else: ?> - <?php endif; ?>
                            </td>
                            <td><h6 class="fw-semibold"><?php echo e($item->title); ?></h6></td>
                            <td><p class="text-muted mb-0"><?php echo e(Str::limit($item->description, 50)); ?></p></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="<?php echo e(route('admin.why-choose-us.edit', $item->id)); ?>" class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                    <form action="<?php echo e(route('admin.why-choose-us.destroy', $item->id)); ?>" method="POST" onsubmit="return confirm('Hapus item ini?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/admin/why-choose-us/index.blade.php ENDPATH**/ ?>