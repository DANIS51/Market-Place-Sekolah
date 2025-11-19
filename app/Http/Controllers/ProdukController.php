<?php

namespace App\Http\Controllers;

use App\Models\Gambar_produk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with(['kategori', 'toko', 'gambar_produk'])
            ->whereHas('toko', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->get();
        return view('member.produk', compact('produks'));
    }
    public function detail($id){
        $id = Crypt::decrypt($id);
        $produk = Produk::with('gambar_produk')->firstOrFail($id);
        return view('pengguna.produk-show',compact('produk'));
    }
    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        $tokos = \App\Models\Toko::all();
        return view('member.produk-create', compact('kategoris', 'tokos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'toko_id' => 'required|exists:tokos,id',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk = Produk::create($request->only(['nama_produk', 'harga', 'deskripsi', 'kategori_id', 'toko_id']) + ['tanggal_upload' => now()->toDateString()]);

        if ($request->hasFile('gambar')) {
            foreach ($request->file('gambar') as $file) {
                $imageName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->storeAs('images/produk', $imageName, 'public');

                Gambar_produk::create([
                    'produk_id' => $produk->id,
                    'nama_gambar' => $imageName,
                ]);
            }
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function show($id)
    {
        $produk = Produk::with(['kategori', 'toko', 'gambar_produk'])->findOrFail(Crypt::decrypt($id));
        return view('pengguna.produk-show', compact('produk'));
    }

    public function edit($id)
    {
        $id = urldecode($id);
        $produk = Produk::with(['gambar_produk'])
            ->whereHas('toko', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->findOrFail(Crypt::decrypt($id));
        $kategoris = \App\Models\Kategori::all();
        $tokos = \App\Models\Toko::where('user_id', auth()->id())->get();
        return view('member.produk-edit', compact('produk', 'kategoris', 'tokos'));
    }

    public function update(Request $request, $id)
    {
        $id = urldecode($id);
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            'toko_id' => 'required|exists:tokos,id',
            'gambar_produk.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk = Produk::whereHas('toko', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->findOrFail(Crypt::decrypt($id));
        $produk->update($request->only(['nama_produk', 'harga', 'deskripsi', 'kategori_id', 'toko_id']) + ['tanggal_upload' => now()->toDateString()]);

        if ($request->hasFile('gambar_produk')) {
            foreach ($request->file('gambar_produk') as $file) {
                $imageName = time() . '_' . uniqid() . '.' . $file->extension();
                $file->storeAs('images/produk', $imageName, 'public');

                Gambar_produk::create([
                    'produk_id' => $produk->id,
                    'nama_gambar' => $imageName,
                ]);
            }
        }

        // Handle image deletion
        if ($request->has('delete_images')) {
            foreach ($request->input('delete_images') as $imageId) {
                $gambar = Gambar_produk::find($imageId);
                if ($gambar && $gambar->produk_id == $produk->id) {
                    Storage::disk('public')->delete('images/produk/' . $gambar->nama_gambar);
                    $gambar->delete();
                }
            }
        }

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $id = urldecode($id);
        $produk = Produk::whereHas('toko', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->findOrFail(Crypt::decrypt($id));

        // Hapus gambar terkait
        foreach ($produk->gambar_produk as $gambar) {
            Storage::disk('public')->delete('images/produk/' . $gambar->nama_gambar);
            $gambar->delete();
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus');
    }

    public function whatsapp($id)
    {
        $id = str_replace(['_', '-'], ['/', '+'], $id);
        $produk = Produk::findOrFail(Crypt::decrypt($id));
        $message = "Halo, saya tertarik dengan produk {$produk->nama_produk}. Harga: Rp " . number_format($produk->harga, 0, ',', '.') . ". Deskripsi: {$produk->deskripsi}";
        $whatsappUrl = "https://wa.me/{$produk->toko->kontak_toko}?text=" . urlencode($message);
        return redirect($whatsappUrl);
    }
}
