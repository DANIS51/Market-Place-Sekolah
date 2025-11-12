@extends('layout.sidbar')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <!-- Card utama -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <!-- Header -->
                <div class="card-header bg-white border-0 border-bottom py-3 rounded-top-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-semibold text-dark">
                            <i class="bi bi-shop me-2 text-muted"></i> Daftar Toko
                        </h5>
                        <a href="{{ route('toko.create') }}" class="btn btn-success btn-sm fw-semibold shadow-sm px-3">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Toko Baru
                        </a>
                    </div>
                </div>

                <!-- Body -->
                <div class="card-body bg-light">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center rounded-3 shadow-sm" role="alert">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <div>{{ session('success') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center rounded-3 shadow-sm" role="alert">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                            <div>{{ session('error') }}</div>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Tabel -->
                    <div class="table-responsive rounded-3 overflow-hidden shadow-sm">
                        <table class="table align-middle mb-0">
                            <thead class="table-header text-secondary">
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
                            <tbody class="bg-white">
                                @forelse ($tokos as $toko)
                                <tr class="table-row-hover">
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        @if($toko->gambar)
                                            <img src="{{ asset($toko->gambar) }}" alt="Gambar Toko" class="rounded-3 border" style="width: 50px; height: 50px; object-fit: cover;">
                                        @else
                                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center border" style="width: 50px; height: 50px;">
                                                <i class="bi bi-shop text-muted fs-5"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="fw-medium">{{ $toko->nama_toko }}</td>
                                    <td>{{ $toko->user->nama ?? 'N/A' }}</td>
                                    <td>{{ $toko->kontak_toko }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-light text-dark border px-3 py-2">
                                            {{ $toko->produks_count }} Produk
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <form action="{{ route('toko.destroy', $toko) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus toko ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-sm btn-outline-secondary action-btn" title="Lihat Detail" onclick="window.location='{{ route('toko.show', $toko) }}'">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-warning action-btn" title="Edit Toko" onclick="window.location='{{ route('toko.edit', $toko) }}'">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger action-btn" title="Hapus Toko">
                                                        <i class="bi bi-trash3"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center py-5 text-muted">
                                        <i class="bi bi-shop-window fs-1 d-block mb-2"></i>
                                        <h6 class="fw-semibold mb-0">Belum ada toko</h6>
                                        <small>Silakan tambahkan toko baru.</small>
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
    .table-header {
        background: rgba(245, 245, 245, 0.8);
        backdrop-filter: blur(4px);
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        border-bottom: 2px solid #e6e6e6;
    }

    .table-row-hover:hover {
        background-color: #f9f9f9 !important;
        transition: all 0.2s ease;
    }

    .table td, .table th {
        padding: 1rem;
        vertical-align: middle;
        border-color: #f0f0f0 !important;
    }

    /* ======= Tombol & ikon ======= */
    .btn {
        border-radius: 8px !important;
        transition: all 0.15s ease-in-out;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 6px rgba(0,0,0,0.08);
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

    .card {
        background-color: #ffffff;
    }

    .fw-medium {
        font-weight: 500;
    }
</style>
@endpush
@endsection
