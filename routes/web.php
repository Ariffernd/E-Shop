<?php

use App\Http\Controllers\CekResiController;
use App\Http\Controllers\ProdukController;
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

Route::get('/', function(){
    return view('Shop.index');
});

Route::get('/produk',[ProdukController::class,'index'])->name('list-produk');
Route::get('/detail-produk/{id}', [ProdukController::class, 'DetailProduk'])->name('detail-produk');
Route::get('/bayar',[ProdukController::class,'DataProduk'])->name('bayar-belanja');
Route::post('/check-out', [ProdukController::class,'Bayar'])->name('bayar');

// CEK RESI
Route::get('/cek-resi',[CekResiController::class,'Kurir']);
Route::post('/cek-resi',[CekResiController::class,'CekResi'])->name('resi-tracking');
Route::get('/tracking-resi',[CekResiController::class,'LacakResi'])->name('tracking-resi');

