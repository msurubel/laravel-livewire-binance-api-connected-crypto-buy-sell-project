<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class APIController extends Controller
{
    public function CryptoData (){
        $cryptos = Http::get("https://api.binance.com/api/v3/ticker/price");
        dd($cryptos->json());
    }
}
