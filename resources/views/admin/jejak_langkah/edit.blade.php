@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Jejak Langkah</h5>
            {{-- Perhatikan parameter route, harus sesuai dengan parameter resource --}}
            <form action="{{ route('admin.jejak.update', $jejakLangkah->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Tahun</label>
                    <input type="number" name="year" class="form-control" value="{{ $jejakLangkah->year }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar (Kosongkan jika tidak ubah)</label>
                    @if($jejakLangkah->image)
                        <div class="mb-2"><img src="{{ asset('assets/gambar_jejak/'.$jejakLangkah->image) }}" width="100"></div>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3" required>{{ $jejakLangkah->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.jejak.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
