<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function create()
    {
        return view('admin.users-create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:4',
            'role' => 'required|in:admin,member',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        User::create([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show($id)
    {
        try {
            $real_id = Crypt::decrypt($id);
            $user = User::findOrFail($real_id);
            return view('admin.users-show', compact('user'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function edit($id)
    {
        try {
            $real_id = Crypt::decrypt($id);
            $user = User::findOrFail($real_id);
            return view('admin.users-edit', compact('user'));
        } catch (\Exception $e) {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $real_id = Crypt::decrypt($id);
            $user = User::findOrFail($real_id);
        } catch (\Exception $e) {
            abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:4',
            'role' => 'required|in:admin,member',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->update([
            'nama' => $request->nama,
            'kontak' => $request->kontak,
            'username' => $request->username,
            'password' => $request->has('password') ? Hash::make($request->password) : $user->password,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        try {
            $real_id = Crypt::decrypt($id);
            $user = User::findOrFail($real_id);
        } catch (\Exception $e) {
            abort(404);
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function approve($id)
    {
        try {
            $real_id = Crypt::decrypt($id);
            $user = User::findOrFail($real_id);
        } catch (\Exception $e) {
            abort(404);
        }

        $user->update(['status' => 'approved']);
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil disetujui.');
    }

    public function reject($id)
    {
        try {
            $real_id = Crypt::decrypt($id);
            $user = User::findOrFail($real_id);
        } catch (\Exception $e) {
            abort(404);
        }

        $user->update(['status' => 'rejected']);
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditolak.');
    }
}
