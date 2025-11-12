

<?php $__env->startSection('content'); ?>
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h1 class="h3 mb-0">Kelola "Mengapa Memilih Kami"</h1>
            <p class="text-muted">Manage konten untuk section "Mengapa Memilih Kami"</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?php echo e(route('admin.why-choose-us.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Item Baru
            </a>
        </div>
    </div>

    <?php if($message = Session::get('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e($message); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if($message = Session::get('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e($message); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <?php if($items->count() > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="5%">Icon</th>
                                <th width="25%">Judul</th>
                                <th width="35%">Deskripsi</th>
                                <th width="10%">Status</th>
                                <th width="10%">Order</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td>
                                        <i class="bi <?php echo e($item->icon); ?>" style="font-size: 1.5rem;"></i>
                                    </td>
                                    <td>
                                        <strong><?php echo e($item->title); ?></strong>
                                    </td>
                                    <td>
                                        <small><?php echo e(Str::limit(strip_tags($item->description), 50)); ?></small>
                                    </td>
                                    <td>
                                        <span class="badge bg-<?php echo e($item->status === 'active' ? 'success' : 'danger'); ?>">
                                            <?php echo e(ucfirst($item->status)); ?>

                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info"><?php echo e($item->order); ?></span>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('admin.why-choose-us.edit', $item->id)); ?>" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.why-choose-us.destroy', $item->id)); ?>" 
                                              method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Yakin hapus item ini?')" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center py-4">
                    <i class="bi bi-info-circle me-2"></i>
                    <span>Belum ada data. <a href="<?php echo e(route('admin.why-choose-us.create')); ?>">Tambah sekarang</a></span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/admin/why-choose-us/index.blade.php ENDPATH**/ ?>