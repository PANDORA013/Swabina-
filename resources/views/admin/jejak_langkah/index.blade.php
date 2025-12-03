@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card w-100 position-relative overflow-hidden">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0">Jejak Langkah Perusahaan</h5>
                <a href="{{ route('admin.jejak.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah Data
                </a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">No</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Tahun</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Gambar</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Deskripsi</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jejakLangkahs as $item)
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6></td>
                            <td class="border-bottom-0"><span class="badge bg-primary rounded-3 fw-semibold">{{ $item->tahun }}</span></td>
                            <td class="border-bottom-0">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" width="80" class="rounded" alt="Jejak {{ $item->tahun }}">
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 fw-normal text-muted" style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ Str::limit($item->deskripsi, 60) }}
                                </p>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    <a href="{{ route('admin.jejak.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i> Edit
                                    </a>
                                    
                                    {{-- Form Delete --}}
                                    <form action="{{ route('admin.jejak.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin hapus jejak langkah tahun {{ $item->tahun }}?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="ti ti-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <h6 class="fw-semibold text-muted">Belum ada data jejak langkah</h6>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
