<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Produk;
use Illuminate\Support\Facades\Crypt;

class OrderController extends Controller
{

 public function payViaWhatsapp($id)
{
    // Decrypt product ID
    try {
        $productId = Crypt::decrypt($id);
    } catch (\Exception $e) {
        abort(404);
    }

    // Ambil produk beserta relasinya
    $produk = Produk::with('toko', 'kategori', 'gambar_produk')->findOrFail($productId);

    // Nomor WA toko (format internasional, tanpa +)
    $adminNumber = $produk->toko?->kontak_toko ?? "6285811147578";

    // Buat pesan WhatsApp
    $message  = "*Inquiry Produk*\n\n";
    $message .= "*Nama Produk:* {$produk->nama_produk}\n";
    $message .= "*Kategori:* " . ($produk->kategori?->nama_kategori ?? 'Umum') . "\n";
    $message .= "*Harga:* Rp " . number_format($produk->harga, 0, ',', '.') . "\n";
    $message .= "*Toko:* " . ($produk->toko?->nama_toko ?? 'Toko') . "\n";
    $message .= "*Kontak Toko:* " . ($produk->toko?->kontak_toko ?? '-') . "\n\n";
    $message .= "*Deskripsi:* {$produk->deskripsi}\n\n";
    $message .= "Saya tertarik dengan produk ini dan ingin bertanya lebih lanjut !!";

    // Encode URL WhatsApp
    $waUrl = "https://wa.me/{$adminNumber}?text=" . urlencode($message);

    // Redirect ke WA
    return redirect()->away($waUrl);
}


}
