<?php

namespace App\Http\Controllers;

use App\Models\Gambar_produk;
use Illuminate\Http\Request;

class GambarController extends Controller
{
    //
    public function index()
    {
        return view('admin.gambar_produk');
    }

    public function create()
    {
        return view('admin.gambar_produk_create');
    }

    public function store(Request $request)
    {
        // Logic to store the uploaded image
        $validate = $request->validate([
            'produk_id' => 'required|exists:produks,id',
            'gambar' => 'required|image|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('images/produk', $filename, 'public');

            Gambar_produk::create([
                'produk_id' => $request->produk_id,
                'nama_gambar' => $filename,
            ]);

            return redirect()->route('gambar_produk.index')->with('success', 'Gambar berhasil ditambahkan');
        }

        return back()->with('error', 'Gambar gagal diupload');
    }
}
