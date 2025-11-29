@extends('layout.navbar')

@section('conten-pengguna')

<div class="container py-4">


    <!-- Filter Section -->
    <div class=" card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('show.produk.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label fw-semibold">Cari Produk</label>
                    <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nama produk...">
                </div>
                <div class="col-md-3">
                    <label for="kategori" class="form-label fw-semibold">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option value="">Semua Kategori</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="toko" class="form-label fw-semibold">Toko</label>
                    <select class="form-select" id="toko" name="toko">
                        <option value="">Semua Toko</option>
                        @foreach($tokos as $toko)
                        <option value="{{ $toko->id }}" {{ request('toko') == $toko->id ? 'selected' : '' }}>
                            {{ $toko->nama_toko }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Grid Produk -->
    <div class="row g-4">
        @forelse($produks as $produk)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card h-100 border-0 shadow-sm rounded-3 overflow-hidden product-card">

                <!-- Container gambar produk -->
                <div class="position-relative product-image-container">
                    @if($produk->gambar_produk && $produk->gambar_produk->count() > 0)
                        @if($produk->gambar_produk->count() > 1)
                            <!-- Carousel untuk produk dengan banyak gambar -->
                            <div id="carousel-{{ $produk->id }}" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
                                <div class="carousel-inner rounded-top" style="height: 250px;">
                                    @foreach($produk->gambar_produk as $index => $gambar)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" style="height: 100%;">
                                        <img src="{{ asset('storage/images/produk/' . $gambar->nama_gambar) }}"
                                             class="d-block w-100 carousel-product-image"
                                             alt="{{ $produk->nama_produk }} - Gambar {{ $index + 1 }}"
                                             style="height: 100%; object-fit: cover; width: 100%;">
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $produk->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $produk->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>

                                <!-- Indicators -->
                                <div class="carousel-indicators position-absolute bottom-0 mb-2">
                                    @foreach($produk->gambar_produk as $index => $gambar)
                                    <button type="button" data-bs-target="#carousel-{{ $produk->id }}" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <!-- Gambar tunggal untuk produk dengan 1 gambar -->
                            <img src="{{ asset('storage/images/produk/' . $produk->gambar_produk->first()->nama_gambar) }}"
                                 class="card-img-top product-image"
                                 alt="{{ $produk->nama_produk }}"
                                 style="width: 100%; height: 250px; object-fit: cover;">
                        @endif
                    @else
                        <!-- Jika produk tidak punya gambar, tampilkan kotak kosong tinggi fix -->
                        <div class="no-image d-flex align-items-center justify-content-center bg-light" style="height: 250px;">
                            <i class="bi bi-image text-muted fs-1"></i>
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

<!-- Modal detail produk -->
<div class="modal fade" id="productModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Detail Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="productDetail">
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
        min-height: 480px; /* Tinggi minimum yang lebih konsisten */
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

    .carousel-product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.5s ease;
    }

    /* Jika card dihover, gambar zoom */
    .product-card:hover .product-image,
    .product-card:hover .carousel-product-image {
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

    /* Carousel indicators styling */
    .carousel-indicators {
        bottom: 10px;
    }

    .carousel-indicators button {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: rgba(255, 255, 255, 0.5);
        border: none;
        margin: 0 2px;
    }

    .carousel-indicators button.active {
        background-color: #fff;
    }

    /* Carousel controls styling */
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .product-card:hover .carousel-control-prev,
    .product-card:hover .carousel-control-next {
        opacity: 1;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        width: 15px;
        height: 15px;
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

    .hero-section {
        position: relative;
        overflow: hidden;
    }
</style>
@endpush

@endsection
