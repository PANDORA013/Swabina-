

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="mb-1"><i class="fas fa-building me-2"></i>Informasi Perusahaan</h1>
            <p class="text-muted">Kelola semua informasi perusahaan yang tampil di website public</p>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('admin.company-info.update')); ?>" method="POST" id="companyInfoForm">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Company Identity -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-id-card me-2"></i>Identitas Perusahaan</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nama Perusahaan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               name="company_name" value="<?php echo e(old('company_name', $companyInfo->company_name)); ?>" required>
                        <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Tagline Perusahaan</label>
                        <input type="text" class="form-control" name="company_tagline" 
                               value="<?php echo e(old('company_tagline', $companyInfo->company_tagline)); ?>"
                               placeholder="e.g., Leading Facility Management & Services">
                    </div>

                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Deskripsi Perusahaan</label>
                        <textarea class="form-control" name="company_description" rows="3"
                                  placeholder="Deskripsi singkat tentang perusahaan yang akan tampil di footer..."><?php echo e(old('company_description', $companyInfo->company_description)); ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Logo Perusahaan</label>
                        <?php if($companyInfo->company_logo): ?>
                            <div class="mb-2">
                                <img src="<?php echo e(asset('storage/' . $companyInfo->company_logo)); ?>" 
                                     alt="Company Logo" class="img-thumbnail" style="max-height: 100px;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" id="company_logo" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, SVG. Max: 2MB</small>
                        <button type="button" class="btn btn-sm btn-primary mt-2" onclick="uploadCompanyLogo()">
                            <i class="fas fa-upload me-1"></i>Upload Logo
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Head Office -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Kantor Pusat & Pabrik AMDK</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Alamat Lengkap <span class="text-danger">*</span></label>
                        <textarea class="form-control <?php $__errorArgs = ['head_office_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  name="head_office_address" rows="2" required><?php echo e(old('head_office_address', $companyInfo->head_office_address)); ?></textarea>
                        <?php $__errorArgs = ['head_office_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Kota <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['head_office_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               name="head_office_city" value="<?php echo e(old('head_office_city', $companyInfo->head_office_city)); ?>" required>
                        <?php $__errorArgs = ['head_office_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Provinsi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['head_office_province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               name="head_office_province" value="<?php echo e(old('head_office_province', $companyInfo->head_office_province)); ?>" required>
                        <?php $__errorArgs = ['head_office_province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Kode Pos <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['head_office_postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               name="head_office_postal_code" value="<?php echo e(old('head_office_postal_code', $companyInfo->head_office_postal_code)); ?>" required>
                        <?php $__errorArgs = ['head_office_postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Branch Office -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0"><i class="fas fa-building me-2"></i>Kantor Perwakilan (Opsional)</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label class="form-label fw-bold">Alamat Lengkap</label>
                        <textarea class="form-control" name="branch_office_address" rows="2"><?php echo e(old('branch_office_address', $companyInfo->branch_office_address)); ?></textarea>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Kota</label>
                        <input type="text" class="form-control" name="branch_office_city" 
                               value="<?php echo e(old('branch_office_city', $companyInfo->branch_office_city)); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Provinsi</label>
                        <input type="text" class="form-control" name="branch_office_province" 
                               value="<?php echo e(old('branch_office_province', $companyInfo->branch_office_province)); ?>">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label fw-bold">Kode Pos</label>
                        <input type="text" class="form-control" name="branch_office_postal_code" 
                               value="<?php echo e(old('branch_office_postal_code', $companyInfo->branch_office_postal_code)); ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="card mb-4">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0"><i class="fas fa-phone me-2"></i>Informasi Kontak</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email Utama <span class="text-danger">*</span></label>
                        <input type="email" class="form-control <?php $__errorArgs = ['email_primary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               name="email_primary" value="<?php echo e(old('email_primary', $companyInfo->email_primary)); ?>" required>
                        <?php $__errorArgs = ['email_primary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Email Sekunder</label>
                        <input type="email" class="form-control" name="email_secondary" 
                               value="<?php echo e(old('email_secondary', $companyInfo->email_secondary)); ?>">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Telepon Kantor Pusat 1 <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['phone_primary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               name="phone_primary" value="<?php echo e(old('phone_primary', $companyInfo->phone_primary)); ?>" 
                               placeholder="+62 31 3984719" required>
                        <?php $__errorArgs = ['phone_primary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Telepon Kantor Pusat 2</label>
                        <input type="text" class="form-control" name="phone_secondary" 
                               value="<?php echo e(old('phone_secondary', $companyInfo->phone_secondary)); ?>" 
                               placeholder="+62 31 3985794">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Telepon Perwakilan 1</label>
                        <input type="text" class="form-control" name="branch_phone_primary" 
                               value="<?php echo e(old('branch_phone_primary', $companyInfo->branch_phone_primary)); ?>" 
                               placeholder="+62 356 711992">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Telepon Perwakilan 2</label>
                        <input type="text" class="form-control" name="branch_phone_secondary" 
                               value="<?php echo e(old('branch_phone_secondary', $companyInfo->branch_phone_secondary)); ?>" 
                               placeholder="+62 356 711966">
                    </div>
                </div>
            </div>
        </div>

        <!-- Operating Hours -->
        <div class="card mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0"><i class="fas fa-clock me-2"></i>Jam Operasional</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Hari Kerja</h6>
                        <div class="mb-3">
                            <label class="form-label">Hari</label>
                            <input type="text" class="form-control" name="operating_hours_weekday_days" 
                                   value="<?php echo e(old('operating_hours_weekday_days', $companyInfo->operating_hours_weekday['days'] ?? 'Senin - Jumat')); ?>">
                        </div>
                        <div class="row">
                            <div class="col-4 mb-3">
                                <label class="form-label">Dari</label>
                                <input type="time" class="form-control" name="operating_hours_weekday_from" 
                                       value="<?php echo e(old('operating_hours_weekday_from', $companyInfo->operating_hours_weekday['from'] ?? '08:00')); ?>">
                            </div>
                            <div class="col-4 mb-3">
                                <label class="form-label">Sampai</label>
                                <input type="time" class="form-control" name="operating_hours_weekday_to" 
                                       value="<?php echo e(old('operating_hours_weekday_to', $companyInfo->operating_hours_weekday['to'] ?? '17:00')); ?>">
                            </div>
                            <div class="col-4 mb-3">
                                <label class="form-label">Zona</label>
                                <select class="form-select" name="operating_hours_weekday_timezone">
                                    <option value="WIB" <?php echo e(($companyInfo->operating_hours_weekday['timezone'] ?? 'WIB') == 'WIB' ? 'selected' : ''); ?>>WIB</option>
                                    <option value="WITA" <?php echo e(($companyInfo->operating_hours_weekday['timezone'] ?? '') == 'WITA' ? 'selected' : ''); ?>>WITA</option>
                                    <option value="WIT" <?php echo e(($companyInfo->operating_hours_weekday['timezone'] ?? '') == 'WIT' ? 'selected' : ''); ?>>WIT</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h6 class="fw-bold mb-3">Akhir Pekan</h6>
                        <div class="mb-3">
                            <label class="form-label">Hari</label>
                            <input type="text" class="form-control" name="operating_hours_weekend_days" 
                                   value="<?php echo e(old('operating_hours_weekend_days', $companyInfo->operating_hours_weekend['days'] ?? 'Sabtu')); ?>">
                        </div>
                        <div class="row">
                            <div class="col-4 mb-3">
                                <label class="form-label">Dari</label>
                                <input type="time" class="form-control" name="operating_hours_weekend_from" 
                                       value="<?php echo e(old('operating_hours_weekend_from', $companyInfo->operating_hours_weekend['from'] ?? '08:00')); ?>">
                            </div>
                            <div class="col-4 mb-3">
                                <label class="form-label">Sampai</label>
                                <input type="time" class="form-control" name="operating_hours_weekend_to" 
                                       value="<?php echo e(old('operating_hours_weekend_to', $companyInfo->operating_hours_weekend['to'] ?? '12:00')); ?>">
                            </div>
                            <div class="col-4 mb-3">
                                <label class="form-label">Zona</label>
                                <select class="form-select" name="operating_hours_weekend_timezone">
                                    <option value="WIB" <?php echo e(($companyInfo->operating_hours_weekend['timezone'] ?? 'WIB') == 'WIB' ? 'selected' : ''); ?>>WIB</option>
                                    <option value="WITA" <?php echo e(($companyInfo->operating_hours_weekend['timezone'] ?? '') == 'WITA' ? 'selected' : ''); ?>>WITA</option>
                                    <option value="WIT" <?php echo e(($companyInfo->operating_hours_weekend['timezone'] ?? '') == 'WIT' ? 'selected' : ''); ?>>WIT</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ISO Logos -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-certificate me-2"></i>Logo ISO / Sertifikasi</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php for($i = 1; $i <= 4; $i++): ?>
                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Logo ISO <?php echo e($i); ?></label>
                            <?php $logoField = 'iso_logo_' . $i; ?>
                            <?php if($companyInfo->$logoField): ?>
                                <div class="mb-2">
                                    <img src="<?php echo e(asset('storage/' . $companyInfo->$logoField)); ?>" 
                                         alt="ISO Logo <?php echo e($i); ?>" class="img-thumbnail" style="max-height: 80px;">
                                </div>
                            <?php endif; ?>
                            <input type="file" class="form-control mb-2" id="iso_logo_<?php echo e($i); ?>" accept="image/*">
                            <button type="button" class="btn btn-sm btn-success w-100" onclick="uploadIsoLogo(<?php echo e($i); ?>)">
                                <i class="fas fa-upload me-1"></i>Upload Logo <?php echo e($i); ?>

                            </button>
                        </div>
                    <?php endfor; ?>
                </div>
                <small class="text-muted">Logo ISO akan tampil di header website. Format: JPG, PNG. Max: 2MB</small>
            </div>
        </div>

        <!-- Save Button -->
        <div class="d-flex justify-content-end gap-2 mb-4">
            <button type="reset" class="btn btn-secondary">
                <i class="fas fa-undo me-2"></i>Reset
            </button>
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-save me-2"></i>Simpan Semua Perubahan
            </button>
        </div>
    </form>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function uploadCompanyLogo() {
    const fileInput = document.getElementById('company_logo');
    const file = fileInput.files[0];
    
    if (!file) {
        alert('Please select a file first!');
        return;
    }

    const formData = new FormData();
    formData.append('company_logo', file);
    formData.append('_token', '<?php echo e(csrf_token()); ?>');

    fetch('<?php echo e(route("admin.company-info.upload-logo")); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert('Upload failed!');
        }
    });
}

function uploadIsoLogo(logoNumber) {
    const fileInput = document.getElementById('iso_logo_' + logoNumber);
    const file = fileInput.files[0];
    
    if (!file) {
        alert('Please select a file first!');
        return;
    }

    const formData = new FormData();
    formData.append('iso_logo', file);
    formData.append('logo_number', logoNumber);
    formData.append('_token', '<?php echo e(csrf_token()); ?>');

    fetch('<?php echo e(route("admin.company-info.upload-iso-logo")); ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            location.reload();
        } else {
            alert('Upload failed!');
        }
    });
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/admin/company-info/index.blade.php ENDPATH**/ ?>