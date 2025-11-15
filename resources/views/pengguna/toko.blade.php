@extends('layout.navbar')

@section('conten-pengguna')
<div class="container py-4">

    <!-- Judul Halaman -->
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold mb-3">Daftar Toko</h1>
        <p class="lead text-muted">Temukan berbagai toko di marketplace sekolah kami</p>
    </div>

    <!-- Filter Section -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('pengguna.toko') }}" class="row g-3">
                <div class="col-md-8">
                    <label for="search" class="form-label fw-semibold">Cari Toko</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nama toko...">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Grid Toko -->
    <div class="row g-4">
        @forelse($tokos as $toko)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden store-card">

                <!-- Header dengan gambar toko -->
                <div class="position-relative store-image-container">
                    @if($toko->gambar)
                        <img src="{{ asset($toko->gambar) }}" class="card-img-top store-image" alt="{{ $toko->nama_toko }}">
                    @else
                        <div class="no-image d-flex align-items-center justify-content-center bg-light">
                            <i class="bi bi-shop text-muted fs-1"></i>
                        </div>
                    @endif

                    <!-- Overlay dengan info singkat -->
                    <div class="store-overlay">
                        <div class="text-center">
                            <h5 class="text-white fw-bold mb-2">{{ $toko->nama_toko }}</h5>
                            <div class="d-flex justify-content-center gap-2">
                                <span class="badge bg-light text-dark">
                                    <i class="bi bi-box-seam me-1"></i>{{ $toko->produks_count ?? 0 }} Produk
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Body card -->
                <div class="card-body d-flex flex-column">

                    <!-- Info toko -->
                    <div class="mb-3">
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-shop text-muted me-2"></i>
                            <small class="text-muted">{{ $toko->nama_toko ?? 'Pemilik' }}</small>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <i class="bi bi-telephone text-muted me-2"></i>
                            <small class="text-muted">{{ $toko->kontak_toko }}</small>
                        </div>
                        <div class="d-flex align-items-start">
                            <i class="bi bi-geo-alt text-muted me-2 mt-1"></i>
                            <small class="text-muted">{{ Str::limit($toko->alamat, 50) }}</small>
                        </div>
                    </div>

                    <!-- Deskripsi singkat -->
                    <p class="card-text text-muted small mb-3 flex-grow-1">
                        {{ Str::limit($toko->deskripsi, 80) }}
                    </p>

                    <!-- Rating dan tombol -->
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <small class="text-muted ms-1">4.5</small>
                        </div>

                        <a href="{{ route('pengguna.toko.show', Crypt::encrypt($toko->id)) }}" class="btn btn-primary btn-sm rounded-pill">
                            <i class="bi bi-eye me-1"></i> Lihat Toko
                        </a>
                    </div>
                </div>
            </div>
        </div>

        @empty
        <!-- Jika tidak ada toko -->
        <div class="col-12 text-center py-5">
            <i class="bi bi-shop-window text-muted" style="font-size: 4rem;"></i>
            <h4 class="text-muted mt-3">Belum ada toko tersedia</h4>
            <p class="text-muted">Toko akan segera ditambahkan oleh penjual.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(isset($tokos) && method_exists($tokos, 'links'))
    <div class="d-flex justify-content-center mt-5">
        {{ $tokos->links() }}
    </div>
    @endif
</div>

@push('styles')
<style>
    /* Style card toko */
    .store-card {
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .store-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    /* Container gambar toko */
    .store-image-container {
        position: relative;
        width: 100%;
        height: 0;
        padding-bottom: 60%; /* Rasio 5:3 untuk header toko */
        overflow: hidden;
        background: #f8f9fa;
    }

    /* Gambar toko */
    .store-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.5s ease;
    }

    .store-card:hover .store-image {
        transform: scale(1.05);
    }

    /* Box untuk toko tanpa gambar */
    .no-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    /* Overlay informasi toko */
    .store-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        padding: 20px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .store-card:hover .store-overlay {
        opacity: 1;
    }

    /* Style pagination */
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: 1px solid #dee2e6;
        color: #0d6efd;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .store-image-container {
            padding-bottom: 70%; /* Sedikit lebih tinggi di mobile */
        }

        .store-overlay {
            padding: 15px;
        }
    }
</style>
@endpush

@endsection
