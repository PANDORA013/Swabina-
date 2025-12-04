@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0">Kebijakan & Pedoman</h5>
                <a href="{{ route('admin.pedoman.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah
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
                            <th>No</th>
                            <th>Judul</th>
                            <th>File PDF</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pedomans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                <a href="{{ asset('assets/file_pdf/' . $item->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                                    <i class="ti ti-download"></i> Download
                                </a>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.pedoman.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                    <form action="{{ route('admin.pedoman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">Belum ada data</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
