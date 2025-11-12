@extends('layout.sidbar')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold text-dark">
                        <i class="bi bi-person-lines-fill me-2 text-muted"></i> Detail Pengguna
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-outline-warning action-btn" title="Edit Pengguna">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="{{ route('users') }}" class="btn btn-sm btn-outline-secondary action-btn" title="Kembali">
                            <i class="bi bi-arrow-left"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body bg-light">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-4 mb-md-0">
                            <img src="https://i.pravatar.cc/150?img={{ $user->id % 10 + 1 }}"
                                 alt="Avatar"
                                 class="rounded-circle border shadow-sm mb-3"
                                 style="width: 120px; height: 120px; object-fit: cover;">
                            <h6 class="fw-semibold mb-0">{{ $user->nama }}</h6>
                            <p class="text-muted small mb-0">{{ ucfirst($user->role) }}</p>
                        </div>

                        <div class="col-md-8">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    <tr>
                                        <th width="180" class="text-secondary fw-medium">ID Pengguna</th>
                                        <td class="fw-semibold text-dark">{{ $user->id }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-secondary fw-medium">Nama</th>
                                        <td>{{ $user->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-secondary fw-medium">Kontak</th>
                                        <td>{{ $user->kontak }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-secondary fw-medium">Username</th>
                                        <td>{{ $user->username }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-secondary fw-medium">Role</th>
                                        <td>
                                            <span class="badge bg-{{ $user->role == 'admin' ? 'primary' : 'secondary' }}">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-secondary fw-medium">Dibuat</th>
                                        <td>{{ $user->created_at->format('d M Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="text-secondary fw-medium">Diperbarui</th>
                                        <td>{{ $user->updated_at->format('d M Y H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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

    .table th {
        width: 180px;
        font-size: 0.9rem;
        text-transform: capitalize;
        padding: 0.6rem 0.5rem;
    }

    .table td {
        font-size: 0.9rem;
        padding: 0.6rem 0.5rem;
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
</style>
@endpush
@endsection
