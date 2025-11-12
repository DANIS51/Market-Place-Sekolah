<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Toko;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class TokoController extends Controller
{
    public function index()
    {
        $tokos = Toko::with('user')->get();
        return view('admin.toko', compact('tokos'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.toko-create', compact('users'));
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
            $request->gambar->move(public_path('images/toko'), $imageName);
            $data['gambar'] = 'images/toko/' . $imageName;
        }

        Toko::create($data);

        return redirect()->route('toko.index')->with('success', 'Toko berhasil ditambahkan.');
    }

    public function show(Toko $toko)
    {
        $toko->load('user', 'produks');
        return view('admin.toko-show', compact('toko'));
    }

    public function edit(Toko $toko)
    {
        $users = User::all();
        return view('admin.toko-edit', compact('toko', 'users'));
    }

    public function update(Request $request, Toko $toko)
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
            // Delete old image if exists
            if ($toko->gambar && file_exists(public_path($toko->gambar))) {
                unlink(public_path($toko->gambar));
            }

            $imageName = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/toko'), $imageName);
            $data['gambar'] = 'images/toko/' . $imageName;
        }

        $toko->update($data);

        return redirect()->route('toko.index')->with('success', 'Toko berhasil diperbarui.');
    }

    public function destroy(Toko $toko)
    {
        // Check if toko has related produks
        if ($toko->produks()->count() > 0) {
            return redirect()->back()->with('error', 'Toko tidak dapat dihapus karena masih memiliki produk terkait.');
        }

        // Delete image if exists
        if ($toko->gambar && file_exists(public_path($toko->gambar))) {
            unlink(public_path($toko->gambar));
        }

        $toko->delete();
        return redirect()->route('toko.index')->with('success', 'Toko berhasil dihapus.');
    }
}
