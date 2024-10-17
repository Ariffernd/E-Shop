<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CekResiController extends Controller
{



    public function Kurir()
    {
        $response = Http::withHeaders([
            'X-RapidAPI-host' => config('cek-resi.CEKRESI_ENDPOINT'),
            'X-RapidAPI-key' => config('cek-resi.CEK_RESI_KEY'),
        ])->get('https://cek-resi-cek-ongkir.p.rapidapi.com/general/logistics');


        if ($response->failed() && $response->status() == 429) {
            abort(429);
        }

        $data = $response->json('results');

        return view('Shop.cek-resi', compact('data'));
    }

    public function CekResi(Request $request)
    {
        $validatedData = $request->validate([
            'kurir' => 'required',
            'resi' => 'required'
        ]);

        $ekspedisi = $validatedData['kurir'];
        $resi = $validatedData['resi'];

        return redirect()->route('tracking-resi', compact('ekspedisi', 'resi'));
    }

    public function LacakResi(Request $request)
    {
        $ekspedisi = $request->input('ekspedisi');
        $resi = $request->input('resi');


        $response = Http::withHeaders([
            'X-RapidAPI-host' => config('cek-resi.CEKRESI_ENDPOINT'),
            'X-RapidAPI-Key' => config('cek-resi.CEK_RESI_KEY'),
        ])->get('https://cek-resi-cek-ongkir.p.rapidapi.com/tracking', [
            'logisticId' => $ekspedisi,
            'trackingNumber' => $resi
        ]);

        $data = $response->json();
        $details = $data['results']['details'] ?? [];

        $jsonDetails = json_encode($details);

        return view('Shop.res.res-cek-resi', compact('jsonDetails'));
    }
}
