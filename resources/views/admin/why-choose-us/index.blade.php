@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0">Mengapa Memilih Kami</h5>
                <a href="{{ route('admin.why-choose-us.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah Item
                </a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th><h6 class="fw-semibold mb-0">No</h6></th>
                            <th><h6 class="fw-semibold mb-0">Icon</h6></th>
                            <th><h6 class="fw-semibold mb-0">Judul</h6></th>
                            <th><h6 class="fw-semibold mb-0">Deskripsi</h6></th>
                            <th><h6 class="fw-semibold mb-0">Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->icon)
                                    <img src="{{ asset('assets/icons/' . $item->icon) }}" width="40" alt="Icon">
                                @else - @endif
                            </td>
                            <td><h6 class="fw-semibold">{{ $item->title }}</h6></td>
                            <td><p class="text-muted mb-0">{{ Str::limit($item->description, 50) }}</p></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('admin.why-choose-us.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                    <form action="{{ route('admin.why-choose-us.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus item ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
