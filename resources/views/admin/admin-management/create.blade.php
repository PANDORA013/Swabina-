@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2><i class="fas fa-user-plus me-2"></i>Tambah Admin Baru</h2>
            <p class="text-muted">Create new admin user with specific role and permissions</p>
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
                <i class="fas fa-form me-2"></i>Form Tambah Admin
            </h5>
        </div>
        <div class="card-body">
            <form id="createAdminForm" method="POST" action="{{ route('admin.admin-management.store') }}">
                @csrf

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
                               id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimal 8 karakter</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                               id="password_confirmation" name="password_confirmation" required>
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
                                    <option value="{{ $role->id }}" data-role="{{ $role->name }}">
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
                        <a href="{{ route('admin.admin-management.index') }}" class="btn btn-secondary">
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
        @foreach($adminRoles as $role)
            @if($role->name !== 'super_admin')
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title">
                                <span class="badge bg-primary">{{ $role->display_name }}</span>
                            </h6>
                            <p class="card-text small">{{ $role->description }}</p>
                            <small class="text-muted">
                                <strong>Permissions:</strong> {{ $role->permissions->count() }}
                            </small>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>

@push('scripts')
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
@endpush
@endsection
