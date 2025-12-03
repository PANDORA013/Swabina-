@extends($layout)

@section('page-title', 'Manajemen FAQ')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">FAQ</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h4 class="fw-semibold">
                <i class="bi bi-question-circle"></i> Manajemen FAQ
            </h4>
            <p class="text-muted mb-0">Kelola pertanyaan yang sering ditanyakan (FAQ)</p>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.faq.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Tambah FAQ
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
    @if($faqs->count() > 0)
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;">No</th>
                                <th>Pertanyaan</th>
                                <th>Jawaban</th>
                                <th style="width: 130px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($faqs as $key => $faq)
                            <tr>
                                <td>
                                    <span class="badge bg-secondary">{{ $key + 1 }}</span>
                                </td>
                                <td>
                                    <strong>{{ $faq->question }}</strong>
                                </td>
                                <td>
                                    <span class="text-muted">
                                        {{ Str::limit($faq->answer, 100) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.faq.edit', $faq->id) }}" 
                                           class="btn btn-warning" 
                                           title="Edit FAQ">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.faq.destroy', $faq->id) }}" 
                                              method="POST" 
                                              style="display: inline;" 
                                              onsubmit="return confirm('Yakin ingin menghapus FAQ ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" title="Hapus FAQ">
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
                    <h5 class="alert-heading mb-2">Belum ada FAQ</h5>
                    <p class="mb-0">Silakan <a href="{{ route('admin.faq.create') }}" class="alert-link">tambahkan FAQ baru</a> untuk memulai.</p>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection