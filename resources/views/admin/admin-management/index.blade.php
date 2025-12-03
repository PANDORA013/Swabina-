@extends('layouts.app')

@section('page-title', 'Kelola Admin')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Admin Management</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <p class="text-muted">Manage admin users and their permissions</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.admin-management.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Tambah Admin Baru
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0">
                <i class="fas fa-list me-2"></i>Daftar Admin
                <span class="badge bg-primary float-end">{{ $admins->total() }}</span>
            </h5>
        </div>
        <div class="card-body">
            @if($admins->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%">Nama</th>
                                <th width="25%">Email</th>
                                <th width="20%">Role</th>
                                <th width="15%">Dibuat</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>{{ $loop->iteration + ($admins->currentPage() - 1) * $admins->perPage() }}</td>
                                    <td>
                                        <strong>{{ $admin->name }}</strong>
                                        @if($admin->isSuperAdmin())
                                            <span class="badge bg-danger ms-2">Super Admin</span>
                                        @endif
                                    </td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        @if($admin->isSuperAdmin())
                                            <span class="badge bg-danger">Super Administrator</span>
                                        @elseif($admin->adminRole)
                                            <span class="badge bg-info">{{ $admin->adminRole->display_name }}</span>
                                        @else
                                            <span class="badge bg-secondary">No Role</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $admin->created_at->format('d M Y H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        @if(!$admin->isSuperAdmin())
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="{{ route('admin.admin-management.privileges', $admin) }}" 
                                                   class="btn btn-info" title="Kelola Privilege" aria-label="Kelola privilege admin {{ $admin->name }}">
                                                    <i class="fas fa-lock" aria-hidden="true"></i>
                                                </a>
                                                <a href="{{ route('admin.admin-management.edit', $admin) }}" 
                                                   class="btn btn-warning" title="Edit" aria-label="Edit admin {{ $admin->name }}">
                                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger" 
                                                        onclick="deleteAdmin({{ $admin->id }}, '{{ $admin->name }}')" 
                                                        title="Delete" aria-label="Delete admin {{ $admin->name }}">
                                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation" class="mt-4">
                    {{ $admins->links() }}
                </nav>
            @else
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle me-2"></i>
                    Belum ada admin user. <a href="{{ route('admin.admin-management.create') }}">Buat admin baru</a>
                </div>
            @endif
        </div>
    </div>

    <!-- Admin Roles Info -->
    <div class="row mt-4">
        <div class="col-md-12">
            <h5 class="mb-3">
                <i class="fas fa-shield-alt me-2"></i>Daftar Role
            </h5>
        </div>
        @foreach($adminRoles as $role)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">
                            <span class="badge bg-primary">{{ $role->display_name }}</span>
                        </h6>
                        <p class="card-text small text-muted">{{ $role->description }}</p>
                        <small class="text-secondary">
                            <strong>Pengguna:</strong> {{ $role->users->count() }}
                        </small>
                    </div>
                </div>
            </div>
        @endforeach
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
                <p>Apakah Anda yakin ingin menghapus admin <strong id="adminName"></strong>?</p>
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
let deleteAdminId = null;

function deleteAdmin(adminId, adminName) {
    deleteAdminId = adminId;
    document.getElementById('adminName').textContent = adminName;
    new bootstrap.Modal(document.getElementById('deleteModal')).show();
}

document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
    if (deleteAdminId) {
        fetch(`/admin/admin-management/${deleteAdminId}`, {
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
                    location.reload();
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
    }
});
</script>
@endpush
@endsection
