@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Sekilas Perusahaan</h5>
            <form action="{{ route('admin.sekilas.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Judul</label>
                    <input type="text" name="title" class="form-control" value="{{ $item->title }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" rows="5" required>{{ $item->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    @if($item->image)
                        <div class="mb-2"><img src="{{ asset('assets/gambar_sekilas/'.$item->image) }}" width="100"></div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.sekilas.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
