<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\TokoController;

/*
|--------------------------------------------------------------------------
| Route Utama
|--------------------------------------------------------------------------
*/
Route::get('/', [PenggunaController::class, 'home'])->name('home');

/*
|--------------------------------------------------------------------------
| Route Pengguna Umum
|--------------------------------------------------------------------------
*/

Route::get('/pengguna/produk',[PenggunaController::class, 'index'])->name('show.produk.index');
Route::get('/pengguna/produk/{produk}',[PenggunaController::class, 'produkShow'])->name('pengguna.produk.show');
Route::get('/pengguna/kategori',[PenggunaController::class, 'kategori'])->name('pengguna.kategori');
Route::get('/pengguna/kategori/{kategori}',[PenggunaController::class, 'kategoriShow'])->name('pengguna.kategori.show');
Route::get('/pengguna/toko',[PenggunaController::class, 'toko'])->name('pengguna.toko');
Route::get('/pengguna/toko/{toko}',[PenggunaController::class, 'tokoShow'])->name('pengguna.toko.show');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.process');
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.process');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        $totalUsers = \App\Models\User::count();
        $totalTokos = \App\Models\Toko::count();
        $totalProduks = \App\Models\Produk::count();
        $pendingUsers = \App\Models\User::where('status', 'pending')->count();

        return view('admin.dashboard', compact('totalUsers', 'totalTokos', 'totalProduks', 'pendingUsers'));
    })->name('dashboard');

    // ---------- User Management ----------
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::patch('/users/{id}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::patch('/users/{id}/reject', [UserController::class, 'reject'])->name('users.reject');



    // ---------- Toko ----------
    Route::get('/toko', [TokoController::class, 'index'])->name('toko.index');
    Route::get('/toko/create', [TokoController::class, 'create'])->name('toko.create');
    Route::post('/toko', [TokoController::class, 'store'])->name('toko.store');
    Route::get('/toko/{id}', [TokoController::class, 'show'])->name('toko.show');
    Route::get('/toko/{id}/edit', [TokoController::class, 'edit'])->name('toko.edit');
    Route::put('/toko/{id}', [TokoController::class, 'update'])->name('toko.update');
    Route::delete('/toko/{id}', [TokoController::class, 'destroy'])->name('toko.destroy');

    // ---------- Gambar Produk ----------
    Route::get('/gambar_produk', [GambarController::class, 'index'])->name('gambar_produk.index');
    Route::get('/gambar_produk/create', [GambarController::class, 'create'])->name('gambar_produk.create');
    Route::post('/gambar_produk', [GambarController::class, 'store'])->name('gambar_produk.store');

    // ---------- Kategori ----------
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}', [KategoriController::class, 'show'])->name('kategori.show');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
});

/*
|--------------------------------------------------------------------------
| MEMBER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'member'])->group(function () {
    Route::get('/member/dashboard', function () {
        $user = Auth::user();
        $user->load('toko.produks.gambar_produk');

         $totalProducts = $user->toko ? $user->toko->produks->count() : 0;
        $totalSales = 0; // ,
        $ordersThisMonth = 0; //
        $pendingOrders = 0;

        return view('member.dashboard', compact('user', 'totalProducts', 'totalSales', 'ordersThisMonth', 'pendingOrders'));
    })->name('member.dashboard');


    // ---------- Produk ----------
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');


    // ---------- Gambar Produk ----------
    Route::get('/gambar_produk', [GambarController::class, 'index'])->name('gambar_produk.index');
    Route::get('/gambar_produk/create', [GambarController::class, 'create'])->name('gambar_produk.create');
    Route::post('/gambar_produk', [GambarController::class, 'store'])->name('gambar_produk.store');


});
