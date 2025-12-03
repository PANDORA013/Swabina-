<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><i class="fas fa-user-plus me-2"></i>Tambah Admin Baru</h2>
            <p class="text-muted">Create new admin user with specific role and permissions</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?php echo e(route('admin.admin-management.index')); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fas fa-form me-2"></i>Form Tambah Admin
            </h5>
        </div>
        <div class="card-body">
            <form id="createAdminForm" method="POST" action="<?php echo e(route('admin.admin-management.store')); ?>">
                <?php echo csrf_field(); ?>

                <!-- Basic Information -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="border-bottom pb-2 mb-3">
                            <i class="fas fa-user me-2"></i>Informasi Dasar
                        </h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="name" name="name" value="<?php echo e(old('name')); ?>" required>
                        <?php $__errorArgs = ['name'];
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
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="email" name="email" value="<?php echo e(old('email')); ?>" required>
                        <?php $__errorArgs = ['email'];
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

                <!-- Password -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="border-bottom pb-2 mb-3">
                            <i class="fas fa-lock me-2"></i>Password
                        </h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="password" name="password" required>
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted">Minimal 8 karakter</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                               id="password_confirmation" name="password_confirmation" required>
                        <?php $__errorArgs = ['password_confirmation'];
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

                <!-- Role Selection -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="border-bottom pb-2 mb-3">
                            <i class="fas fa-shield-alt me-2"></i>Role & Permissions
                        </h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="admin_role_id" class="form-label">Pilih Role <span class="text-danger">*</span></label>
                        <select class="form-select <?php $__errorArgs = ['admin_role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                id="admin_role_id" name="admin_role_id" required onchange="updatePermissions()">
                            <option value="">-- Pilih Role --</option>
                            <?php $__currentLoopData = $adminRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($role->name !== 'super_admin'): ?>
                                    <option value="<?php echo e($role->id); ?>" data-role="<?php echo e($role->name); ?>">
                                        <?php echo e($role->display_name); ?>

                                    </option>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['admin_role_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <small class="text-muted d-block mt-2" id="roleDescription"></small>
                    </div>
                </div>

                <!-- Custom Permissions -->
                <div class="row mb-4" id="permissionsSection" style="display: none;">
                    <div class="col-md-12">
                        <h6 class="border-bottom pb-2 mb-3">
                            <i class="fas fa-key me-2"></i>Custom Permissions (Opsional)
                        </h6>
                        <p class="text-muted small">Jika ingin menambahkan permissions khusus di luar role yang dipilih</p>
                    </div>
                    <div class="col-md-12">
                        <div id="permissionsContainer">
                            <!-- Permissions will be loaded here -->
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Simpan Admin
                        </button>
                        <a href="<?php echo e(route('admin.admin-management.index')); ?>" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Role Information Cards -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h5 class="mb-3">
                <i class="fas fa-info-circle me-2"></i>Informasi Role
            </h5>
        </div>
        <?php $__currentLoopData = $adminRoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($role->name !== 'super_admin'): ?>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">
                                <span class="badge bg-primary"><?php echo e($role->display_name); ?></span>
                            </h6>
                            <p class="card-text small"><?php echo e($role->description); ?></p>
                            <small class="text-muted">
                                <strong>Permissions:</strong> <?php echo e($role->permissions->count()); ?>

                            </small>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
const roleDescriptions = {
    'admin': 'Full access to all content management features',
    'moderator': 'Limited access to view-only features'
};

function updatePermissions() {
    const roleId = document.getElementById('admin_role_id').value;
    const roleOption = document.querySelector(`option[value="${roleId}"]`);
    const roleName = roleOption?.dataset.role || '';
    
    // Update role description
    document.getElementById('roleDescription').textContent = roleDescriptions[roleName] || '';
    
    // Load permissions for this role
    if (roleId) {
        fetch(`/admin/admin-management/${roleId}/permissions`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    loadPermissionsCheckboxes(data.data);
                    document.getElementById('permissionsSection').style.display = 'block';
                }
            })
            .catch(error => console.error('Error:', error));
    } else {
        document.getElementById('permissionsSection').style.display = 'none';
    }
}

function loadPermissionsCheckboxes(permissions) {
    const container = document.getElementById('permissionsContainer');
    container.innerHTML = '';
    
    const grouped = {};
    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module => $perms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        grouped['<?php echo e($module); ?>'] = [
            <?php $__currentLoopData = $perms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                '<?php echo e($perm->name); ?>',
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    for (const [module, perms] of Object.entries(grouped)) {
        const moduleDiv = document.createElement('div');
        moduleDiv.className = 'mb-3';
        moduleDiv.innerHTML = `<strong class="d-block mb-2">${module}</strong>`;
        
        perms.forEach(perm => {
            const checkbox = document.createElement('div');
            checkbox.className = 'form-check';
            checkbox.innerHTML = `
                <input class="form-check-input" type="checkbox" name="custom_permissions[]" 
                       value="${perm}" id="perm_${perm}">
                <label class="form-check-label" for="perm_${perm}">
                    ${perm.replace(/_/g, ' ')}
                </label>
            `;
            moduleDiv.appendChild(checkbox);
        });
        
        container.appendChild(moduleDiv);
    }
}

// Form submission
document.getElementById('createAdminForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch(this.action, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw { status: response.status, data: data };
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message,
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '<?php echo e(route("admin.admin-management.index")); ?>';
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
        let errorMessage = 'Terjadi kesalahan';
        if (error.data && error.data.errors) {
            errorMessage = Object.values(error.data.errors).flat().join('\n');
        } else if (error.data && error.data.message) {
            errorMessage = error.data.message;
        }
        
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: errorMessage,
            confirmButtonText: 'OK'
        });
    });
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/admin/admin-management/create.blade.php ENDPATH**/ ?>