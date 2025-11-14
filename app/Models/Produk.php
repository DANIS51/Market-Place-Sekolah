<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'nama_produk',
        'harga',
        'deskripsi',
        'tanggal_upload',
        'toko_id',
    ];

    public function toko()
    {
        return $this->belongsTo(Toko::class);
    }
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function gambar_produk()
    {
        return $this->hasMany(Gambar_produk::class);
    }
}
