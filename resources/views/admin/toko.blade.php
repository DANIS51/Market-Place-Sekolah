@extends('layout.sidbar')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Card utama -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <!-- Header dengan gradien -->
                <div class="card-header bg-gradient text-white border-0 py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-1 fw-bold">
                                <i class="bi bi-shop-fill me-2"></i> Daftar Toko
                            </h5>
                            <p class="mb-0 opacity-75 small">Kelola semua toko di marketplace</p>
                        </div>
                        <a href="{{ route('toko.create') }}" class="btn btn-light btn-sm fw-semibold shadow px-3">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Toko Baru
                        </a>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body bg-light p-0">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center border-0 shadow-sm mx-4 mt-4" role="alert">
                            <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                            </div>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center border-0 shadow-sm mx-4 mt-4" role="alert">
                            <div class="bg-danger bg-opacity-10 rounded-circle p-2 me-3">
                                <i class="bi bi-exclamation-triangle-fill text-danger fs-5"></i>
                            </div>
                            <div>{{ session('error') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Tabel dengan desain modern -->
                    <div class="table-responsive p-4">
                        <table class="table align-middle mb-0">
                            <thead class="table-header">
                                <tr>
                                    <th class="text-center py-3" style="width: 60px;">No</th>
                                    <th>Gambar</th>
                                    <th>Nama Toko</th>
                                    <th>Pemilik</th>
                                    <th>Kontak</th>
                                    <th>Jumlah Produk</th>
                                    <th class="text-center" style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tokos as $toko)
                                <tr class="table-row-hover">
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        @if($toko->gambar)
                                            <div class="position-relative">
                                                <img src="{{ asset($toko->gambar) }}" alt="Gambar Toko" class="rounded-3 border shadow-sm" style="width: 60px; height: 60px; object-fit: cover;">
                                                <div class="position-absolute top-0 start-0 bg-success rounded-circle" style="width: 12px; height: 12px; margin: 5px;"></div>
                                            </div>
                                        @else
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center border shadow-sm" style="width: 60px; height: 60px;">
                                                <i class="bi bi-shop text-muted fs-4"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-medium">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 36px; height: 36px;">
                                                <i class="bi bi-shop text-primary"></i>
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $toko->nama_toko }}</div>
                                                <small class="text-muted">ID: {{ $toko->id }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                                <i class="bi bi-person text-secondary"></i>
                                            </div>
                                            <span>{{ $toko->user->nama ?? 'N/A' }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-telephone-fill text-muted me-2"></i>
                                            <span>{{ $toko->kontak_toko }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill bg-primary text-white px-3 py-2 d-inline-flex align-items-center">
                                            <i class="bi bi-box-seam me-1"></i> {{ $toko->produks_count }} Produk
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-primary action-btn" title="Lihat Detail" onclick="window.location='{{ route('toko.show', $toko) }}'">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-outline-warning action-btn" title="Edit Toko" onclick="window.location='{{ route('toko.edit', $toko) }}'">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <form action="{{ route('toko.destroy', $toko) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus toko ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger action-btn" title="Hapus Toko">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <div class="py-4">
                                            <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                                <i class="bi bi-shop-window fs-1 text-muted"></i>
                                            </div>
                                            <h6 class="fw-semibold mb-2">Belum ada toko</h6>
                                            <p class="mb-3">Silakan tambahkan toko baru untuk memulai.</p>
                                            <a href="{{ route('toko.create') }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-plus-circle me-1"></i> Tambah Toko Baru
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* ======= Gaya tabel modern ======= */
    .bg-gradient {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
    }

    .table-header {
        background: rgba(245, 245, 245, 0.8);
        backdrop-filter: blur(4px);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e6e6e6;
    }

    .table-row-hover {
        transition: all 0.2s ease;
        border-bottom: 1px solid #f0f0f0;
    }

    .table-row-hover:hover {
        background-color: #f9f9f9 !important;
        transform: translateX(2px);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .table td, .table th {
        padding: 1rem;
        vertical-align: middle;
        border: none;
    }

    .table tbody tr:last-child {
        border-bottom: none;
    }

    /* ======= Tombol & ikon ======= */
    .btn {
        border-radius: 8px !important;
        transition: all 0.2s ease-in-out;
        font-weight: 500;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .action-btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        border-radius: 8px;
    }

    .action-btn i {
        font-size: 16px;
        line-height: 1;
    }

    .action-btn:hover {
        transform: translateY(-2px);
    }

    .btn-outline-primary:hover {
        background-color: #6366f1;
        border-color: #6366f1;
    }

    .btn-outline-warning:hover {
        background-color: #f59e0b;
        border-color: #f59e0b;
    }

    .btn-outline-danger:hover {
        background-color: #ef4444;
        border-color: #ef4444;
    }

    /* ======= Badge style ======= */
    .badge {
        font-weight: 500;
        font-size: 0.75rem;
    }

    /* ======= Card style ======= */
    .card {
        background-color: #ffffff;
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
    }

    /* ======= Alert style ======= */
    .alert {
        border-left: 4px solid;
    }

    .alert-success {
        border-left-color: #10b981;
    }

    .alert-danger {
        border-left-color: #ef4444;
    }

    /* ======= Image/placeholder style ======= */
    .rounded-3 {
        border-radius: 0.75rem !important;
    }

    /* ======= Icon circle style ======= */
    .icon-circle {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush
@endsection
