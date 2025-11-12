<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Gambar_produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    //
    public function index()
    {
        $produks = Produk::with('kategori', 'toko', 'gambarProduks')->get();
        return view('admin.produk', compact('produks'));
    }

    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        $tokos = \App\Models\Toko::all();
        return view('admin.produk-create', compact('kategoris', 'tokos'));
    }

    public function store(Request $request)
    {
        // Validasi dan simpan produk baru
        $validate = Validator::make($request->all(),[
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_produk' => 'required|string|max:250|min:3',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string|min:10',
            'tanggal_upload' => 'required|date',
            'toko_id' => 'required|exists:tokos,id',
            'gambar_produk.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        // Buat produk baru
        $produk = Produk::create([
            'kategori_id' => $request->kategori_id,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'tanggal_upload' => $request->tanggal_upload,
            'toko_id' => $request->toko_id,
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke storage/public/images/produk
                $path = $file->storeAs('images/produk', $filename, 'public');

                // Simpan data gambar ke database
                Gambar_produk::create([
                    'produk_id' => $produk->id,
                    'nama_gambar' => $filename,
                ]);
            }
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show($id)
    {
        $produk = Produk::with('kategori', 'toko', 'gambarProduks')->findOrFail($id);
        return view('admin.produk-show', compact('produk'));
    }

    public function edit($id)
    {
        $produk = Produk::with('gambarProduks')->findOrFail($id);
        $kategoris = \App\Models\Kategori::all();
        $tokos = \App\Models\Toko::all();
        return view('admin.produk-edit', compact('produk', 'kategoris', 'tokos'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $validate = Validator::make($request->all(),[
            'kategori_id' => 'required|exists:kategoris,id',
            'nama_produk' => 'required|string|max:250|min:3',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string|min:10',
            'tanggal_upload' => 'required|date',
            'toko_id' => 'required|exists:tokos,id',
            'gambar_produk' => 'nullable|array',
            'gambar_produk.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'exists:gambar_produks,id',
        ]);

        if ($validate->fails()) {
            return redirect()->back()
                ->withErrors($validate)
                ->withInput();
        }

        // Update data produk
        $produk->update([
            'kategori_id' => $request->kategori_id,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'tanggal_upload' => $request->tanggal_upload,
            'toko_id' => $request->toko_id,
        ]);

        // Handle image deletions
        if ($request->has('delete_images')) {
            foreach ($request->delete_images as $imageId) {
                $gambar = Gambar_produk::find($imageId);
                if ($gambar) {
                    // Hapus file dari storage
                    Storage::disk('public')->delete('images/produk/' . $gambar->nama_gambar);
                    // Hapus record dari database
                    $gambar->delete();
                }
            }
        }

        // Handle new image uploads
        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                // Generate unique filename
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke storage/public/images/produk
                $path = $file->storeAs('images/produk', $filename, 'public');

                // Simpan data gambar ke database
                Gambar_produk::create([
                    'produk_id' => $produk->id,
                    'nama_gambar' => $filename,
                ]);
            }
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::with('gambarProduks')->findOrFail($id);

        // Delete associated images
        foreach ($produk->gambarProduks as $gambar) {
            // Hapus file dari storage
            Storage::disk('public')->delete('images/produk/' . $gambar->nama_gambar);
            // Hapus record dari database
            $gambar->delete();
        }

        // Hapus produk
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
}
