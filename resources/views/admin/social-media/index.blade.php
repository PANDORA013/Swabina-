@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0">Kelola Media Sosial</h5>
                <a href="{{ route('admin.social-media.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah Link
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
                            <th>Platform</th>
                            <th>Link URL</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($socialLinks as $link)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <span class="badge bg-secondary">{{ $link->platform }}</span>
                            </td>
                            <td><a href="{{ $link->url }}" target="_blank" class="text-truncate d-inline-block" style="max-width: 200px;">{{ $link->url }}</a></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('admin.social-media.edit', $link->id) }}" class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                    <form action="{{ route('admin.social-media.destroy', $link->id) }}" method="POST" onsubmit="return confirm('Hapus link ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="ti ti-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">Belum ada link sosial media</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
