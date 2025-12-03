@extends($layout)

@section('page-title', 'Manajemen Sertifikat & Penghargaan')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Sertifikat</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <p class="text-muted">Kelola sertifikat dan penghargaan perusahaan</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.sertifikat.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Sertifikat
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle me-2"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($sertifikats->count() > 0)
    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 25%">Nama Sertifikat</th>
                        <th style="width: 40%">Deskripsi</th>
                        <th style="width: 20%">Gambar</th>
                        <th style="width: 10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sertifikats as $index => $sertifikat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $sertifikat->nama ?? 'N/A' }}</strong>
                        </td>
                        <td>
                            <small class="text-muted">{{ Str::limit($sertifikat->deskripsi ?? '-', 100) }}</small>
                        </td>
                        <td>
                            @if($sertifikat->image)
                                <img src="{{ asset('storage/' . $sertifikat->image) }}" 
                                     alt="{{ $sertifikat->nama }}" 
                                     style="max-height: 50px; max-width: 50px; object-fit: cover; border-radius: 4px;" />
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('admin.sertifikat.edit', $sertifikat->id) }}" 
                                   class="btn btn-warning" 
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.sertifikat.destroy', $sertifikat->id) }}" 
                                      method="POST" 
                                      style="display:inline;" 
                                      onsubmit="return confirm('Yakin ingin menghapus sertifikat ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Hapus">
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
    @else
    <div class="alert alert-info" role="alert">
        <i class="bi bi-info-circle me-2"></i>
        Belum ada sertifikat. Silakan tambahkan sertifikat baru dengan klik tombol "Tambah Sertifikat".
    </div>
    @endif
</div>

@endsection
