@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0">Sekilas Perusahaan</h5>
                <a href="{{ route('admin.sekilas.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah
                </a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th>No</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if($item->image)
                                    <img src="{{ asset('assets/gambar_sekilas/' . $item->image) }}" width="80" class="rounded">
                                @else
                                    <span class="badge bg-light text-dark">No Image</span>
                                @endif
                            </td>
                            <td><h6 class="fw-semibold">{{ $item->title }}</h6></td>
                            <td>{{ Str::limit(strip_tags($item->description), 50) }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.sekilas.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.sekilas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Belum ada data sekilas perusahaan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
