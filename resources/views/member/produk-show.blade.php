@extends('layout.sidbar')
@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold text-dark">
                        <i class="bi bi-box-seam me-2 text-muted"></i> Detail Produk
                    </h5>
                    <a href="{{ route('produk.index') }}" class="btn btn-sm btn-outline-secondary action-btn" title="Kembali">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                </div>

                <div class="card-body bg-light">
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-semibold text-secondary">Nama Produk</h6>
                            <p class="mb-0 text-dark fw-medium">{{ $produk->nama_produk }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-semibold text-secondary">Harga</h6>
                            <p class="mb-0 text-success fw-bold">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-semibold text-secondary">Kategori</h6>
                            <p class="mb-0 text-dark">{{ $produk->kategori->nama_kategori ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-semibold text-secondary">Toko</h6>
                            <p class="mb-0 text-dark">{{ $produk->toko->nama_toko ?? 'N/A' }}</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-semibold text-secondary">Tanggal Upload</h6>
                            <p class="mb-0 text-dark">{{ \Carbon\Carbon::parse($produk->tanggal_upload)->format('d M Y') }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <h6 class="fw-semibold text-secondary">Deskripsi</h6>
                            <p class="mb-0 text-dark">{{ $produk->deskripsi ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mb-3">
                        <h6 class="fw-semibold text-secondary mb-3">Gambar Produk</h6>
                        @if($produk->gambarProduks->count() > 0)
                            <div class="row g-3">
                                @foreach($produk->gambarProduks as $gambar)
                                    <div class="col-md-3 col-sm-6">
                                        <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                                            <img src="{{ asset('storage/images/produk/' . $gambar->nama_gambar) }}"
                                                 alt="Gambar Produk"
                                                 class="card-img-top"
                                                 style="height: 200px; object-fit: cover;">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">Belum ada gambar untuk produk ini.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        background-color: #ffffff;
        border-radius: 16px;
    }

    .btn {
        border-radius: 8px !important;
        transition: all 0.15s ease-in-out;
    }

    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.08);
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

    h6 {
        font-size: 0.9rem;
        font-weight: 600;
        color: #6c757d;
    }

    p {
        font-size: 0.95rem;
    }
</style>
@endpush
@endsection
