<?php

namespace App\Http\Controllers;


use Midtrans\Snap;
use App\Models\Shop\Produk;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('Shop.produk', compact('produk'));
    }

    public function DetailProduk($id)
    {
        $detail_produk = Produk::find($id);
        // dd($detail_produk);
        return view('Shop.res.detail-produk', compact('detail_produk'));
    }

    public function DataProduk(Request $request)
    {
        $id = $request->input('id');
        $nama_produk = $request->input('nama_produk');
        $harga = $request->input('harga');
        $harga = number_format($harga, 0, '', '');

        return view('Shop.res.checkout', compact('id', 'nama_produk', 'harga'));
    }

    public function Bayar(Request $request)
    {
        $qty = 2;
        $ongkir = 10000;
        $harga = $request->input('harga');
        $total = abs($harga * $qty) ;
        $produk = $request->input('nama_produk');

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $total,
            ],
            'item_details' => [
                [
                    'id' => $produk,
                    'name' => $produk,
                    'price' => $total,
                    'quantity' => $qty,
                ]
            ],
        ];
        $snapToken = Snap::getSnapToken($params);

        // Pass Snap Token to view
        return view('Shop.res.checkout', ['snapToken' => $snapToken],);
    }



    public function NotifikasiProdukBaru(Produk $produk)
    {
        $appkey = '4847fb2c-c144-409e-93ab-23128b1c9a00';
        $authkey = config('whatsapp.WATSAP_PANEL_KEY');
        $url = config('whatsapp.WATSAP_BASE_URL');


        $user = auth()->user()->name;
        $kategori = $produk->Kategori->kategori;
        $sub_kategori = $produk->SubKategori->sub_kategori;
        $nama_produk = $produk->nama_produk;
        $harga = $produk->harga;
        $deskripsi = $produk->deskripsi;

        $chat = [
            'appkey' => $appkey,
            'authkey' => $authkey,
            'to' => '6281319020163',
            'message' =>
            "Produk Baru Berhasil Ditambahkan oleh\n$user\n\nKategori: $kategori\nSub Kategori: $sub_kategori\nNama Produk: $nama_produk\nHarga: Rp" . number_format($harga, 0, ',', '.') . "\nDeskripsi: $deskripsi",
            'sandbox' => 'false'
        ];
        $response = Http::post($url, $chat);
        return $response;
    }


    public function NotifikasiProdukEdit(Produk $produk)
    {
        $appkey = '4847fb2c-c144-409e-93ab-23128b1c9a00';
        $authkey = config('whatsapp.WATSAP_PANEL_KEY');
        $url = config('whatsapp.WATSAP_BASE_URL');

        $user = auth()->user()->name;
        $kategori = $produk->Kategori->kategori;
        $sub_kategori = $produk->SubKategori->sub_kategori;
        $nama_produk = $produk->nama_produk;
        $harga = $produk->harga;
        $deskripsi = $produk->deskripsi;
        $status = $produk->status;

        $chat = [
            'appkey' => $appkey,
            'authkey' => $authkey,
            'to' => '6281319020163',
            'message' =>
            "Produk Berhasil Diubah oleh\n$user\n\nKategori: $kategori\nSub Kategori: $sub_kategori\nNama Produk: $nama_produk\nHarga: Rp" . number_format($harga, 0, ',', '.') . "\nDeskripsi: $deskripsi\nStatus: " . ($status == 1 ? 'publish' : 'tidak publish'),
            'sandbox' => 'false'
        ];
        $response = Http::post($url, $chat);
        return $response;
    }
}
