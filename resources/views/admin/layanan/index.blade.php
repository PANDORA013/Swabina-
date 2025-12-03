@extends($layout)

@section('page-title', 'Manajemen Halaman Layanan')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Halaman Layanan</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-12">
            <p class="text-muted">Kelola konten halaman layanan yang tampil di website public</p>
        </div>
    </div>

    <div class="row g-4">
        @foreach($layanan as $item)
        <div class="col-md-6 col-lg-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <i class="bi {{ $item->icon ?? 'bi-briefcase' }} fs-1 text-primary"></i>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" 
                                   id="status-{{ $item->id }}" 
                                   {{ $item->is_active ? 'checked' : '' }}
                                   onchange="updateStatus('{{ $item->slug }}', this.checked)">
                            <label class="form-check-label small" for="status-{{ $item->id }}">
                                {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                            </label>
                        </div>
                    </div>
                    
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="card-text text-muted small">{{ Str::limit($item->subtitle, 80) }}</p>
                    
                    <div class="mt-3">
                        <a href="{{ route('admin.layanan.edit', $item->slug) }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-edit me-1"></i> Edit Konten
                        </a>
                        <a href="{{ route(strtolower(str_replace(' ', '-', $item->slug))) }}" 
                           class="btn btn-sm btn-outline-secondary" 
                           target="_blank">
                            <i class="fas fa-external-link-alt me-1"></i> Lihat
                        </a>
                    </div>
                </div>
                
                @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" 
                     class="card-img-bottom" 
                     style="height: 150px; object-fit: cover;" 
                     alt="{{ $item->title }}">
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
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
