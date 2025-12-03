<?php $__env->startSection('page-title', 'Manajemen Berita'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page">Berita</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h4 class="fw-semibold">
                <i class="bi bi-newspaper"></i> Manajemen Berita
            </h4>
            <p class="text-muted mb-0">Kelola berita dan artikel perusahaan Anda</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?php echo e(route('admin.berita.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Tambah Berita
            </a>
        </div>
    </div>

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            <strong>Sukses!</strong> <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            <strong>Error!</strong> <?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    
    <?php if($beritas->count() > 0): ?>
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th style="width: 120px;">Tanggal</th>
                                <th style="width: 130px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <?php if($berita->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $berita->image)); ?>" 
                                             class="img-thumbnail" 
                                             style="width: 70px; height: 50px; object-fit: cover;" 
                                             alt="Gambar berita: <?php echo e($berita->title); ?>">
                                    <?php else: ?>
                                        <span class="badge bg-secondary">No Image</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong><?php echo e($berita->title); ?></strong>
                                </td>
                                <td>
                                    <span class="text-muted">
                                        <?php echo e(Str::limit($berita->description, 80)); ?>

                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <?php echo e($berita->created_at->format('d M Y')); ?>

                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="<?php echo e(route('admin.berita.edit', $berita->id)); ?>" 
                                           class="btn btn-warning" 
                                           title="Edit berita">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.berita.destroy', $berita->id)); ?>" 
                                              method="POST" 
                                              style="display: inline;" 
                                              onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger" title="Hapus berita">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <h5 class="alert-heading mb-2">Belum ada berita</h5>
                    <p class="mb-0">Silakan <a href="<?php echo e(route('admin.berita.create')); ?>" class="alert-link">tambahkan berita baru</a> untuk memulai.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/admin/news/index.blade.php ENDPATH**/ ?>