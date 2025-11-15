<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Toko;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with('kategori', 'toko', 'gambar_produk');

        // Filter berdasarkan search (case-insensitive)
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = strtolower($request->search);
            $query->whereRaw('LOWER(nama_produk) LIKE ?', ['%' . $searchTerm . '%']);
        }

        // Filter berdasarkan kategori
        if ($request->has('kategori') && !empty($request->kategori)) {
            $query->where('kategori_id', $request->kategori);
        }

        // Filter berdasarkan toko
        if ($request->has('toko') && !empty($request->toko)) {
            $query->where('toko_id', $request->toko);
        }

        $produks = $query->paginate(12);

        // Ambil data untuk filter
        $kategoris = Kategori::all();
        $tokos = Toko::all();

        return view('pengguna.produk', compact('produks', 'kategoris', 'tokos'));
    }

    public function kategori()
    {
        $kategoris = Kategori::withCount('produks')->get();
        return view('pengguna.kategori', compact('kategoris'));
    }

    public function kategoriShow($kategoriId)
    {
        try {
            $kategoriId = Crypt::decrypt($kategoriId);
        } catch (\Exception $e) {
            abort(404);
        }
        $kategori = Kategori::findOrFail($kategoriId);
        $produks = Produk::with('kategori', 'toko', 'gambar_produk')
                        ->where('kategori_id', $kategoriId)
                        ->paginate(12);
        return view('pengguna.kategori-show', compact('kategori', 'produks'));
    }

    public function toko(Request $request)
    {
        $query = Toko::with('user')->withCount('produks');

        // Filter berdasarkan search (case-insensitive)
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = strtolower($request->search);
            $query->whereRaw('LOWER(nama_toko) LIKE ?', ['%' . $searchTerm . '%']);
        }

        $tokos = $query->paginate(12);

        return view('pengguna.toko', compact('tokos'));
    }

    public function tokoShow($tokoId)
    {
        try {
            $tokoId = Crypt::decrypt($tokoId);
        } catch (\Exception $e) {
            abort(404);
        }
        $toko = Toko::with('user')->withCount('produks')->findOrFail($tokoId);
        $produks = Produk::with('kategori', 'toko', 'gambar_produk')
                        ->where('toko_id', $tokoId)
                        ->paginate(12);
        return view('pengguna.toko.show', compact('toko', 'produks'));
    }

    public function produkShow($produkId)
    {
        try {
            $produkId = Crypt::decrypt($produkId);
        } catch (\Exception $e) {
            abort(404);
        }
        $produk = Produk::with('kategori', 'toko', 'gambar_produk')->findOrFail($produkId);
        return view('pengguna.produk-show', compact('produk'));
    }
}
