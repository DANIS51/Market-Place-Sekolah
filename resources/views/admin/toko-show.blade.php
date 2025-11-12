@extends('layout.sidbar')
@section('content')
<div class="container-fluid">
    <!-- Judul Halaman -->
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Detail Toko</h1>
        <div>
            <a href="{{ route('toko.edit', $toko) }}" class="btn btn-primary me-2">
                <i class="bi bi-pencil me-1"></i> Edit Toko
            </a>
            <a href="{{ route('toko.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 fw-bold">Informasi Toko</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-4">
                            @if($toko->gambar)
                                <img src="{{ asset($toko->gambar) }}" alt="Gambar Toko" class="img-fluid rounded shadow-sm" style="max-width: 200px; max-height: 200px; object-fit: cover;">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center mx-auto" style="width: 200px; height: 200px;">
                                    <i class="bi bi-shop display-1 text-muted"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <dl class="row">
                                <dt class="col-sm-4 fw-semibold">Nama Toko</dt>
                                <dd class="col-sm-8">{{ $toko->nama_toko }}</dd>

                                <dt class="col-sm-4 fw-semibold">Pemilik</dt>
                                <dd class="col-sm-8">{{ $toko->user->nama ?? 'N/A' }} ({{ $toko->user->email ?? 'N/A' }})</dd>

                                <dt class="col-sm-4 fw-semibold">Kontak</dt>
                                <dd class="col-sm-8">{{ $toko->kontak_toko }}</dd>

                                <dt class="col-sm-4 fw-semibold">Alamat</dt>
                                <dd class="col-sm-8">{{ $toko->alamat }}</dd>

                                <dt class="col-sm-4 fw-semibold">Deskripsi</dt>
                                <dd class="col-sm-8">{{ $toko->deskripsi ?? 'Tidak ada deskripsi' }}</dd>

                                <dt class="col-sm-4 fw-semibold">Dibuat</dt>
                                <dd class="col-sm-8">{{ $toko->created_at->format('d M Y, H:i') }}</dd>

                                <dt class="col-sm-4 fw-semibold">Terakhir Update</dt>
                                <dd class="col-sm-8">{{ $toko->updated_at->format('d M Y, H:i') }}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-sm">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title mb-0 fw-bold">Statistik Toko</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-12 mb-3">
                            <div class="border rounded p-3">
                                <h3 class="text-primary mb-1">{{ $toko->produks->count() }}</h3>
                                <small class="text-muted">Total Produk</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if($toko->produks->count() > 0)
            <div class="card shadow-sm mt-3">
                <div class="card-header bg-white py-3">
                    <h6 class="card-title mb-0 fw-bold">Produk Terbaru</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        @foreach($toko->produks->take(5) as $produk)
                        <div class="list-group-item px-0">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    @if($produk->gambar)
                                        <img src="{{ asset($produk->gambar) }}" alt="Produk" class="rounded" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bi bi-box text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0 fw-semibold">{{ $produk->nama_produk }}</h6>
                                    <small class="text-muted">Rp {{ number_format($produk->harga, 0, ',', '.') }}</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @if($toko->produks->count() > 5)
                        <div class="text-center mt-3">
                            <small class="text-muted">Dan {{ $toko->produks->count() - 5 }} produk lainnya...</small>
                        </div>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
