@extends('layout.sidbar')
@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Toko</h1>
        <a href="{{ route('toko.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 fw-bold">Form Edit Toko</h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('toko.update', $toko) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama_toko" class="form-label fw-semibold">Nama Toko <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="nama_toko" name="nama_toko" value="{{ old('nama_toko', $toko->nama_toko) }}" placeholder="Masukkan nama toko" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="user_id" class="form-label fw-semibold">Pemilik Toko <span class="text-danger">*</span></label>
                                <select class="form-select" id="user_id" name="user_id" required>
                                    <option value="">Pilih Pemilik</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ old('user_id', $toko->user_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->nama }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="kontak_toko" class="form-label fw-semibold">Kontak Toko <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="kontak_toko" name="kontak_toko" value="{{ old('kontak_toko', $toko->kontak_toko) }}" placeholder="Masukkan nomor telepon atau email" required>
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label fw-semibold">Alamat Toko <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap toko" required>{{ old('alamat', $toko->alamat) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi Toko</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" placeholder="Masukkan deskripsi toko (opsional)">{{ old('deskripsi', $toko->deskripsi) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="gambar" class="form-label fw-semibold">Gambar Toko</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                            <div class="form-text">
                                Format yang didukung: JPG, PNG, GIF. Maksimal 2MB. Biarkan kosong jika tidak ingin mengubah gambar.
                            </div>
                            @if($toko->gambar)
                                <div class="mt-2">
                                    <small class="text-muted">Gambar saat ini:</small><br>
                                    <img src="{{ asset($toko->gambar) }}" alt="Gambar Toko" class="img-thumbnail mt-1" style="max-width: 200px; max-height: 200px;">
                                </div>
                            @endif
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('toko.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update Toko</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
