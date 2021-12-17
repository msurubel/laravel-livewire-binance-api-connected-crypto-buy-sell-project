<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class UserHomeAllCryptoLists extends Component
{
    public $allcryptos;
    public $cryptochanges;
    public $lading = 1;

    public function mount()
    {
        set_time_limit(0);
        $client = new Client();
        $res = $client->get('https://api.binance.com/api/v3/ticker/price')->getBody()->getContents();
        $result = json_decode($res, true);    

        $this->allcryptos = $result;

        $clientchange = new Client();
        $reschange = $clientchange->get('https://api.binance.com/api/v1/ticker/24hr')->getBody()->getContents();
        $resultchange = json_decode($reschange, true);        

        $this->cryptochanges = $resultchange;
    }

    public function refreshalldata()
    {
        set_time_limit(0);
        $client = new Client();
        $res = $client->get('https://api.binance.com/api/v3/ticker/price')->getBody()->getContents();
        $result = json_decode($res, true);    

        $this->allcryptos = $result;

        $clientchange = new Client();
        $reschange = $clientchange->get('https://api.binance.com/api/v1/ticker/24hr')->getBody()->getContents();
        $resultchange = json_decode($reschange, true);        

        $this->cryptochanges = $resultchange;
    }

    public function render()
    {
        return view('livewire.user-home-all-crypto-lists');
    }
}
