@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Pedoman</h5>
            <form action="{{ route('admin.pedoman.update', $pedoman->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ $pedoman->title }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">File PDF (Kosongkan jika tidak ubah)</label>
                    @if($pedoman->file_path)
                        <div class="mb-2">
                            <a href="{{ asset('assets/file_pdf/' . $pedoman->file_path) }}" target="_blank">Lihat File Saat Ini</a>
                        </div>
                    @endif
                    <input type="file" name="file_pdf" class="form-control" accept=".pdf">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.pedoman.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection