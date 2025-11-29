@extends('layout.navbar')

@section('conten-pengguna')
<div class="container py-5">

    <!-- Judul Halaman -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-primary mb-2">Produk {{ $kategori->nama_kategori }}</h1>
        <p class="text-muted">Temukan berbagai produk terbaik dalam kategori ini</p>
        <div class="underline mx-auto"></div>
    </div>

    <!-- Grid Produk -->
    <div class="row g-4">
        @forelse($produks as $produk)
        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
            <div class="card product-card border-0 shadow-sm rounded-4 overflow-hidden">

                <!-- Gambar Produk -->
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

                    <!-- Jumlah gambar -->
                    @if($produk->gambar_produk && $produk->gambar_produk->count() > 1)
                    <div class="image-count">
                        <small><i class="bi bi-images"></i> {{ $produk->gambar_produk->count() }}</small>
                    </div>
                    @endif

                    <!-- Tombol hover -->
                    <div class="product-actions">
                        <button class="btn-action"><i class="bi bi-heart"></i></button>
                        <button class="btn-action"><i class="bi bi-share"></i></button>
                    </div>
                </div>

                <!-- Detail Produk -->
                <div class="card-body d-flex flex-column">

                    <span class="badge kategori-badge mb-2">
                        {{ $produk->kategori->nama_kategori ?? 'Umum' }}
                    </span>

                    <h6 class="fw-bold mb-2">{{ $produk->nama_produk }}</h6>

                    <p class="text-muted small flex-grow-1 mb-3">
                        {{ Str::limit($produk->deskripsi, 65) }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="harga-produk">
                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                        </span>

                        <div class="text-end">
                            <small class="text-muted">{{ $produk->toko->nama_toko ?? 'Toko' }}</small>
                            <div class="text-warning small">
                                <i class="bi bi-star-fill"></i> 4.5
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('pengguna.produk.show', Crypt::encrypt($produk->id)) }}"
                       class="btn btn-primary rounded-pill w-100 fw-semibold">
                        <i class="bi bi-eye me-1"></i> Lihat Detail
                    </a>

                </div>
            </div>
        </div>

        @empty
        <div class="col-12 text-center py-5">
            <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
            <h4 class="text-muted mt-3">Belum ada produk tersedia</h4>
            <p class="text-muted">Tunggu update dari penjual.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(isset($produks) && method_exists($produks, 'links'))
    <div class="d-flex justify-content-center mt-5">
        {{ $produks->links() }}
    </div>
    @endif

</div>

@push('styles')
<style>

    /* Garis bawah judul */
    .underline {
        width: 70px;
        height: 4px;
        background: #0d6efd;
        border-radius: 10px;
    }

    /* CARD */
    .product-card {
        transition: 0.3s ease;
        background: #fff;
        border-radius: 18px !important;
    }

    .product-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 12px 28px rgba(0,0,0,0.15);
    }

    /* GAMBAR */
    .product-image-container {
        height: 240px;
        overflow: hidden;
        background: #f5f5f5;
        position: relative;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.5s ease;
    }

    .product-card:hover .product-image {
        transform: scale(1.08);
    }

    .no-image i {
        font-size: 3.5rem;
    }

    /* JUMLAH GAMBAR */
    .image-count {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0,0,0,0.6);
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 10px;
        color: white;
    }

    /* TOMBOL HOVER */
    .product-actions {
        position: absolute;
        top: 12px;
        left: 12px;
        display: flex;
        gap: 8px;
        opacity: 0;
        transition: 0.3s ease;
    }

    .product-card:hover .product-actions {
        opacity: 1;
    }

    .btn-action {
        width: 36px;
        height: 36px;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(255,255,255,0.8);
        border-radius: 50%;
        border: none;
        box-shadow: 0 3px 6px rgba(0,0,0,0.15);
        transition: 0.2s;
    }

    .btn-action:hover {
        background: white;
    }

    /* BADGE */
    .kategori-badge {
        background: #eef1ff;
        color: #3b43d9;
        padding: 6px 12px;
        border-radius: 12px;
        font-size: 12px;
        font-weight: 600;
    }

    /* HARGA */
    .harga-produk {
        color: #2fb152;
        font-size: 1.1rem;
        font-weight: 700;
    }

    /* Pagination */
    .pagination .page-link {
        border-radius: 10px;
        margin: 0 3px;
    }

</style>
@endpush

@endsection
