<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GambarController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('layout.sidbar');
})->middleware('auth')->name('dashboard');


Route::middleware(['auth', 'admin'])->group(function () {
    //Users roots
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    //Produk routes
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::get('/produk/create', [ProdukController::class, 'create'])->name('produk.create');
    Route::post('/produk', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::get('/produk/{id}/edit', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');

    //Kategori routes
    Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [App\Http\Controllers\KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [App\Http\Controllers\KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{kategori}', [App\Http\Controllers\KategoriController::class, 'show'])->name('kategori.show');
    Route::get('/kategori/{kategori}/edit', [App\Http\Controllers\KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{kategori}', [App\Http\Controllers\KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{kategori}', [App\Http\Controllers\KategoriController::class, 'destroy'])->name('kategori.destroy');

    //Toko routes
    Route::get('/toko', [App\Http\Controllers\TokoController::class, 'index'])->name('toko.index');
    Route::get('/toko/create', [App\Http\Controllers\TokoController::class, 'create'])->name('toko.create');
    Route::post('/toko', [App\Http\Controllers\TokoController::class, 'store'])->name('toko.store');
    Route::get('/toko/{toko}', [App\Http\Controllers\TokoController::class, 'show'])->name('toko.show');
    Route::get('/toko/{toko}/edit', [App\Http\Controllers\TokoController::class, 'edit'])->name('toko.edit');
    Route::put('/toko/{toko}', [App\Http\Controllers\TokoController::class, 'update'])->name('toko.update');
    Route::delete('/toko/{toko}', [App\Http\Controllers\TokoController::class, 'destroy'])->name('toko.destroy');

    //Route Gambar Produk
    Route::get('/gambar_produk', [GambarController::class, 'index'])->name('gambar_produk.index');
    Route::get('/gambar_produk/create', [GambarController::class, 'create'])->name('gambar_produk.create');
    Route::post('/gambar_produk', [GambarController::class, 'store'])->name('gambar_produk.store');
});
