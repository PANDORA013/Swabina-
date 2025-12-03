@extends($layout)

@section('page-title', 'Mengapa Memilih Kami')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Mengapa Memilih Kami</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <p class="text-muted">Manage konten untuk section "Mengapa Memilih Kami"</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.why-choose-us.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Tambah Item Baru
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

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th style="width: 20%">Judul</th>
                        <th style="width: 35%">Deskripsi</th>
                        <th style="width: 10%">Icon</th>
                        <th style="width: 10%">Status</th>
                        <th style="width: 10%">Order</th>
                        <th style="width: 10%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if($items->count() > 0)
                        @foreach($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <strong>{{ $item->title }}</strong>
                            </td>
                            <td>
                                <small class="text-muted">{{ Str::limit(strip_tags($item->description), 80) }}</small>
                            </td>
                            <td>
                                @if($item->icon)
                                    <img src="{{ asset('storage/' . $item->icon) }}" 
                                         alt="{{ $item->title }}" 
                                         style="max-height: 50px; max-width: 50px; object-fit: contain;" />
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-{{ $item->status === 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ $item->order ?? '0' }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="{{ route('admin.why-choose-us.edit', $item->id) }}" 
                                       class="btn btn-warning" 
                                       title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.why-choose-us.destroy', $item->id) }}" 
                                          method="POST" 
                                          style="display:inline;" 
                                          onsubmit="return confirm('Yakin ingin menghapus item ini?');">
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
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    @if($items->count() === 0)
    <div class="alert alert-info mt-3" role="alert">
        <i class="bi bi-info-circle me-2"></i>
        Belum ada data. <a href="{{ route('admin.why-choose-us.create') }}">Tambah item sekarang</a>
    </div>
    @endif
</div>

@endsection
</div>
@endsection
