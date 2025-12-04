@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card w-100">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title fw-semibold mb-0">Kelola FAQ</h5>
                <a href="{{ route('admin.faq.create') }}" class="btn btn-primary">
                    <i class="ti ti-plus me-1"></i> Tambah FAQ
                </a>
            </div>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">No</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Pertanyaan</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Jawaban</h6></th>
                            <th class="border-bottom-0"><h6 class="fw-semibold mb-0">Aksi</h6></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($faqs as $item)
                        <tr>
                            <td class="border-bottom-0"><h6 class="fw-semibold mb-0">{{ $loop->iteration }}</h6></td>
                            <td class="border-bottom-0">
                                <h6 class="fw-semibold mb-1" style="max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $item->question }}</h6>
                            </td>
                            <td class="border-bottom-0">
                                <p class="mb-0 text-muted" style="max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ Str::limit(strip_tags($item->answer), 60) }}
                                </p>
                            </td>
                            <td class="border-bottom-0">
                                <div class="d-flex align-items-center gap-2">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('admin.faq.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    
                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('admin.faq.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?');">
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
                            <td colspan="4" class="text-center py-5">
                                <img src="{{ asset('admin/images/backgrounds/rocket.png') }}" width="100" class="mb-3" alt="No Data">
                                <h6 class="fw-semibold text-muted">Belum ada data FAQ</h6>
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