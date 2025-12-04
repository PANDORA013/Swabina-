@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Edit Sertifikat</h5>
            <form action="{{ route('admin.sertifikat.update', $sertifikat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Sertifikat</label>
                    <input type="text" name="title" class="form-control" value="{{ $sertifikat->title }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Gambar</label>
                    @if($sertifikat->image)
                        <div class="mb-2"><img src="{{ asset('assets/gambar_sertifikat/'.$sertifikat->image) }}" width="100"></div>
                    @endif
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.sertifikat.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
