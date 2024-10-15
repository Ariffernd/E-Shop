<?php

namespace App\Models\Shop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduk extends Model
{
    use HasFactory;

    protected $fillable =[
        'produk_id',
        'snap_id',
        'nama',
        'alamat',
        'nomor_wa',
        'email',
        'harga',
        'qty',
        'ongkir',
        'total_bayar',
        'no_resi',
        'status_pemesanan',
        'metode_pembayaran',
        'status_transaksi',
    ];
}
