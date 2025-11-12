@extends('layout.sidbar')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold text-dark">
                        <i class="bi bi-pencil-square me-2 text-muted"></i> Edit Pengguna
                    </h5>
                    <a href="{{ route('users') }}" class="btn btn-sm btn-outline-secondary action-btn" title="Kembali">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>

                <div class="card-body bg-light">
                    <form action="{{ route('users.update', $user) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                       id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('kontak') is-invalid @enderror"
                                       id="kontak" name="kontak" value="{{ old('kontak', $user->kontak) }}" required>
                                @error('kontak')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                       id="username" name="username" value="{{ old('username', $user->username) }}" required>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                       id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="member" {{ old('role', $user->role) == 'member' ? 'selected' : '' }}>Member</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <a href="{{ route('users') }}" class="btn btn-outline-secondary px-4 py-2 rounded-3 fw-semibold">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-success px-4 py-2 rounded-3 fw-semibold">
                                <i class="bi bi-check-circle me-1"></i> Update
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
        border-radius: 16px;
    }

    .btn {
        border-radius: 8px !important;
        transition: all 0.15s ease-in-out;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.08);
    }

    .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
    }

    .action-btn i {
        font-size: 15px;
        line-height: 1;
    }

    label.form-label {
        font-weight: 500;
    }

    input.form-control, select.form-select {
        border-radius: 10px;
        padding: 0.6rem 0.8rem;
        border: 1px solid #e5e5e5;
    }

    input.form-control:focus, select.form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.1rem rgba(13, 110, 253, 0.1);
    }
</style>
@endpush
@endsection
