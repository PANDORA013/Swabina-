@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><i class="fas fa-user-edit me-2"></i>Edit Admin</h2>
            <p class="text-muted">Update admin user information and permissions</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.admin-management.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fas fa-form me-2"></i>Form Edit Admin
            </h5>
        </div>
        <div class="card-body">
            <form id="editAdminForm" method="POST" action="{{ route('admin.admin-management.update', $admin) }}">
                @csrf
                @method('PUT')

                <!-- Basic Information -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="border-bottom pb-2 mb-3">
                            <i class="fas fa-user me-2"></i>Informasi Dasar
                        </h6>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name', $admin->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- Password (Optional) -->
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h6 class="border-bottom pb-2 mb-3">
                            <i class="fas fa-lock me-2"></i>Password (Opsional)
                        </h6>
                        <p class="text-muted small">Kosongkan jika tidak ingin mengubah password</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimal 8 karakter</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                               id="password_confirmation" name="password_confirmation">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                        <select class="form-select @error('admin_role_id') is-invalid @enderror" 
                                id="admin_role_id" name="admin_role_id" required onchange="updatePermissions()">
                            <option value="">-- Pilih Role --</option>
                            @foreach($adminRoles as $role)
                                @if($role->name !== 'super_admin')
                                    <option value="{{ $role->id }}" 
                                            data-role="{{ $role->name }}"
                                            {{ old('admin_role_id', $admin->admin_role_id) == $role->id ? 'selected' : '' }}>
                                        {{ $role->display_name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('admin_role_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted d-block mt-2" id="roleDescription"></small>
                    </div>
                </div>

                <!-- Custom Permissions -->
                <div class="row mb-4" id="permissionsSection">
                    <div class="col-md-12">
                        <h6 class="border-bottom pb-2 mb-3">
                            <i class="fas fa-key me-2"></i>Custom Permissions (Opsional)
                        </h6>
                        <p class="text-muted small">Tambahkan permissions khusus di luar role yang dipilih</p>
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
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.admin-management.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="button" class="btn btn-danger float-end" onclick="deleteAdmin()">
                            <i class="fas fa-trash me-2"></i>Hapus Admin
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Admin Information Card -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-info-circle me-2"></i>Informasi Admin
                    </h6>
                    <p class="mb-1">
                        <strong>Dibuat:</strong> {{ $admin->created_at->format('d M Y H:i') }}
                    </p>
                    <p class="mb-1">
                        <strong>Diupdate:</strong> {{ $admin->updated_at->format('d M Y H:i') }}
                    </p>
                    <p class="mb-0">
                        <strong>Status:</strong> 
                        <span class="badge bg-success">Aktif</span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-shield-alt me-2"></i>Role Saat Ini
                    </h6>
                    @if($admin->adminRole)
                        <p class="mb-1">
                            <strong>Role:</strong> 
                            <span class="badge bg-primary">{{ $admin->adminRole->display_name }}</span>
                        </p>
                        <p class="mb-0">
                            <strong>Permissions:</strong> {{ $admin->adminRole->permissions->count() }}
                        </p>
                    @else
                        <p class="text-muted">No role assigned</p>
                    @endif
                </div>
            </div>
        </div>
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
                <p>Apakah Anda yakin ingin menghapus admin <strong>{{ $admin->name }}</strong>?</p>
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

@push('scripts')
<script>
const roleDescriptions = {
    'admin': 'Full access to all content management features',
    'moderator': 'Limited access to view-only features'
};

const currentUserPermissions = {!! json_encode($userPermissions) !!};

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
                }
            })
            .catch(error => console.error('Error:', error));
    }
}

function loadPermissionsCheckboxes(permissions) {
    const container = document.getElementById('permissionsContainer');
    container.innerHTML = '';
    
    const grouped = {};
    @foreach($permissions as $module => $perms)
        grouped['{{ $module }}'] = [
            @foreach($perms as $perm)
                '{{ $perm->name }}',
            @endforeach
        ];
    @endforeach
    
    for (const [module, perms] of Object.entries(grouped)) {
        const moduleDiv = document.createElement('div');
        moduleDiv.className = 'mb-3';
        moduleDiv.innerHTML = `<strong class="d-block mb-2">${module}</strong>`;
        
        perms.forEach(perm => {
            const isChecked = currentUserPermissions.includes(perm);
            const checkbox = document.createElement('div');
            checkbox.className = 'form-check';
            checkbox.innerHTML = `
                <input class="form-check-input" type="checkbox" name="custom_permissions[]" 
                       value="${perm}" id="perm_${perm}" ${isChecked ? 'checked' : ''}>
                <label class="form-check-label" for="perm_${perm}">
                    ${perm.replace(/_/g, ' ')}
                </label>
            `;
            moduleDiv.appendChild(checkbox);
        });
        
        container.appendChild(moduleDiv);
    }
}

function deleteAdmin() {
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    fetch(`/admin/admin-management/{{ $admin->id }}`, {
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
                window.location.href = '{{ route("admin.admin-management.index") }}';
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
});

// Form submission
document.getElementById('editAdminForm').addEventListener('submit', function(e) {
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
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: data.message,
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = '{{ route("admin.admin-management.index") }}';
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
});

// Initialize permissions on page load
document.addEventListener('DOMContentLoaded', function() {
    updatePermissions();
});
</script>
@endpush
@endsection
