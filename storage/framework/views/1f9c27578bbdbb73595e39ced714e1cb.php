<?php $__env->startSection('title', 'Tentang Kami | PT Swabina Gatra'); ?>

<?php $__env->startSection('content'); ?>


<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="fw-bold display-5 mb-4">Tentang Kami</h1>
                <p class="lead text-muted mb-4">Mengenal lebih dekat PT Swabina Gatra, sejarah perjalanan, dan komitmen kami.</p>
            </div>
            <div class="col-lg-6">
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('beranda')); ?>">Beranda</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>


<div id="sekilas"></div>


<?php if($sekilas): ?>
<section class="py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <?php if($sekilas->image): ?>
                    <img src="<?php echo e(asset('assets/gambar_sekilas/' . $sekilas->image)); ?>" alt="Sekilas Perusahaan" class="img-fluid rounded shadow-lg w-100" loading="lazy">
                <?php else: ?>
                    <img src="https://via.placeholder.com/600x400?text=Company+Overview" alt="Placeholder" class="img-fluid rounded shadow">
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <h2 class="fw-bold mb-3"><?php echo e($sekilas->title); ?></h2>
                <div class="text-muted">
                    <?php echo $sekilas->description; ?>

                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<div id="memilihkami"></div>

<?php if($whyChooseUs->count() > 0): ?>
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Mengapa Memilih Kami?</h2>
        </div>
        <div class="row g-4">
            <?php $__currentLoopData = $whyChooseUs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm text-center p-4">
                    <div class="mb-3 text-primary">
                        <?php if($item->icon): ?>
                             
                             <img src="<?php echo e(asset('assets/icons/' . $item->icon)); ?>" style="height: 50px;" alt="Icon">
                        <?php else: ?>
                             <i class="bi bi-check-circle fs-1"></i>
                        <?php endif; ?>
                    </div>
                    <h4 class="card-title fw-bold"><?php echo e($item->title); ?></h4>
                    <p class="card-text text-muted"><?php echo e($item->description); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<div id="jejaklangkah"></div>

<?php if($jejakLangkahs->count() > 0): ?>
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Jejak Langkah</h2>
            <p class="text-muted">Perjalanan kami dari masa ke masa</p>
        </div>
        <div class="timeline">
            <?php $__currentLoopData = $jejakLangkahs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jejak): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="row mb-4 border-bottom pb-4">
                <div class="col-md-2 text-center">
                    <div class="h2 fw-bold text-primary"><?php echo e($jejak->year); ?></div>
                </div>
                <div class="col-md-3 text-center mb-3 mb-md-0">
                    <?php if($jejak->image): ?>
                        <img src="<?php echo e(asset('assets/gambar_jejak/' . $jejak->image)); ?>" class="img-fluid rounded" style="max-height: 150px;" loading="lazy" alt="Jejak <?php echo e($jejak->year); ?>">
                    <?php endif; ?>
                </div>
                <div class="col-md-7">
                    <p class="mb-0"><?php echo e($jejak->description); ?></p>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<div id="sertif"></div>

<?php if($sertifikats->count() > 0): ?>
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Sertifikat & Penghargaan</h2>
        </div>
        <div class="row g-4 justify-content-center">
            <?php $__currentLoopData = $sertifikats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sertif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-6 col-md-3">
                <div class="card h-100 border-0 shadow-sm text-center">
                    <div class="card-body">
                        <?php if($sertif->image): ?>
                            <img src="<?php echo e(asset('assets/gambar_sertifikat/' . $sertif->image)); ?>" class="img-fluid mb-3" style="max-height: 120px;" loading="lazy" alt="<?php echo e($sertif->title); ?>">
                        <?php endif; ?>
                        <h6 class="card-title fw-semibold small"><?php echo e($sertif->title); ?></h6>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-professional', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/tentangkami/tentangkami.blade.php ENDPATH**/ ?>