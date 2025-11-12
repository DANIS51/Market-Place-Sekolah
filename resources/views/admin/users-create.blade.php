@extends('layout.sidbar')
@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <!-- Header -->
                <div class="card-header bg-white border-0 border-bottom py-3 rounded-top-4">
                    <h5 class="fw-semibold mb-0 text-dark">
                        <i class="bi bi-person-plus me-2 text-muted"></i> Tambah Pengguna Baru
                    </h5>
                </div>

                <!-- Body -->
                <div class="card-body bg-white">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label fw-medium">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-3 @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kontak" class="form-label fw-medium">Kontak <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-3 @error('kontak') is-invalid @enderror" id="kontak" name="kontak" value="{{ old('kontak') }}" required>
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label fw-medium">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control rounded-3 @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label fw-medium">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="role" class="form-label fw-medium">Role <span class="text-danger">*</span></label>
                            <select class="form-select rounded-3 @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="member" {{ old('role') == 'member' ? 'selected' : '' }}>Member</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('users') }}" class="btn btn-outline-dark rounded-3 px-4 py-2">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-dark rounded-3 px-4 py-2">
                                <i class="bi bi-check-circle me-1"></i> Simpan
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
        color: #222;
        font-size: 0.95rem;
    }

    .form-control,
    .form-select {
        border: 1px solid #e4e4e4;
        background-color: #ffffff;
        box-shadow: none !important;
        transition: border-color 0.2s ease, background-color 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #999;
        background-color: #ffffff;
    }

    .btn {
        transition: all 0.2s ease;
        font-weight: 500;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 6px rgba(0,0,0,0.08);
    }

    .btn-dark {
        background-color: #212529 !important;
        border: none;
    }

    .btn-outline-dark {
        border-color: #212529;
        color: #212529;
    }

    .btn-outline-dark:hover {
        background-color: #212529;
        color: #fff;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }
</style>
@endpush
@endsection
