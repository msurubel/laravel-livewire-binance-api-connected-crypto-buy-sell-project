<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

use Livewire\Component;
use App\Models\balances;
use App\Models\settings;

class SingleCryptoUSDBalance extends Component
{
    public $symbol;
    public $usdbalance;

    public function mount()
    {
        if(balances::wheresymbol($this->symbol)->whereuser_id(Auth::user()->id)->first()){
        $cryptobalance = balances::wheresymbol($this->symbol)->whereuser_id(Auth::user()->id)->first()->balance;        
        $this->usdbalance = balances::wheresymbol($this->symbol)->whereuser_id(Auth::user()->id)->first()->balance_usd;
        }else{
            $this->usdbalance = '0';
        }
    }

    public function LiveUpdateAuto()
    {
        if(balances::wheresymbol($this->symbol)->whereuser_id(Auth::user()->id)->first()){
        $cryptobalance = balances::wheresymbol($this->symbol)->whereuser_id(Auth::user()->id)->first()->balance;        
        $this->usdbalance = balances::wheresymbol($this->symbol)->whereuser_id(Auth::user()->id)->first()->balance_usd;
        }else{
            $this->usdbalance = '0';
        }
    }

    public function render()
    {
        return view('livewire.single-crypto-u-s-d-balance');
    }
}
