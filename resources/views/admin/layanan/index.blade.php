@extends($layout)

@section('page-title', 'Manajemen Halaman Layanan')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Halaman Layanan</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <h4 class="fw-semibold">
                <i class="bi bi-briefcase"></i> Manajemen Halaman Layanan
            </h4>
            <p class="text-muted mb-0">Kelola konten halaman layanan yang tampil di website public</p>
        </div>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            <strong>Sukses!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle me-2"></i>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row g-4">
        @foreach($layanan as $item)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm border-0">
                @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" 
                     class="card-img-top" 
                     style="height: 150px; object-fit: cover;" 
                     alt="{{ $item->title }}">
                @else
                <div style="height: 150px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center;">
                    <i class="bi {{ $item->icon ?? 'bi-briefcase' }} fs-2 text-white"></i>
                </div>
                @endif
                
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <h5 class="card-title mb-2">{{ $item->title }}</h5>
                            <p class="card-text text-muted small mb-0">{{ Str::limit($item->subtitle, 60) }}</p>
                        </div>
                    </div>
                    
                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('admin.layanan.edit', $item->slug) }}" 
                           class="btn btn-sm btn-primary flex-grow-1">
                            <i class="bi bi-pencil me-1"></i> Edit
                        </a>
                        <form action="{{ route('admin.layanan.destroy', $item->slug) }}" 
                              method="POST" 
                              style="display: inline;" 
                              onsubmit="return confirm('Yakin ingin menghapus layanan ini?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus layanan">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>

                    <div class="form-check form-switch mt-3 pt-3 border-top">
                        <input class="form-check-input" type="checkbox" 
                               id="status-{{ $item->id }}" 
                               {{ $item->is_active ? 'checked' : '' }}
                               onchange="updateStatus('{{ $item->slug }}', this.checked)">
                        <label class="form-check-label small" for="status-{{ $item->id }}">
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </label>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    @if($layanan->count() === 0)
        <div class="alert alert-info border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <h5 class="alert-heading mb-2">Belum ada layanan</h5>
                    <p class="mb-0">Tidak ada data layanan yang tersedia saat ini.</p>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function updateStatus(slug, isActive) {
    fetch(`/admin/layanan/${slug}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ is_active: isActive })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: data.message,
                timer: 1500,
                showConfirmButton: false
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Terjadi kesalahan saat mengupdate status'
        });
    });
}
</script>
@endpush
@endsection