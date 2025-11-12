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
                            <i class="bi bi-box-seam me-2 text-muted"></i> Daftar Produk
                        </h5>
                        <a href="{{ route('produk.create') }}" class="btn btn-success btn-sm fw-semibold shadow-sm px-3">
                            <i class="bi bi-plus-circle me-1"></i> Tambah Produk
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

                    <!-- Filter -->
                    <form action="{{ route('produk.index') }}" method="GET" class="row g-3 mb-4">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search"></i></span>
                                <input type="text" name="search" class="form-control border-start-0" placeholder="Cari produk..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <select name="kategori" class="form-select">
                                <option value="">Semua Kategori</option>
                                <!-- Loop kategori -->
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select name="toko" class="form-select">
                                <option value="">Semua Toko</option>
                                <!-- Loop toko -->
                            </select>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-secondary w-100"><i class="bi bi-funnel"></i></button>
                        </div>
                    </form>

                    <!-- Tabel -->
                    <div class="table-responsive rounded-3 overflow-hidden shadow-sm">
                        <table class="table align-middle mb-0">
                            <thead class="table-header text-secondary">
                                <tr>
                                    <th class="text-center py-3" style="width: 60px;">No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Kategori</th>
                                    <th>Toko</th>
                                    <th>Gambar</th>
                                    <th>Tanggal Upload</th>
                                    <th class="text-center" style="width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @forelse ($produks as $produk)
                                <tr class="table-row-hover">
                                    <td class="text-center fw-semibold text-muted">{{ $loop->iteration }}</td>
                                    <td class="fw-medium">{{ $produk->nama_produk }}</td>
                                    <td class="text-success fw-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    <td>{{ $produk->kategori->nama_kategori ?? '-' }}</td>
                                    <td>{{ $produk->toko->nama_toko ?? '-' }}</td>
                                    <td>
                                        @if($produk->gambarProduks && $produk->gambarProduks->count() > 0)
                                            <div class="d-flex align-items-center">
                                                <img src="{{ asset('storage/images/produk/' . $produk->gambarProduks->first()->nama_gambar) }}" alt="Gambar Produk" class="rounded border me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                                <small class="text-muted">{{ $produk->gambarProduks->count() }} gambar</small>
                                            </div>
                                        @else
                                            <small class="text-muted text-secondary">
                                                <i class="bi bi-image"></i> Tidak ada gambar
                                            </small>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ \Carbon\Carbon::parse($produk->tanggal_upload)->format('d M Y') }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('produk.show', $produk->id) }}" class="btn btn-icon btn-view" title="Lihat Produk">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-icon btn-edit" title="Edit Produk">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-icon btn-delete" title="Hapus Produk">
                                                    <i class="bi bi-trash3"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        <h6 class="fw-semibold mb-0">Belum ada produk</h6>
                                        <small>Tambahkan produk pertama Anda.</small>
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

    .fw-medium {
        font-weight: 500;
    }

    .card {
        background-color: #ffffff;
    }

    img {
        transition: all 0.3s ease;
    }

    img:hover {
        transform: scale(1.05);
    }

    /* ======= Tombol aksi disamakan ======= */
    .btn-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        transition: all 0.2s ease;
        border: none;
    }

    .btn-icon:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.12);
    }

    .btn-view {
        background-color: rgba(13, 110, 253, 0.1);
        color: #0d6efd;
    }

    .btn-view:hover {
        background-color: #0d6efd;
        color: white;
    }

    .btn-edit {
        background-color: rgba(255, 193, 7, 0.15);
        color: #ffc107;
    }

    .btn-edit:hover {
        background-color: #ffc107;
        color: white;
    }

    .btn-delete {
        background-color: rgba(220, 53, 69, 0.15);
        color: #dc3545;
    }

    .btn-delete:hover {
        background-color: #dc3545;
        color: white;
    }
</style>
@endpush
@endsection
