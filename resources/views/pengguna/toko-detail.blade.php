@extends('layout.navbar')

@section('conten-pengguna')
<div class="container py-4">

    <!-- Header Toko -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    @if($toko->gambar)
                        <img src="{{ asset($toko->gambar) }}"
                             class="rounded-circle img-fluid"
                             alt="{{ $toko->nama_toko }}"
                             style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto"
                             style="width: 120px; height: 120px;">
                            <i class="bi bi-shop text-muted fs-1"></i>
                        </div>
                    @endif
                </div>
                <div class="col-md-9">
                    <h2 class="fw-bold mb-2">{{ $toko->nama_toko }}</h2>
                    <p class="text-muted mb-3">{{ $toko->deskripsi }}</p>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-telephone text-primary me-2"></i>
                                <small>{{ $toko->kontak_toko }}</small>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                <small>{{ $toko->alamat }}</small>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <span class="badge bg-primary fs-6">
                            <i class="bi bi-box-seam me-1"></i>{{ $toko->produks->count() }} Produk
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Toko -->
    <div class="row">
        <div class="col-12">
            <h4 class="fw-bold mb-4">Produk dari {{ $toko->nama_toko }}</h4>
        </div>
    </div>

    <div class="row g-4">
        @forelse($toko->produks as $produk)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card">

                <!-- Container gambar produk -->
                <div class="position-relative product-image-container">

                    @if($produk->gambar_produk && $produk->gambar_produk->count() > 0)
                        <img src="{{ asset('storage/images/produk/' . $produk->gambar_produk->first()->nama_gambar) }}"
                             class="card-img-top product-image"
                             alt="{{ $produk->nama_produk }}">
                    @else
                        <div class="no-image d-flex align-items-center justify-content-center bg-light">
                            <i class="bi bi-image text-muted"></i>
                        </div>
                    @endif

                    <!-- Jika gambar lebih dari 1, tampilkan jumlahnya -->
                    @if($produk->gambar_produk && $produk->gambar_produk->count() > 1)
                    <div class="image-count">
                        <small class="text-white">
                            <i class="bi bi-images"></i> {{ $produk->gambar_produk->count() }}
                        </small>
                    </div>
                    @endif

                    <!-- Tombol aksi (like/share) muncul saat hover -->
                    <div class="product-actions">
                        <button class="btn btn-sm btn-light rounded-circle me-1">
                            <i class="bi bi-heart"></i>
                        </button>
                        <button class="btn btn-sm btn-light rounded-circle">
                            <i class="bi bi-share"></i>
                        </button>
                    </div>
                </div>

                <!-- Bagian detail card -->
                <div class="card-body d-flex flex-column">

                    <!-- Kategori produk -->
                    <div class="mb-2">
                        <span class="badge bg-light text-dark">
                            {{ $produk->kategori->nama_kategori ?? 'Umum' }}
                        </span>
                    </div>

                    <!-- Nama Produk -->
                    <h6 class="card-title fw-bold mb-2">{{ $produk->nama_produk }}</h6>

                    <!-- Deskripsi singkat -->
                    <p class="card-text text-muted small mb-3 flex-grow-1">
                        {{ Str::limit($produk->deskripsi, 60) }}
                    </p>

                    <!-- Harga -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="h5 text-success fw-bold mb-0">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </span>

                        <!-- Rating static -->
                        <div class="text-warning small">
                            <i class="bi bi-star-fill"></i> 4.5
                        </div>
                    </div>

                    <!-- Tombol lihat detail -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary rounded-pill"
                                onclick="viewProduct({{ $produk->id }})">
                            <i class="bi bi-eye me-1"></i> Lihat Detail
                        </button>
                    </div>
                </div>

            </div>
        </div>

        @empty
        <!-- Jika toko tidak punya produk -->
        <div class="col-12 text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
            <h4 class="text-muted mt-3">Belum ada produk di toko ini</h4>
            <p class="text-muted">Produk akan segera ditambahkan oleh pemilik toko.</p>
        </div>
        @endforelse
    </div>

    <!-- Tombol kembali -->
    <div class="text-center mt-5">
        <a href="{{ route('pengguna.toko') }}" class="btn btn-outline-primary rounded-pill">
            <i class="bi bi-arrow-left me-2"></i>Kembali ke Daftar Toko
        </a>
    </div>
</div>

<!-- Modal detail produk -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="productDetail">
                <!-- Detail produk dimuat via AJAX -->
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>

    /* Style card agar naik saat hover */
    .product-card {
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        min-height: 480px;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    /* Container gambar dengan tinggi fix */
    .product-image-container {
        height: 240px;
        overflow: hidden;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Gambar utama fix height supaya sejajar */
    .product-image {
        width: 100%;
        height: 240px !important;
        object-fit: cover;
        object-position: center;
        transition: transform 0.5s ease;
    }

    /* Jika card dihover, gambar zoom */
    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    /* Box untuk produk tanpa gambar */
    .no-image {
        height: 240px;
        width: 100%;
    }

    .no-image i {
        font-size: 3rem;
    }

    /* Badge jumlah gambar */
    .image-count {
        position: absolute;
        top: 10px;
        right: 10px;
        background: rgba(0,0,0,0.7);
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
    }

    /* Tombol aksi muncul saat hover */
    .product-actions {
        position: absolute;
        top: 10px;
        left: 10px;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .product-actions {
        opacity: 1;
    }

</style>
@endpush

@endsection
