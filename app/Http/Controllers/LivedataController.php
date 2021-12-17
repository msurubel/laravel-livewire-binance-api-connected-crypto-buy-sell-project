<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\Models\cryptos;
use App\Models\settings;
use App\Models\balances;
use App\Models\miningcryptos;

class LivedataController extends Controller
{
    public function getbalance()
    {
        $blnc = balances::whereuser_id(Auth::user()->id)->get();
        $data['totalbalance'] = $blnc->sum('balance_usd');
        
        return view('user.livedata.get_balance', $data);
    }

    public function getcryptos()
    {
        $data['cryptos'] = cryptos::whereStatus(1)->limit(12)->get();
        $data['set'] = settings::findOrFail(1);
        
        return view('user.livedata.get_cryptos', $data);
    }

    public function GetCryptoBalance()
    {
        $data['balances'] = balances::whereuser_id(Auth::user()->id)->limit(7)->get();
        $data['set'] = settings::findOrFail(1);
        
        return view('user.livedata.get_crypto_blnc', $data);
    }

    public function GetCryptoBalanceAll()
    {
        $data['balances'] = balances::whereuser_id(Auth::user()->id)->get();
        $data['set'] = settings::findOrFail(1);
        
        return view('user.livedata.get_crypto_blnc_all', $data);
    }

    public function CryptoMiningAssetsUpdate()
    {
        $data['miningcryptos'] = miningcryptos::whereuser_id(Auth::user()->id)->get();
        return view('user.livedata.mining_cryptos', $data);
    }

    public function CryptoMiningAssetsUpdateShortInfos()
    {
        $data['totalkhs'] = miningcryptos::whereuser_id(Auth::user()->id)->sum('mining_power');
        $data['totalminingusd'] = miningcryptos::whereuser_id(Auth::user()->id)->sum('minig_balance_usd');
        $data['activecoins'] = miningcryptos::whereuser_id(Auth::user()->id)->wherestatus(1)->count();
        return view('user.livedata.mining_cryptos_totalinfos', $data);
    }

    public function GetCryptosOrders($id)
    {
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();
        $cryptobln = balances::findOrFail($id);
        $cryptocoin = ''.$cryptobln->symbol.''.$set->main_crypto;
        $data['orders'] = $api->openOrders("BTCUSDT");

        $orders = $api->openOrders("$cryptocoin");
        print_r($orders);
        //return view('user.livedata.get_crypto_orders', $data);
    }

    public function GetCryptosAll()
    {
        $data['tittle'] = 'User Dashboard - Cryptos';
        $data['cryptos'] = cryptos::wherestatus(1)->get();
        $data['set'] = settings::findOrFail(1);
        
        return view('user.livedata.get_cryptos_all', $data);
    }


    public function GetCryptosAllFront()
    {
        $data['tittle'] = 'Home';
        $data['set'] = settings::findOrFail(1);
        $data['cryptos'] = cryptos::wherestatus(1)->limit(12)->get();
        return view('front.livedata.get_cryptos', $data);
    }

}
