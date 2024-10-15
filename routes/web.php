<?php

use App\Http\Controllers\ProdukController;
use App\Http\Controllers\RiwayatTransaksiController;
use Illuminate\Support\Facades\Route;
use Livewire\Mechanisms\FrontendAssets\FrontendAssets;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//midtrans route
Route::get('/', function(){
    return view('Shop.index');
});



Route::get('/', [ProdukController::class,'bayar']);
Route::post('/midtrans/callback', 'MidtransController@callback');


Route::get('/produk',[ProdukController::class,'index'])->name('list-produk');
Route::get('/detail-produk/{id}', [ProdukController::class, 'DetailProduk'])->name('detail-produk');

Route::post('/check-out',[ProdukController::class, 'DataProduk'])->name('co');
Route::get('/bayar',[ProdukController::class,'DataProduk'])->name('bayar-belanja');

// Route Frontend

// route::get('/',function(){
//     return view('Shop.index');
// });

// Route::get('/kontak', function () {
//     return view('Shop.kontak');
// });


// Route::get('/produk', function () {
//     return view('Shop.produk');
// });
// Route::get('/tentang-kami', function () {
//     return view('Shop.about');
// });

// Route::get('/produk/checkout', function () {
//     return view('Shop.res.checkout');
// });

// Route::get('/produk/detail-produk', function () {
//     return view('Shop.res.detail-produk');
// });


