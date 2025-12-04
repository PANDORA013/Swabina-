@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0">Kelola Admin</h5>
                <a href="{{ route('admin.admin-management.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah Admin
                </a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
             @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <h6 class="fw-semibold mb-1">{{ $admin->name }}</h6>
                                </div>
                            </td>
                            <td>{{ $admin->email }}</td>
                            <td>
                                <span class="badge bg-{{ $admin->role == 'superadmin' ? 'primary' : 'secondary' }}">
                                    {{ $admin->role }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.admin-management.edit', $admin->id) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i> Edit
                                    </a>
                                    @if(auth()->id() != $admin->id)
                                    <form action="{{ route('admin.admin-management.destroy', $admin->id) }}" method="POST" onsubmit="return confirm('Hapus admin ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="ti ti-trash"></i> Hapus
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">Tidak ada data admin</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection