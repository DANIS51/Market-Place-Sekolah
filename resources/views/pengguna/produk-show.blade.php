@extends('layout.navbar')

@section('conten-pengguna')
<div class="container py-4">

    <!-- Detail Produk -->
    <div class="row g-4">
        <!-- Gambar Produk -->
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-0">
                    @if($produk->gambar_produk && $produk->gambar_produk->count() > 0)
                        <div class="product-gallery">
                            <!-- Gambar utama -->
                            <div class="main-image-container">
                                <img src="{{ asset('storage/images/produk/' . $produk->gambar_produk->first()->nama_gambar) }}"
                                     class="main-image"
                                     alt="{{ $produk->nama_produk }}"
                                     id="mainImage">
                            </div>

                            <!-- Thumbnail gambar -->
                            @if($produk->gambar_produk->count() > 1)
                            <div class="thumbnail-container mt-3">
                                <div class="row g-2">
                                    @foreach($produk->gambar_produk as $index => $gambar)
                                    <div class="col-3">
                                        <img src="{{ asset('storage/images/produk/' . $gambar->nama_gambar) }}"
                                             class="thumbnail {{ $index == 0 ? 'active-thumbnail' : '' }}"
                                             alt="Thumbnail"
                                             onclick="changeImage('{{ asset('storage/images/produk/' . $gambar->nama_gambar) }}', this)">
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="no-image-container">
                            <div class="no-image d-flex align-items-center justify-content-center bg-light">
                                <i class="bi bi-image text-muted fs-1"></i>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Informasi Produk -->
        <div class="col-lg-7">
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

                     </div>

                    <!-- Harga -->
                    <div class="mb-4">
                        <h2 class="text-success fw-bold mb-0">Rp {{ number_format($produk->harga, 0, ',', '.') }}</h2>
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
                        <a href="{{ route('product.whatsapp',  Crypt::encrypt($produk->id)) }}"
                           class="btn btn-success btn-lg">
                           Bayar via WhatsApp
                        </a>

                         
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Produk Serupa -->
    <div class="mt-5">
        <h3 class="fw-bold mb-4">Produk Serupa</h3>
        <div class="row g-4">
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
        width: 100%;
        height: 400px;
        overflow: hidden;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transition: opacity .3s ease;
    }

    .no-image-container {
        width: 100%;
        height: 400px;
        background: #f8f9fa;
        border-radius: 8px;
    }

    .thumbnail {
        width: 100%;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        border-radius: 8px;
        transition: all .3s ease;
    }

    .thumbnail:hover {
        border-color: #0d6efd;
        transform: scale(1.05);
    }

    .active-thumbnail {
        border-color: #0d6efd !important;
        transform: scale(1.05);
    }
</style>
@endpush

@push('scripts')
<script>
function changeImage(src, element) {
    const mainImg = document.getElementById('mainImage');

    // Animasi fade
    mainImg.style.opacity = 0;

    setTimeout(() => {
        mainImg.src = src;
        mainImg.style.opacity = 1;
    }, 200);

    // Thumbnail aktif
    document.querySelectorAll('.thumbnail').forEach(img => {
        img.classList.remove('active-thumbnail');
    });

    element.classList.add('active-thumbnail');
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    console.log('Thumbnail script loaded');
});
</script>
@endpush

@endsection
