<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\miningcryptos;

class MiningCryptosAll extends Component
{
    public $miningcryptos;

    public function mount()
    {
        $this->miningcryptos = miningcryptos::whereuser_id(Auth::user()->id)->get();
    }
    
    public function render()
    {
        return view('livewire.mining-cryptos-all');
    }
}
