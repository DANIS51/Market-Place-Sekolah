@extends('layout.navbar')

@section('conten-pengguna')
 
<div class="container py-4">




    <!-- Pencarian -->
    <div class="row mb-4">
        <div class="col-md-6 mx-auto">
            <form method="GET" action="{{ route('pengguna.toko') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" value="{{ request('search') }}" placeholder="Cari nama toko...">
                    <button class="btn btn-primary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Grid Toko -->
    <div class="row">
        @forelse($tokos as $toko)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100">

                <!-- Gambar Toko -->
                @if($toko->gambar)
                <img src="{{ asset('storage' . $toko->gambar) }}" class="card-img-top" alt="{{ $toko->nama_toko }}" style="height: 200px; object-fit: cover;">
                @else
                <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                    <i class="bi bi-shop text-muted" style="font-size: 3rem;"></i>
                </div>
                @endif

                <!-- Detail Toko -->
                <div class="card-body">
                    <h6 class="card-title fw-bold">{{ $toko->nama_toko }}</h6>
                    <p class="text-muted small mb-2">{{ $toko->user->name ?? 'Pemilik' }}</p>

                    <p class="card-text small text-muted">
                        {{ Str::limit($toko->deskripsi, 50) }}
                    </p>

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge bg-success">{{ $toko->produks_count ?? 0 }} Produk</span>

                        <div class="text-warning small">
                            <i class="bi bi-star-fill"></i> 4.5
                        </div>
                    </div>

                    <div class="mt-3">
                        <a href="{{ route('pengguna.toko.show', Crypt::encrypt($toko->id)) }}" class="btn btn-primary btn-sm w-100">
                            Lihat Toko
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty

        <div class="col-12 text-center py-5">
            <i class="bi bi-shop text-muted" style="font-size: 4rem;"></i>
            <h5 class="text-muted mt-3">Belum ada toko</h5>
            <p class="text-muted">Toko akan segera ditambahkan</p>
        </div>

        @endforelse
    </div>

    <!-- Pagination -->
    @if(isset($tokos) && method_exists($tokos, 'links'))
    <div class="d-flex justify-content-center mt-4">
        {{ $tokos->links() }}
    </div>
    @endif

</div>

@push('styles')
<style>
    /* Minimal styling untuk tampilan bersih */
    .card {
        transition: transform 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }

    .card-img-top {
        border-bottom: 1px solid #dee2e6;
    }

    .badge {
        font-size: 0.75rem;
    }
    .hero-section{
        position: relative;
        overflow: hidden;
    }
</style>
@endpush

@endsection
