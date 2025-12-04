@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Informasi Perusahaan</h5>
            
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            {{-- Form mengarah ke store --}}
            <form action="{{ route('admin.company-info.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Nama Perusahaan</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $info->name) }}" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Email Resmi</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $info->email) }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nomor Telepon</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $info->phone) }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap</label>
                    <textarea name="address" class="form-control" rows="3" required>{{ old('address', $info->address) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat (Footer/Meta)</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $info->description) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
