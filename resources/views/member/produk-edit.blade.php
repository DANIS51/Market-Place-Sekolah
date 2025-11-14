@extends('layout.sidbar')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Produk</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('produk.update', $produk) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_produk" class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name="nama_produk" value="{{ old('nama_produk', $produk->nama_produk) }}" required>
                                @error('nama_produk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="harga" class="form-label">Harga <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $produk->harga) }}" required>
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select class="form-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_id', $produk->kategori_id) == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_upload" class="form-label">Tanggal Upload <span class="text-danger">*</span></label>
                            <input type="date" class="form-control @error('tanggal_upload') is-invalid @enderror" id="tanggal_upload" name="tanggal_upload" value="{{ old('tanggal_upload', $produk->tanggal_upload) }}" required>
                            @error('tanggal_upload')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4" required>{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar Produk Saat Ini</label>
                            <div class="row" id="existing-images">
                                @forelse($produk->gambarProduks as $gambar)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('storage/images/produk/' . $gambar->nama_gambar) }}" class="card-img-top" alt="Gambar Produk" style="height: 150px; object-fit: cover;">
                                        <div class="card-body p-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $gambar->id }}" id="delete_{{ $gambar->id }}">
                                                <label class="form-check-label" for="delete_{{ $gambar->id }}">
                                                    Hapus
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="col-12">
                                    <p class="text-muted">Belum ada gambar untuk produk ini.</p>
                                </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="gambar_produk" class="form-label">Tambah Gambar Baru</label>
                            <input type="file" class="form-control @error('gambar_produk') is-invalid @enderror" id="gambar_produk" name="gambar_produk[]" multiple accept="image/*">
                            <div class="form-text">Pilih satu atau lebih gambar baru (JPEG, PNG, JPG, GIF). Maksimal 2MB per gambar.</div>
                            @error('gambar_produk')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            @error('gambar_produk.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
