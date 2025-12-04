<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="card w-100 position-relative overflow-hidden">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0">Sertifikat & Penghargaan</h5>
                <a href="<?php echo e(route('admin.sertifikat.create')); ?>" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah
                </a>
            </div>
            
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <div class="row">
                <?php $__empty_1 = true; $__currentLoopData = $sertifikats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            <?php if($item->image): ?>
                                <img src="<?php echo e(asset('storage/' . $item->image)); ?>" class="card-img-top p-3" alt="Sertifikat" style="height: 200px; object-fit: contain;">
                            <?php else: ?>
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-body p-3">
                            <h6 class="card-title fw-semibold mb-1 text-center"><?php echo e($item->nama ?? 'Sertifikat'); ?></h6>
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <a href="<?php echo e(route('admin.sertifikat.edit', $item->id)); ?>" class="btn btn-warning btn-sm w-100">
                                    <i class="ti ti-edit"></i> Edit
                                </a>
                                <form action="<?php echo e(route('admin.sertifikat.destroy', $item->id)); ?>" method="POST" class="w-100" onsubmit="return confirm('Hapus sertifikat ini?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                        <i class="ti ti-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <h6 class="fw-semibold text-muted">Belum ada sertifikat</h6>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/admin/sertifikat/index.blade.php ENDPATH**/ ?>