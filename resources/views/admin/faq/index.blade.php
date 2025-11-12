@extends($layout)

@section('content')
<div class="container mt-4">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Manajemen FAQ</h2>
        </div>
        <div class="col-md-4 text-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#faqModal" id="addFaqBtn">
                <i class="fas fa-plus"></i> Tambah FAQ
            </button>
        </div>
    </div>

    @if($faqs->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="table-light">
                <tr>
                    <th width="5%">No</th>
                    <th width="35%">Pertanyaan</th>
                    <th width="40%">Jawaban</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faqs as $key => $faq)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        <strong>{{ $faq->getPertanyaan('id') }}</strong>
                    </td>
                    <td>
                        <span class="text-muted">{{ Str::limit($faq->getJawaban('id'), 100) }}</span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning editBtn" 
                            data-id="{{ $faq->id }}"
                            data-content="{{ json_encode($faq->content) }}"
                            data-bs-toggle="modal" 
                            data-bs-target="#faqModal">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-danger deleteBtn" data-id="{{ $faq->id }}">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info" role="alert">
        <i class="fas fa-info-circle"></i> Belum ada FAQ. Silakan tambahkan FAQ baru.
    </div>
    @endif
</div>

<!-- Modal for Add/Edit FAQ -->
<div class="modal fade" id="faqModal" tabindex="-1" aria-labelledby="faqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="faqForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="faqModalLabel">Tambah FAQ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id" name="id">
                    
                    <div class="mb-3">
                        <label for="pertanyaan_id" class="form-label">Pertanyaan (Indonesia)</label>
                        <textarea class="form-control" id="pertanyaan_id" name="pertanyaan_id" rows="2" required></textarea>
                        <small class="text-muted">Masukkan pertanyaan dalam bahasa Indonesia</small>
                    </div>

                    <div class="mb-3">
                        <label for="jawaban_id" class="form-label">Jawaban (Indonesia)</label>
                        <textarea class="form-control" id="jawaban_id" name="jawaban_id" rows="4" required></textarea>
                        <small class="text-muted">Masukkan jawaban dalam bahasa Indonesia</small>
                    </div>

                    <div class="mb-3">
                        <label for="pertanyaan_en" class="form-label">Pertanyaan (English)</label>
                        <textarea class="form-control" id="pertanyaan_en" name="pertanyaan_en" rows="2"></textarea>
                        <small class="text-muted">Masukkan pertanyaan dalam bahasa Inggris (opsional)</small>
                    </div>

                    <div class="mb-3">
                        <label for="jawaban_en" class="form-label">Jawaban (English)</label>
                        <textarea class="form-control" id="jawaban_en" name="jawaban_en" rows="4"></textarea>
                        <small class="text-muted">Masukkan jawaban dalam bahasa Inggris (opsional)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let isEditing = false;
    let editId = null;

    // Add FAQ button
    document.getElementById('addFaqBtn').addEventListener('click', function() {
        isEditing = false;
        editId = null;
        document.getElementById('faqForm').reset();
        document.getElementById('faqModalLabel').textContent = 'Tambah FAQ';
        document.getElementById('id').value = '';
    });

    // Edit FAQ buttons
    document.querySelectorAll('.editBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            isEditing = true;
            editId = this.getAttribute('data-id');
            const content = JSON.parse(this.getAttribute('data-content'));

            document.getElementById('faqModalLabel').textContent = 'Edit FAQ';
            document.getElementById('id').value = editId;
            document.getElementById('pertanyaan_id').value = content.id?.pertanyaan || '';
            document.getElementById('jawaban_id').value = content.id?.jawaban || '';
            document.getElementById('pertanyaan_en').value = content.en?.pertanyaan || '';
            document.getElementById('jawaban_en').value = content.en?.jawaban || '';
        });
    });

    // Form submission
    document.getElementById('faqForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        let url = isEditing 
            ? `{{ route('admin.faq.update', '') }}/${editId}`
            : '{{ route('admin.faq.store') }}';

        if (isEditing) {
            formData.append('_method', 'PUT');
        }

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.reload();
                });
            } else {
                throw new Error(data.message || 'Terjadi kesalahan');
            }
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: error.message || 'Terjadi kesalahan saat memproses data',
                timer: 3000,
                showConfirmButton: false
            });
        });
    });

    // Delete FAQ buttons
    document.querySelectorAll('.deleteBtn').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.getAttribute('data-id');

            Swal.fire({
                title: 'Hapus FAQ?',
                text: 'Data yang dihapus tidak dapat dikembalikan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData();
                    formData.append('_method', 'DELETE');

                    fetch(`{{ route('admin.faq.destroy', '') }}/${id}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Dihapus!',
                                text: data.message,
                                timer: 2000,
                                showConfirmButton: false
                            }).then(() => {
                                window.location.reload();
                            });
                        } else {
                            throw new Error(data.message || 'Gagal menghapus FAQ');
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: error.message || 'Terjadi kesalahan saat menghapus',
                            timer: 3000,
                            showConfirmButton: false
                        });
                    });
                }
            });
        });
    });
</script>
@endpush

@endsection
