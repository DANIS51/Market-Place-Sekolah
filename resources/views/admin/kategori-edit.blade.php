@extends('layout.sidbar')
@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Kategori</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </nav>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 fw-bold">Form Edit Kategori</h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('kategori.update', $kategori) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror"
                                   id="nama_kategori" name="nama_kategori"
                                   value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                                   placeholder="Masukkan nama kategori" required>
                            @error('nama_kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-text">
                                Nama kategori harus unik dan tidak boleh sama dengan kategori yang sudah ada.
                            </div>
                        </div>

                        <div class="d-flex justify-content-between pt-3">
                            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-1"></i> Update Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
