@extends('layout.app')

@section('content')
<div class="container">
    <h1>Tambah Gambar Produk</h1>
    <form action="{{ route('gambar_produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="produk_id">Produk</label>
            <select name="produk_id" id="produk_id" class="form-control" required>
                <option value="">Pilih Produk</option>
                @foreach(\App\Models\Produk::all() as $produk)
                    <option value="{{ $produk->id }}">{{ $produk->nama_produk }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="gambar">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
