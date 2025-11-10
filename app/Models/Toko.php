<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'nama_toko',
        'deskripsi',
        'gambar',
        'user_id',
        'kontak_toko',
        'alamat',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }
}
