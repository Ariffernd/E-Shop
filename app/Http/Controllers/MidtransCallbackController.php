<?php

namespace App\Http\Controllers;

use App\Models\Shop\OrderProduk;
use Illuminate\Http\Request;

class MidtransCallbackController extends Controller
{
    public function CallbackMidtrans(Request $request){
        $key = config('midtrans.server_key');
        $hashed = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $key);

        if($hashed == $request->signature_key){
            if($request->transaction_status == 'capture'){
                $order = OrderProduk::find($request->order_id);
                if($order){
                    $order->update(['status_transaksi' => 'Paid']);
                }elseif($request->transaction_status == 'Settlement'){
                    $order->update(['status_transaksi' => 'Settled']);
                }elseif($request->transaction_status == 'Pending'){
                    $order->update(['status_transaksi' => 'Pending']);
                }
            }
        }
    }
}
