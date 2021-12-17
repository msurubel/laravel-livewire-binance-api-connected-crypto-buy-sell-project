<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Livewire\Component;
use App\Models\transections;

class SingleCryptoTradeList extends Component
{
    protected $listeners = ['OrderListRefresh' => 'mount'];

    public $orders;
    public $symbol;

    public function mount($symbol)
    {
        $this->orders = transections::wheremethod_symbol($symbol)->whereuser_id(Auth::user()->id)->orderBy('id', 'DESC')->get();
    }
    
    public function render()
    {
        return view('livewire.single-crypto-trade-list');
    }
}
