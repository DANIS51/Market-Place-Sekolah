@extends('layout.navbar')

@section('conten-pengguna')
<div class="container py-4">

    <!-- Detail Produk -->
    <div class="row g-4">
        <!-- Gambar Produk -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    @if($produk->gambar_produk && $produk->gambar_produk->count() > 0)
                        <div class="product-gallery">
                            <!-- Gambar utama -->
                            <div class="main-image-container">
                                <img src="{{ asset('images/produk/' . $produk->gambar_produk->first()->nama_gambar) }}"
                                     class="main-image img-fluid rounded"
                                     alt="{{ $produk->nama_produk }}"
                                     id="mainImage">
                            </div>

                            <!-- Thumbnail gambar -->
                            @if($produk->gambar_produk->count() > 1)
                            <div class="thumbnail-container mt-3">
                                <div class="row g-2">
                                    @foreach($produk->gambar_produk as $gambar)
                                    <div class="col-3">
                                        <img src="{{ asset('images/produk/' . $gambar->nama_gambar) }}"
                                             class="thumbnail img-fluid rounded cursor-pointer"
                                             alt="Thumbnail"
                                             onclick="changeImage('{{ asset('images/produk/' . $gambar->nama_gambar) }}')">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="no-image d-flex align-items-center justify-content-center bg-light rounded" style="height: 400px;">
                            <i class="bi bi-image text-muted fs-1"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Informasi Produk -->
        <div class="col-lg-6">
            <div class="card border-0 shadow-sm">
                <div class="card-body">

                    <!-- Kategori -->
                    <div class="mb-3">
                        <span class="badge bg-primary">{{ $produk->kategori->nama_kategori ?? 'Umum' }}</span>
                    </div>

                    <!-- Nama Produk -->
                    <h1 class="h2 fw-bold mb-3">{{ $produk->nama_produk }}</h1>

                    <!-- Rating -->
                    <div class="d-flex align-items-center mb-3">
                        <div class="text-warning me-2">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <small class="text-muted">(4.5) • 120 ulasan</small>
                    </div>

                    <!-- Harga -->
                    <div class="mb-4">
                        <h2 class="text-success fw-bold mb-0">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h2>
                        <small class="text-muted">Harga belum termasuk ongkir</small>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <h5 class="fw-bold mb-3">Deskripsi Produk</h5>
                        <p class="text-muted">{{ $produk->deskripsi }}</p>
                    </div>

                    <!-- Informasi Toko -->
                    <div class="border rounded p-3 mb-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h6 class="mb-1">{{ $produk->toko->nama_toko ?? 'Toko' }}</h6>
                                <small class="text-muted">{{ $produk->toko->kontak_toko ?? '-' }}</small>
                            </div>
                            <a href="{{ route('pengguna.toko.show', Crypt::encrypt($produk->toko->id)) }}" class="btn btn-outline-primary btn-sm">
                                Lihat Toko
                            </a>
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-success btn-lg">
                            <i class="bi bi-whatsapp me-2"></i> Hubungi via WhatsApp
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="bi bi-heart me-2"></i> Simpan ke Wishlist
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Serupa -->
    <div class="mt-5">
        <h3 class="fw-bold mb-4">Produk Serupa</h3>
        <div class="row g-4">
            <!-- Placeholder untuk produk serupa -->
            <div class="col-12 text-center py-4">
                <small class="text-muted">Produk serupa akan ditampilkan di sini</small>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .product-gallery {
        position: relative;
    }

    .main-image-container {
        position: relative;
        width: 100%;
        height: 400px;
        overflow: hidden;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .main-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease;
    }

    .thumbnail {
        width: 100%;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        transition: border-color 0.3s ease;
    }

    .thumbnail:hover {
        border-color: #0d6efd;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .no-image {
        height: 400px;
    }
</style>
@endpush

@push('scripts')
<script>
function changeImage(src) {
    document.getElementById('mainImage').src = src;
}
</script>
@endpush

@endsection
