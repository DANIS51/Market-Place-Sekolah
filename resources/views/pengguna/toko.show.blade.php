@extends('layout.navbar')

@section('conten-pengguna')
<div class="container py-4">

    <!-- Header Toko -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <!-- Gambar Toko -->
                <div class="col-md-3 text-center">
                    @if($toko->gambar)
                        <img src="{{ asset($toko->gambar) }}" class="rounded-circle" alt="{{ $toko->nama_toko }}" style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <div class="bg-light rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 120px; height: 120px;">
                            <i class="bi bi-shop text-muted fs-1"></i>
                        </div>
                    @endif
                </div>

                <!-- Info Toko -->
                <div class="col-md-6">
                    <h1 class="h2 fw-bold mb-2">{{ $toko->nama_toko }}</h1>
                    <div class="d-flex align-items-center mb-2">
                        <div class="text-warning me-2">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <small class="text-muted">(4.5) • {{ $toko->produks_count ?? 0 }} produk</small>
                    </div>
                    <p class="text-muted mb-2">{{ $toko->deskripsi }}</p>
                    <div class="row">
                        <div class="col-sm-6">
                            <small class="text-muted">
                                <i class="bi bi-telephone me-1"></i> {{ $toko->kontak_toko }}
                            </small>
                        </div>
                        <div class="col-sm-6">
                            <small class="text-muted">
                                <i class="bi bi-geo-alt me-1"></i> {{ Str::limit($toko->alamat, 50) }}
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="col-md-3 text-center">
                    <button class="btn btn-success btn-lg w-100 mb-2">
                        <i class="bi bi-whatsapp me-2"></i> Hubungi
                    </button>
                    <button class="btn btn-outline-primary w-100">
                        <i class="bi bi-heart me-2"></i> Ikuti
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Toko -->
    <div class="row g-4">
        @forelse($produks as $produk)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card">

                <!-- Container gambar produk -->
                <div class="position-relative product-image-container">

                    @if($produk->gambar_produk && $produk->gambar_produk->count() > 0)
                        <!-- Jika produk punya gambar di database -->
                        <img src="{{ asset('images/produk/' . $produk->gambar_produk->first()->nama_gambar) }}"
                             class="card-img-top product-image"
                             alt="{{ $produk->nama_produk }}"
                             style="width: 100%; height: 250px; object-fit: cover;">
                    @else
                        <!-- Jika produk tidak punya gambar, tampilkan kotak kosong tinggi fix -->
                        <div class="no-image d-flex align-items-center justify-content-center bg-light" style="height: 250px;">
                            <i class="bi bi-image text-muted fs-1"></i>
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

                    <!-- Harga + Nama toko -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="h5 text-success fw-bold mb-0">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </span>

                        <div class="text-end">
                            <small class="text-muted d-block">
                                {{ $produk->toko->nama_toko ?? 'Toko' }}
                            </small>

                            <!-- Rating static -->
                            <div class="text-warning small">
                                <i class="bi bi-star-fill"></i> 4.5
                            </div>
                        </div>
                    </div>

                    <!-- Tombol lihat detail -->
                    <div class="d-grid gap-2">
                        <a href="{{ route('pengguna.produk.show', Crypt::encrypt($produk->id)) }}" class="btn btn-primary rounded-pill">
                            <i class="bi bi-eye me-1"></i> Lihat Detail
                        </a>
                    </div>
                </div>

            </div>
        </div>

        @empty
        <!-- Jika tidak ada produk -->
        <div class="col-12 text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
            <h4 class="text-muted mt-3">Belum ada produk tersedia</h4>
            <p class="text-muted">Produk akan segera ditambahkan oleh penjual.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if(isset($produks) && method_exists($produks, 'links'))
    <div class="d-flex justify-content-center mt-5">
        {{ $produks->links() }}
    </div>
    @endif
</div>

@push('styles')
<style>

    /* Style card agar naik saat hover */
    .product-card {
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        min-height: 480px; /* Tinggi minimum yang lebih konsisten */
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }

    /* Container gambar dengan tinggi tetap */
    .product-image-container {
        position: relative;
        width: 100%;
        height: 250px; /* Tinggi tetap untuk konsistensi */
        overflow: hidden;
        background: #f8f9fa;
    }

    /* Gambar utama mengisi container penuh */
    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;        /* Potong gambar supaya proporsional */
        object-position: center;  /* Fokus tengah */
        transition: transform 0.5s ease;
    }

    /* Jika card dihover, gambar zoom */
    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    /* Box untuk produk tanpa gambar */
    .no-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items-center;
        justify-content-center;
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

</style>
@endpush

@endsection
