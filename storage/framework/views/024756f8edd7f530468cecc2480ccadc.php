<?php $__env->startSection('page-title', 'Social Media Links'); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item active" aria-current="page">Social Media</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="mb-3">
        <button class="btn btn-primary" id="addSocialBtn" data-bs-toggle="modal" data-bs-target="#socialModal">
            <i class="fas fa-plus me-2"></i>Tambah Social Media
        </button>
    </div>
    
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Tipe</th>
                <th>URL</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if($social->facebook): ?>
            <tr>
                <td>Facebook</td>
                <td><?php echo e($social->facebook); ?></td>
                <td>
                    <button class="btn btn-warning editBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="facebook"
                        data-url="<?php echo e($social->facebook); ?>"
                        data-bs-toggle="modal" 
                        data-bs-target="#socialModal">Edit</button>
                    <button class="btn btn-danger deleteBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="facebook">Delete</button>
                </td>
            </tr>
            <?php endif; ?>

            <?php if($social->youtube): ?>
            <tr>
                <td>YouTube</td>
                <td><?php echo e($social->youtube); ?></td>
                <td>
                    <button class="btn btn-warning editBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="youtube"
                        data-url="<?php echo e($social->youtube); ?>"
                        data-bs-toggle="modal" 
                        data-bs-target="#socialModal">Edit</button>
                    <button class="btn btn-danger deleteBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="youtube">Delete</button>
                </td>
            </tr>
            <?php endif; ?>

            <?php if($social->youtube_landing): ?>
            <tr>
                <td>YouTube Landing</td>
                <td><?php echo e($social->youtube_landing); ?></td>
                <td>
                    <button class="btn btn-warning editBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="youtube_landing"
                        data-url="<?php echo e($social->youtube_landing); ?>"
                        data-bs-toggle="modal" 
                        data-bs-target="#socialModal">Edit</button>
                    <button class="btn btn-danger deleteBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="youtube_landing">Delete</button>
                </td>
            </tr>
            <?php endif; ?>

            <?php if($social->whatsapp): ?>
            <tr>
                <td>WhatsApp</td>
                <td><?php echo e($social->whatsapp); ?></td>
                <td>
                    <button class="btn btn-warning editBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="whatsapp"
                        data-url="<?php echo e($social->whatsapp); ?>"
                        data-bs-toggle="modal" 
                        data-bs-target="#socialModal">Edit</button>
                    <button class="btn btn-danger deleteBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="whatsapp">Delete</button>
                </td>
            </tr>
            <?php endif; ?>

            <?php if($social->instagram): ?>
            <tr>
                <td>Instagram</td>
                <td><?php echo e($social->instagram); ?></td>
                <td>
                    <button class="btn btn-warning editBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="instagram"
                        data-url="<?php echo e($social->instagram); ?>"
                        data-bs-toggle="modal" 
                        data-bs-target="#socialModal">Edit</button>
                    <button class="btn btn-danger deleteBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="instagram">Delete</button>
                </td>
            </tr>
            <?php endif; ?>

            <?php if($social->linkedin): ?>
            <tr>
                <td>LinkedIn</td>
                <td><?php echo e($social->linkedin); ?></td>
                <td>
                    <button class="btn btn-warning editBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="linkedin"
                        data-url="<?php echo e($social->linkedin); ?>"
                        data-bs-toggle="modal" 
                        data-bs-target="#socialModal">Edit</button>
                    <button class="btn btn-danger deleteBtn" 
                        data-id="<?php echo e($social->id); ?>"
                        data-type="linkedin">Delete</button>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal for Add/Edit -->
<div class="modal fade" id="socialModal" tabindex="-1" aria-labelledby="socialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="socialForm" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="socialModalLabel">Add Social Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="type">Tipe</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="facebook">Facebook</option>
                            <option value="youtube">YouTube</option>
                            <option value="youtube_landing">YouTube Landing</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="instagram">Instagram</option>
                            <option value="linkedin">LinkedIn</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="url">URL</label>
                        <input type="url" class="form-control" id="url" name="url" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
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

    document.getElementById('addSocialBtn').addEventListener('click', function() {
        isEditing = false;
        editId = null;
        document.getElementById('socialForm').reset();
        document.getElementById('socialModalLabel').textContent = 'Add Social Media';
        document.getElementById('id').value = '';
    });

    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            isEditing = true;
            editId = this.getAttribute('data-id');
            const type = this.getAttribute('data-type');
            const url = this.getAttribute('data-url');

            document.getElementById('socialModalLabel').textContent = 'Edit Social Media';
            document.getElementById('id').value = editId;
            document.getElementById('type').value = type;
            document.getElementById('url').value = url;
        });
    });

    document.getElementById('socialForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        let formData = new FormData(this);
        
        let url = isEditing 
            ? '<?php echo e(route("admin.social-media.update", ":id")); ?>'.replace(':id', editId)
            : '<?php echo e(route("admin.social-media.store")); ?>';

        if (isEditing) {
            formData.append('_method', 'PUT');
        }

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
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
                    title: 'Success!',
                    text: data.message,
                    timer: 3000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'Unknown error occurred');
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: error.message || 'An unexpected error occurred',
                timer: 3000,
                showConfirmButton: false
            });
        });
    });

    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const type = this.getAttribute('data-type');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('_method', 'DELETE');
                    formData.append('type', type);

                    fetch(`<?php echo e(route('admin.social-media.destroy', ':id')); ?>`.replace(':id', id), {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
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
                                title: 'Deleted!',
                                text: data.message,
                                timer: 3000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Failed to delete');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: error.message || 'An unexpected error occurred',
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

<?php echo $__env->make($layout, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\project_magang\resources\views/admin/social-media/index.blade.php ENDPATH**/ ?>