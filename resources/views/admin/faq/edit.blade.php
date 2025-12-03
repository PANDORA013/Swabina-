@extends($layout)

@section('page-title', 'Edit FAQ')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.faq.index') }}">FAQ</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit</li>
@endsection

@section('content')
<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4">
                        <i class="bi bi-pencil me-2"></i>Edit FAQ
                    </h5>
                    
                    {{-- Alert Messages --}}
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>
                            <strong>Error!</strong>
                            <ul class="mb-0 ms-3">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Edit Form --}}
                    <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Question --}}
                        <div class="mb-3">
                            <label for="question" class="form-label fw-semibold">Pertanyaan</label>
                            <textarea class="form-control @error('question') is-invalid @enderror" 
                                      id="question" 
                                      name="question" 
                                      rows="2"
                                      placeholder="Masukkan pertanyaan yang sering ditanyakan..."
                                      required>{{ old('question', $faq->question) }}</textarea>
                            <small class="form-text text-muted">Masukkan pertanyaan yang sering ditanyakan oleh pengunjung</small>
                            @error('question')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Answer --}}
                        <div class="mb-3">
                            <label for="answer" class="form-label fw-semibold">Jawaban</label>
                            <textarea class="form-control @error('answer') is-invalid @enderror" 
                                      id="answer" 
                                      name="answer" 
                                      rows="6"
                                      placeholder="Masukkan jawaban yang komprehensif..."
                                      required>{{ old('answer', $faq->answer) }}</textarea>
                            <small class="form-text text-muted">Masukkan jawaban yang jelas dan lengkap</small>
                            @error('answer')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
