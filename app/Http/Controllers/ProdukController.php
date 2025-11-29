<?php

namespace App\Http\Controllers;

use App\Models\Gambar_produk;
use App\Models\Produk;
use App\Models\Toko;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $query = Produk::with(['kategori', 'toko', 'gambar_produk'])
            ->whereHas('toko', function($q) {
                $q->where('user_id', auth()->id());
            });

        // search keyword (nama_produk atau deskripsi)
        if ($search = $request->query('search')) {
            $query->where(function($q) use ($search) {
                $q->where('nama_produk', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        // filter kategori
        if ($kategori = $request->query('kategori')) {
            $query->where('kategori_id', $kategori);
        }

        // filter toko (berguna bila user punya banyak toko)
        if ($toko = $request->query('toko')) {
            $query->where('toko_id', $toko);
        }

        $produks = $query->orderBy('created_at', 'desc')
                         ->paginate(12)
                         ->withQueryString();

        $kategoris = \App\Models\Kategori::all();
        $tokos = \App\Models\Toko::where('user_id', auth()->id())->get();

        return view('member.produk', compact('produks', 'kategoris', 'tokos'));
    }

    // Helper: coba decrypt, fallback ke id asli (cast ke int bila numeric)
    private function decryptId($id)
    {
        $id = urldecode($id);
        try {
            $decrypted = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            $decrypted = $id;
        }
        return is_numeric($decrypted) ? (int) $decrypted : $decrypted;
    }

    public function detail($id){
        $produk = Produk::with('gambar_produk')->findOrFail($this->decryptId($id));
        return view('pengguna.produk-show',compact('produk'));
    }
    public function create()
    {
        $kategoris = \App\Models\Kategori::all();
        // ambil hanya toko milik user yang login
        $tokos = Toko::where('user_id', auth()->id())->get();
        return view('member.produk-create', compact('kategoris', 'tokos'));
    }

    public function store(Request $request)
    {
        $request->validate([
             'nama_produk' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategoris,id',
            // toko_id sekarang optional; jika tidak dikirim, akan diisi otomatis
            'toko_id' => 'nullable|exists:tokos,id',
            'gambar.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // tentukan toko_id: pakai dari request jika ada (mis. user punya banyak toko),
        // atau fallback ke toko pertama milik user yang login
        $tokoId = $request->input('toko_id')
            ?: Toko::where('user_id', auth()->id())->value('id');

        if (!$tokoId) {
            return back()->withErrors(['toko_id' => 'Anda belum memiliki toko.'])->withInput();
        }

        $produk = Produk::create($request->only(['nama_produk', 'harga', 'deskripsi', 'kategori_id']) + [
            'toko_id' => $tokoId,
            'tanggal_upload' => now()->toDateString()
        ]);

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
        $produk = Produk::with(['kategori', 'toko', 'gambar_produk'])->findOrFail($this->decryptId($id));
        return view('pengguna.produk-show', compact('produk'));
    }

    public function edit($id)
    {
        $decryptedId = $this->decryptId($id);

        $produk = Produk::with(['gambar_produk'])
            ->whereHas('toko', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->findOrFail($decryptedId);

        $kategoris = \App\Models\Kategori::all();
        $tokos = \App\Models\Toko::where('user_id', auth()->id())->get();
        return view('member.produk-edit', compact('produk', 'kategoris', 'tokos'));
    }

    public function update(Request $request, $id)
    {
        $decryptedId = $this->decryptId($id);
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
            ->findOrFail($decryptedId);
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
        $decryptedId = $this->decryptId($id);
        $produk = Produk::whereHas('toko', function($query) {
                $query->where('user_id', auth()->id());
            })
            ->findOrFail($decryptedId);

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
        $produk = Produk::findOrFail($this->decryptId($id));
        $message = "Halo, saya tertarik dengan produk {$produk->nama_produk}. Harga: Rp " . number_format($produk->harga, 0, ',', '.') . ". Deskripsi: {$produk->deskripsi}";
        $whatsappUrl = "https://wa.me/{$produk->toko->kontak_toko}?text=" . urlencode($message);
        return redirect($whatsappUrl);
    }
}
