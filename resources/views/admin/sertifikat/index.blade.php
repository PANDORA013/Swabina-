@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card w-100 position-relative overflow-hidden">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0">Sertifikat & Penghargaan</h5>
                <a href="{{ route('admin.sertifikat.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah
                </a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                @forelse($sertifikats as $item)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="position-relative">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top p-3" alt="Sertifikat" style="height: 200px; object-fit: contain;">
                            @else
                                <div class="d-flex align-items-center justify-content-center bg-light" style="height: 200px;">
                                    <span class="text-muted">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-3">
                            <h6 class="card-title fw-semibold mb-1 text-center">{{ $item->nama ?? 'Sertifikat' }}</h6>
                            <div class="d-flex justify-content-center gap-2 mt-3">
                                <a href="{{ route('admin.sertifikat.edit', $item->id) }}" class="btn btn-warning btn-sm w-100">
                                    <i class="ti ti-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.sertifikat.destroy', $item->id) }}" method="POST" class="w-100" onsubmit="return confirm('Hapus sertifikat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100">
                                        <i class="ti ti-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5">
                    <h6 class="fw-semibold text-muted">Belum ada sertifikat</h6>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
</div>

@endsection
