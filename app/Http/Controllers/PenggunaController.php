<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Toko;

class PenggunaController extends Controller
{
    // Helper: decrypt dengan fallback
    private function decryptId($id)
    {
        $id = str_replace(['_', '-'], ['/', '+'], urldecode($id));
        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            $decrypted = $id;
        }
        return is_numeric($decrypted) ? (int) $decrypted : $decrypted;
    }

    public function home(Request $request)
    {
        $query = Produk::with('kategori', 'toko', 'gambar_produk');

        // Filter berdasarkan search (case-insensitive)
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = strtolower($request->search);
            $query->whereRaw('LOWER(nama_produk) LIKE ?', ['%' . $searchTerm . '%']);
        }

        $produks = $query->take(4)->get();
        $kategoris = Kategori::withCount('produks')->take(4)->get();
        $tokos = Toko::with('produks')->withCount('produks')->take(4)->get();

        return view('pengguna.home', compact('produks', 'kategoris', 'tokos'));
    }

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
        $realId = $this->decryptId($kategoriId);
        $kategori = Kategori::with('produks.toko', 'produks.gambar_produk')
                            ->findOrFail($realId);
        $produks = $kategori->produks()->paginate(12);
        return view('pengguna.kategori-show', compact('kategori', 'produks'));
    }

    public function toko()
    {
        $tokos = Toko::with('produks')->withCount('produks')->paginate(12);
        return view('pengguna.toko', compact('tokos'));
    }

    public function tokoShow($tokoId)
    {
        $realId = $this->decryptId($tokoId);
        $toko = Toko::with('user')->withCount('produks')->findOrFail($realId);
        $produks = Produk::with('kategori', 'toko', 'gambar_produk')
                        ->where('toko_id', $realId)
                        ->paginate(12);
        return view('pengguna.toko-show', compact('toko', 'produks'));
    }

    public function produkShow($produkId)
    {
        $realId = $this->decryptId($produkId);
        $produk = Produk::with('kategori', 'toko', 'gambar_produk')
                        ->findOrFail($realId);
        return view('pengguna.produk-show', compact('produk'));
    }
}
