@extends('layout.sidbar')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <!-- Header -->
                <div class="card-header bg-white border-0 border-bottom py-3 rounded-top-4">
                    <h5 class="fw-semibold mb-0 text-dark">
                        <i class="bi bi-box-seam me-2 text-muted"></i> Tambah Produk Baru
                    </h5>
                </div>

                <!-- Body -->
                <div class="card-body bg-light">
                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_produk" class="form-label fw-medium">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-3 @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" value="{{ old('nama_produk') }}" required>
                                @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="harga" class="form-label fw-medium">Harga <span class="text-danger">*</span></label>
                                <input type="number" class="form-control rounded-3 @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}" required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="kategori_id" class="form-label fw-medium">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select rounded-3 @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($kategoris as $kategori)
                                        <option value="{{ $kategori->id }}" {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                                            {{ $kategori->nama_kategori }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="toko_id" class="form-label fw-medium">Toko <span class="text-danger">*</span></label>
                                <select class="form-select rounded-3 @error('toko_id') is-invalid @enderror" id="toko_id" name="toko_id" required>
                                    <option value="">Pilih Toko</option>
                                    @foreach($tokos as $toko)
                                        <option value="{{ $toko->id }}" {{ old('toko_id') == $toko->id ? 'selected' : '' }}>
                                            {{ $toko->nama_toko }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('toko_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_upload" class="form-label fw-medium">Tanggal Upload <span class="text-danger">*</span></label>
                            <input type="date" class="form-control rounded-3 @error('tanggal_upload') is-invalid @enderror" id="tanggal_upload" name="tanggal_upload" value="{{ old('tanggal_upload') }}" required>
                            @error('tanggal_upload')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-medium">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control rounded-3 @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="gambar_produk" class="form-label fw-medium">Gambar Produk</label>
                            <input type="file" class="form-control rounded-3 @error('gambar_produk') is-invalid @enderror" id="gambar_produk" name="gambar_produk[]" multiple accept="image/*">
                            <div class="form-text text-muted">Pilih satu atau lebih gambar (JPEG, PNG, JPG, GIF). Maksimal 2MB per gambar.</div>
                            @error('gambar_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('gambar_produk.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('produk.index') }}" class="btn btn-outline-secondary rounded-3 px-4 py-2">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success rounded-3 px-4 py-2">
                                <i class="bi bi-check-circle me-1"></i> Simpan Produk
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        background-color: #ffffff;
        border-radius: 1rem;
    }

    .form-label {
        color: #333;
        font-size: 0.95rem;
    }

    .form-control,
    .form-select {
        border-color: #e0e0e0;
        box-shadow: none !important;
        transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #b5b5b5;
        background-color: #fcfcfc;
    }

    .btn {
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 6px rgba(0,0,0,0.08);
    }

    .btn-success {
        background-color: #28a745 !important;
        border: none;
    }

    .btn-outline-secondary {
        border-color: #ccc;
        color: #444;
    }

    .btn-outline-secondary:hover {
        background-color: #f2f2f2;
    }
</style>
@endpush
@endsection
