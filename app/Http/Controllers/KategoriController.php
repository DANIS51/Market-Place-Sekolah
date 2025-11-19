<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::withCount('produks')->get();
        return view('admin.kategori', compact('kategoris'));
    }

    public function create()
    {
        return view('admin.kategori-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function show($id)
    {
        try {
            $real_id = Crypt::decrypt($id);
            $kategori = Kategori::findOrFail($real_id);
            $kategori->load('produks');
            return view('admin.kategori-show', compact('kategori'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function edit($id)
    {
        try {
            $id = str_replace(['_', '-'], ['/', '+'], $id);
            $real_id = Crypt::decrypt($id);
            $kategori = Kategori::findOrFail($real_id);
            return view('admin.kategori-edit', compact('kategori'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $real_id = Crypt::decrypt($id);
            $kategori = Kategori::findOrFail($real_id);
        } catch (\Exception $e) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $id = str_replace(['_', '-'], ['/', '+'], $id);
            $real_id = Crypt::decrypt($id);
            $kategori = Kategori::findOrFail($real_id);
        } catch (\Exception $e) {
            abort(404);
        }

        // Check if kategori has related produks
        if ($kategori->produks()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena masih memiliki produk terkait.');
        }

        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
