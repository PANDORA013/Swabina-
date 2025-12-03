@extends($layout)

@section('page-title', 'Manajemen Berita')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Berita</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h4 class="fw-semibold">
                <i class="bi bi-newspaper"></i> Manajemen Berita
            </h4>
            <p class="text-muted mb-0">Kelola berita dan artikel perusahaan Anda</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Tambah Berita
            </a>
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

    {{-- Content --}}
    @if($beritas->count() > 0)
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 80px;">Gambar</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th style="width: 120px;">Tanggal</th>
                                <th style="width: 130px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($beritas as $berita)
                            <tr>
                                <td>
                                    @if($berita->image)
                                        <img src="{{ asset('storage/' . $berita->image) }}" 
                                             class="img-thumbnail" 
                                             style="width: 70px; height: 50px; object-fit: cover;" 
                                             alt="Gambar berita: {{ $berita->title }}">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $berita->title }}</strong>
                                </td>
                                <td>
                                    <span class="text-muted">
                                        {{ Str::limit($berita->description, 80) }}
                                    </span>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        {{ $berita->created_at->format('d M Y') }}
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.berita.edit', $berita->id) }}" 
                                           class="btn btn-warning" 
                                           title="Edit berita">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.berita.destroy', $berita->id) }}" 
                                              method="POST" 
                                              style="display: inline;" 
                                              onsubmit="return confirm('Yakin ingin menghapus berita ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Hapus berita">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="alert alert-info border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-info-circle me-3" style="font-size: 1.5rem;"></i>
                <div>
                    <h5 class="alert-heading mb-2">Belum ada berita</h5>
                    <p class="mb-0">Silakan <a href="{{ route('admin.berita.create') }}" class="alert-link">tambahkan berita baru</a> untuk memulai.</p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection