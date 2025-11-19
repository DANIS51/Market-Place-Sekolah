 @extends('layout.navbar')

@section('conten-pengguna')
<div class="container-fluid text-center mb-5 p-5  hero-section"
     style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <h1 class="display-5 fw-bold mb-3">Marketplace Sekolah</h1>
    <p class="lead mb-4">Temukan produk berkualitas dari berbagai toko di sekolah kami</p>
    <div class="container d-flex justify-content-center">
        <form method="GET" action="{{ route('home') }}" class="input-group search-box">
            <input type="text" class="form-control border-0" name="search" value="{{ request('search') }}" placeholder="Cari produk yang Anda inginkan...">
            <button class="btn btn-warning" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </form>
    </div>
</div>
<div class="container py-4">
    <!-- Hero Section -->

    <!-- Statistik Singkat -->
    <div class="row mb-5">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-3 bg-primary text-white stat-card">
                <div class="card-body text-center py-4">
                    <div class="icon-container mb-3">
                        <i class="bi bi-box-seam fs-1"></i>
                    </div>
                    <h3 class="fw-bold">{{ $produks->count() ?? 0 }}+</h3>
                    <p>Produk Tersedia</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-3 bg-success text-white stat-card">
                <div class="card-body text-center py-4">
                    <div class="icon-container mb-3">
                        <i class="bi bi-shop fs-1"></i>
                    </div>
                    <h3 class="fw-bold">{{ $tokos->count() ?? 0 }}+</h3>
                    <p>Toko Terdaftar</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm rounded-3 bg-warning text-white stat-card">
                <div class="card-body text-center py-4">
                    <div class="icon-container mb-3">
                        <i class="bi bi-tags fs-1"></i>
                    </div>
                    <h3 class="fw-bold">{{ $kategoris->count() ?? 0 }}+</h3>
                    <p>Kategori</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Kategori Populer -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4 section-header">
            <h2 class="h4 fw-bold mb-0">
                <i class="bi bi-fire text-danger me-2"></i>Kategori Tersedia
            </h2>
            <a href="{{ route('pengguna.kategori') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-3">
            @forelse($kategoris as $kategori)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="{{ route('pengguna.kategori.show', Crypt::encrypt($kategori->id)) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm rounded-4 category-card overflow-hidden">
                        <div class="card-top bg-gradient" style="height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                            <div class="card-body text-center d-flex flex-column justify-content-center h-100">
                                <i class="bi bi-tag-fill text-white fs-1"></i>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h6 class="card-title fw-bold mb-2">{{ $kategori->nama_kategori }}</h6>
                            <span class="badge bg-primary rounded-pill px-3 py-1">{{ $kategori->produks_count }} Produk</span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-4">
                <div class="alert alert-light border-0 shadow-sm rounded-4">
                    <i class="bi bi-tags text-muted fs-1"></i>
                    <h5 class="text-muted mt-3">Belum ada kategori</h5>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Toko Terbaik -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4 section-header">
            <h2 class="h4 fw-bold mb-0">
                <i class="bi bi-award text-warning me-2"></i>Toko Tersedia
            </h2>
            <a href="{{ route('pengguna.toko') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
        <div class="row g-3">
            @forelse($tokos as $toko)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="{{ route('pengguna.toko.show', Crypt::encrypt($toko->id)) }}" class="text-decoration-none">
                    <div class="card h-100 border-0 shadow-sm rounded-4 store-card overflow-hidden">
                        <div class="card-body text-center">
                            <div class="toko-avatar mb-3">
                                @if($toko->gambar)
                                <img src="{{ asset($toko->gambar) }}"
                                alt="{{ $toko->nama_toko }}"
                                class="toko-image rounded-circle"
                                style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #dee2e6;">
                                @else
                                <div class="toko-image-placeholder rounded-circle d-flex align-items-center justify-content-center bg-light"
                                     style="width: 80px; height: 80px;">
                                    <i class="bi bi-shop fs-2 text-muted"></i>
                                </div>
                                @endif
                            </div>
                            <h6 class="card-title fw-bold mb-2">{{ $toko->nama_toko }}</h6>
                            <small class="text-muted d-block mb-2">{{ $toko->user->name ?? 'Pemilik' }}</small>
                            <span class="badge bg-success rounded-pill px-3 py-1">{{ $toko->produks_count }} Produk</span>
                        </div>
                    </div>
                </a>
            </div>
            @empty
            <div class="col-12 text-center py-4">
                <div class="alert alert-light border-0 shadow-sm rounded-4">
                    <i class="bi bi-shop text-muted fs-1"></i>
                    <h5 class="text-muted mt-3">Belum ada toko</h5>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Produk Unggulan -->
    <div class="mb-5">
        <div class="d-flex justify-content-between align-items-center mb-4 section-header">
            <h2 class="h4 fw-bold mb-0">
                <i class="bi bi-star-fill text-warning me-2"></i>Produk Tersedia
            </h2>
            <a href="{{ route('show.produk.index') }}" class="btn btn-outline-primary btn-sm rounded-pill">
                Lihat Semua <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Grid Produk -->
    <div class="row g-4">
        @forelse($produks as $produk)
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden product-card">
                <!-- Container gambar produk -->
                <div class="position-relative product-image-container">
                    <!-- Badge diskon atau promo -->
                    @if($produk->diskon)
                    <div class="position-absolute top-0 start-0 m-2">
                        <span class="badge bg-danger rounded-pill px-3 py-2">
                            <i class="bi bi-percent"></i> {{ $produk->diskon }}%
                        </span>
                    </div>
                    @endif

                    @if($produk->gambar_produk && $produk->gambar_produk->count() > 0)
                        @if($produk->gambar_produk->count() > 1)
                            <!-- Carousel untuk produk dengan banyak gambar -->
                            <div id="carousel-home-{{ $produk->id }}" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
                                <div class="carousel-inner rounded-top">
                                    @foreach($produk->gambar_produk as $index => $gambar)
                                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/images/produk/' . $gambar->nama_gambar) }}"
                                             class="d-block w-100 product-image"
                                             alt="{{ $produk->nama_produk }} - Gambar {{ $index + 1 }}"
                                             style="height: 250px; object-fit: cover;">
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#carousel-home-{{ $produk->id }}" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carousel-home-{{ $produk->id }}" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>

                                <!-- Indicators -->
                                <div class="carousel-indicators position-absolute bottom-0 mb-2">
                                    @foreach($produk->gambar_produk as $index => $gambar)
                                    <button type="button" data-bs-target="#carousel-home-{{ $produk->id }}" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}" aria-label="Slide {{ $index + 1 }}"></button>
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
                </div>

                <!-- Bagian detail card -->
                <div class="card-body d-flex flex-column">
                    <!-- Kategori produk -->
                    <div class="mb-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-1">
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
                        <div>
                            <span class="h5 text-success fw-bold mb-0 d-block">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </span>
                            <small class="text-muted">
                                {{ $produk->toko->nama_toko ?? 'Toko' }}
                            </small>
                        </div>

                        <!-- Rating static -->
                        <div class="rating">
                            @for($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star-fill text-warning"></i>
                            @endfor
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
            <div class="alert alert-light border-0 shadow-sm rounded-4">
                <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                <h4 class="text-muted mt-3">Belum ada produk tersedia</h4>
                <p class="text-muted">Produk akan segera ditambahkan oleh penjual.</p>
            </div>
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
                <!-- Detail produk dimuat via AJAX -->
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Hero Section Styles */
    .hero-section {
        position: relative;
        overflow: hidden;
    }

    /* Search Box Styles */
    .search-box {
        max-width: 500px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        border-radius: 50px;
        overflow: hidden;
    }

    .search-box .form-control {
        border-radius: 50px 0 0 50px;
        padding: 12px 20px;
    }

    .search-box .btn {
        border-radius: 0 50px 50px 0;
        padding: 0 20px;
    }

    /* Stat Card Styles */
    .stat-card {
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .stat-card .icon-container {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }

    /* Section Header Styles */
    .section-header {
        position: relative;
        padding-bottom: 10px;
    }

    .section-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 3px;
    }

    /* Category Card Styles */
    .category-card {
        transition: all 0.3s ease;
        min-height: 200px;
        border-radius: 1rem !important;
    }

    .category-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .category-card .card-top {
        position: relative;
        overflow: hidden;
    }

    .category-card .card-top::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
    }

    /* Store Card Styles */
    .store-card {
        transition: all 0.3s ease;
        min-height: 250px;
        border-radius: 1rem !important;
    }

    .store-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .toko-avatar {
        position: relative;
        display: inline-block;
    }

    .toko-avatar::after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 20px;
        height: 20px;
        background: #28a745;
        border-radius: 50%;
        border: 3px solid white;
    }

    /* Product Card Styles */
    .product-card {
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        min-height: 520px;
        border-radius: 1rem !important;
        overflow: hidden;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .product-image-container {
        position: relative;
        width: 100%;
        height: 250px;
        overflow: hidden;
        background: #f8f9fa;
    }

    .product-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.05);
    }

    .no-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
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

    /* Rating Styles */
    .rating {
        display: flex;
        gap: 2px;
    }

    /* Pagination Styles */
    .pagination .page-link {
        border-radius: 8px;
        margin: 0 2px;
        border: 1px solid #dee2e6;
        color: #0d6efd;
        font-weight: 500;
    }

    .pagination .page-item.active .page-link {
        background-color: #0d6efd;
        border-color: #0d6efd;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .hero-section {
            padding: 2rem 1rem !important;
        }

        .display-5 {
            font-size: 2rem;
        }

        .section-header {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .section-header .btn {
            margin-top: 10px;
        }
    }
</style>
@endpush

@endsection
