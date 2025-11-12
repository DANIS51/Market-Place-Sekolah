@extends('layout.sidbar')
@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Kategori</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}">Kategori</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $kategori->nama_kategori }}</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-title mb-0 fw-bold">Informasi Kategori</h5>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('kategori.edit', $kategori) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-pencil me-1"></i> Edit Kategori
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-1 fw-semibold text-muted">Nama Kategori</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-3">{{ $kategori->nama_kategori }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-1 fw-semibold text-muted">ID Kategori</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-3">{{ $kategori->id }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-1 fw-semibold text-muted">Jumlah Produk</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-3">
                                <span class="badge bg-info-subtle text-info-emphasis fw-semibold">
                                    {{ $kategori->produks->count() }} Produk
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-1 fw-semibold text-muted">Dibuat Pada</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="mb-0">{{ \Carbon\Carbon::parse($kategori->created_at)->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h6 class="card-title mb-0 fw-bold">Produk dalam Kategori Ini</h6>
                </div>

                <div class="card-body">
                    @if($kategori->produks->count() > 0)
                        <div class="list-group list-group-flush">
                            @foreach($kategori->produks->take(5) as $produk)
                                <div class="list-group-item px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $produk->nama_produk }}</h6>
                                            <small class="text-muted">Rp {{ number_format($produk->harga, 0, ',', '.') }}</small>
                                        </div>
                                        <a href="{{ route('produk.show', $produk) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if($kategori->produks->count() > 5)
                            <div class="text-center mt-3">
                                <small class="text-muted">Dan {{ $kategori->produks->count() - 5 }} produk lainnya...</small>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-4">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                            <p class="text-muted mt-2 mb-0">Belum ada produk dalam kategori ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Kategori
            </a>
        </div>
    </div>
</div>
@endsection
