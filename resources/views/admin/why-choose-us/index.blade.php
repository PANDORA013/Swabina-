@extends('layouts.app')

@section('page-title', 'Mengapa Memilih Kami')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Mengapa Memilih Kami</li>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <p class="text-muted">Manage konten untuk section "Mengapa Memilih Kami"</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.why-choose-us.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Item Baru
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            @if($items->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="5%">Icon</th>
                                <th width="25%">Judul</th>
                                <th width="35%">Deskripsi</th>
                                <th width="10%">Status</th>
                                <th width="10%">Order</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <i class="bi {{ $item->icon }}" style="font-size: 1.5rem;"></i>
                                    </td>
                                    <td>
                                        <strong>{{ $item->title }}</strong>
                                    </td>
                                    <td>
                                        <small>{{ Str::limit(strip_tags($item->description), 50) }}</small>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $item->status === 'active' ? 'success' : 'danger' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-info">{{ $item->order }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.why-choose-us.edit', $item->id) }}" 
                                           class="btn btn-sm btn-warning" title="Edit" aria-label="Edit item {{ $item->title }}">
                                            <i class="bi bi-pencil" aria-hidden="true"></i>
                                        </a>
                                        <form action="{{ route('admin.why-choose-us.destroy', $item->id) }}" 
                                              method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    onclick="return confirm('Yakin hapus item ini?')" title="Hapus" aria-label="Delete item {{ $item->title }}">
                                                <i class="bi bi-trash" aria-hidden="true"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info text-center py-4">
                    <i class="bi bi-info-circle me-2"></i>
                    <span>Belum ada data. <a href="{{ route('admin.why-choose-us.create') }}">Tambah sekarang</a></span>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
