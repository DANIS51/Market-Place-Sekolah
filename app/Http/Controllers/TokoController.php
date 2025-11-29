<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class TokoController extends Controller
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

    public function index()
    {
        $tokos = Toko::with('users')->get();
        return view('admin.toko', compact('tokos'));
    }

    public function create()
    {
        $user = User::all();
        return view('admin.toko-create', compact('user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_toko' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required|exists:users,id',
            'kontak_toko' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('images/toko', $imageName, 'public');
            $data['gambar'] = '/images/toko/' . $imageName;
        }

        Toko::create($data);

        return redirect()->route('toko.index')->with('success', 'Toko berhasil ditambahkan.');
    }

    public function show($id)
    {
        $realId = $this->decryptId($id);
        $toko = Toko::with(['users', 'produks'])->findOrFail($realId);
        return view('admin.toko-show', compact('toko'));
    }

    public function edit($id)
    {
        $realId = $this->decryptId($id);
        $toko = Toko::findOrFail($realId);
        $users = User::all();
        return view('admin.toko-edit', compact('toko', 'users'));
    }

    public function update(Request $request, $id)
    {
        $realId = $this->decryptId($id);
        $toko = Toko::findOrFail($realId);

        $validator = Validator::make($request->all(), [
            'nama_toko' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_id' => 'required|exists:users,id',
            'kontak_toko' => 'required|string|max:255',
            'alamat' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($toko->gambar && Storage::disk('public')->exists(ltrim($toko->gambar, '/'))) {
                Storage::disk('public')->delete(ltrim($toko->gambar, '/'));
            }

            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->storeAs('images/toko', $imageName, 'public');
            $data['gambar'] = '/images/toko/' . $imageName;
        }

        $toko->update($data);

        return redirect()->route('toko.index')->with('success', 'Toko berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $realId = $this->decryptId($id);
        $toko = Toko::findOrFail($realId);

        // Check if toko has related produks
        if ($toko->produks()->count() > 0) {
            return redirect()->back()->with('error', 'Toko tidak dapat dihapus karena masih memiliki produk terkait.');
        }

        // Delete image if exists
        if ($toko->gambar && Storage::disk('public')->exists(ltrim($toko->gambar, '/'))) {
            Storage::disk('public')->delete(ltrim($toko->gambar, '/'));
        }

        $toko->delete();
        return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
    }
}
