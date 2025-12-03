@extends($layout ?? 'layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>
                <i class="fas fa-lock me-2"></i>Kelola Privilege Admin
            </h2>
            <p class="text-muted">Berikan akses halaman tertentu untuk admin: <strong>{{ $admin->name }}</strong> ({{ $admin->email }})</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.admin-management.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6 class="mb-2"><i class="fas fa-exclamation-circle me-2"></i>Terjadi Kesalahan</h6>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <!-- Main Card -->
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">
                                <i class="fas fa-tasks me-2"></i>Pilih Halaman yang Dapat Diakses
                            </h5>
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-sm btn-outline-primary" id="selectAllBtn">
                                <i class="fas fa-check-double me-1"></i>Pilih Semua
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" id="deselectAllBtn">
                                <i class="fas fa-times me-1"></i>Bersihkan Semua
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form id="privilegeForm" method="POST" action="{{ route('admin.admin-management.update-privileges', $admin) }}">
                        @csrf

                        <!-- Permissions by Module -->
                        <div id="permissionsContainer">
                            @forelse($allPermissions as $module => $permissions)
                                <div class="module-section mb-4 p-3 border rounded">
                                    <!-- Module Header -->
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input module-checkbox" 
                                                       type="checkbox" 
                                                       id="module_{{ $loop->index }}"
                                                       data-module="{{ $module }}">
                                                <label class="form-check-label fw-bold" for="module_{{ $loop->index }}">
                                                    <i class="fas fa-folder-open me-2 text-primary"></i>{{ ucfirst($module) }}
                                                </label>
                                            </div>
                                            <p class="text-muted small ms-4">
                                                Pilih untuk memberikan akses ke semua halaman dalam module ini
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Module Permissions -->
                                    <div class="row ms-2 module-permissions-{{ $loop->index }}">
                                        @foreach($permissions as $permission)
                                            <div class="col-md-6 col-lg-4 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input permission-checkbox module-item-{{ $loop->parent->index }}" 
                                                           type="checkbox" 
                                                           id="perm_{{ $permission->id }}"
                                                           name="permissions[]"
                                                           value="{{ $permission->name }}"
                                                           data-module="{{ $module }}"
                                                           {{ in_array($permission->name, $userPermissions) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="perm_{{ $permission->id }}">
                                                        <i class="fas fa-check-circle text-success me-1"></i>
                                                        {{ $permission->display_name ?? $permission->name }}
                                                    </label>
                                                    @if($permission->description)
                                                        <small class="text-muted d-block ms-4">
                                                            {{ $permission->description }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @empty
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Belum ada permission yang tersedia. Silakan tambahkan permission terlebih dahulu.
                                </div>
                            @endforelse
                        </div>

                        <!-- Summary Section -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <div class="alert alert-light border">
                                    <h6 class="mb-2">
                                        <i class="fas fa-chart-pie me-2"></i>Ringkasan Akses
                                    </h6>
                                    <p class="mb-0">
                                        Total Halaman yang Dapat Diakses: 
                                        <strong>
                                            <span id="selectedCount">{{ count($userPermissions) }}</span> 
                                            dari 
                                            <span id="totalCount">{{ $allPermissions->sum(function($p) { return count($p); }) }}</span>
                                        </strong>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="row mt-4">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary me-2" id="saveBtn">
                                    <i class="fas fa-save me-2"></i>Simpan Privilege
                                </button>
                                <a href="{{ route('admin.admin-management.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times me-2"></i>Batal
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Card -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card bg-light">
                <div class="card-body">
                    <h6 class="card-title">
                        <i class="fas fa-lightbulb me-2 text-warning"></i>Tips & Informasi
                    </h6>
                    <ul class="mb-0 small">
                        <li><strong>Centang Module:</strong> Otomatis memilih semua halaman dalam module tersebut</li>
                        <li><strong>Centang Halaman:</strong> Memberikan akses ke halaman spesifik</li>
                        <li><strong>Admin hanya bisa akses:</strong> Halaman yang sudah dicentang oleh Super Admin</li>
                        <li><strong>Super Admin:</strong> Memiliki akses penuh ke semua halaman tanpa pembatasan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .module-section {
        background-color: #f8f9fa;
        border-color: #dee2e6 !important;
        transition: all 0.3s ease;
    }

    .module-section:hover {
        background-color: #e7f3ff;
        border-color: #0d6efd !important;
    }

    .module-section .form-check-label {
        cursor: pointer;
        user-select: none;
    }

    .permission-checkbox:checked + label {
        color: #0d6efd;
        font-weight: 500;
    }

    .module-checkbox:checked ~ .module-permissions-* input[type="checkbox"] {
        border-color: #0d6efd;
    }

    #selectAllBtn, #deselectAllBtn {
        transition: all 0.2s ease;
    }

    #selectAllBtn:hover, #deselectAllBtn:hover {
        transform: translateY(-2px);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('privilegeForm');
        const selectAllBtn = document.getElementById('selectAllBtn');
        const deselectAllBtn = document.getElementById('deselectAllBtn');
        const moduleCheckboxes = document.querySelectorAll('.module-checkbox');
        const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

        // Select All Button
        selectAllBtn.addEventListener('click', function() {
            permissionCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            moduleCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateSummary();
        });

        // Deselect All Button
        deselectAllBtn.addEventListener('click', function() {
            permissionCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            moduleCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateSummary();
        });

        // Module Checkbox Logic
        moduleCheckboxes.forEach(moduleCheckbox => {
            moduleCheckbox.addEventListener('change', function() {
                const module = this.dataset.module;
                const moduleIndex = Array.from(moduleCheckboxes).indexOf(this);
                const itemCheckboxes = document.querySelectorAll(`.module-item-${moduleIndex}`);

                itemCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateSummary();
            });
        });

        // Permission Checkbox Logic
        permissionCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateSummary);
        });

        // Update Summary
        function updateSummary() {
            const selectedCount = document.querySelectorAll('.permission-checkbox:checked').length;
            document.getElementById('selectedCount').textContent = selectedCount;

            // Update module checkbox state
            moduleCheckboxes.forEach((moduleCheckbox, index) => {
                const moduleItems = document.querySelectorAll(`.module-item-${index}`);
                const checkedItems = document.querySelectorAll(`.module-item-${index}:checked`);

                if (checkedItems.length === moduleItems.length) {
                    moduleCheckbox.checked = true;
                    moduleCheckbox.indeterminate = false;
                } else if (checkedItems.length > 0) {
                    moduleCheckbox.indeterminate = true;
                } else {
                    moduleCheckbox.checked = false;
                    moduleCheckbox.indeterminate = false;
                }
            });
        }

        // Form Submission
        form.addEventListener('submit', function(e) {
            const button = document.getElementById('saveBtn');
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Menyimpan...';
        });

        // Initial Summary Update
        updateSummary();
    });
</script>
@endsection
