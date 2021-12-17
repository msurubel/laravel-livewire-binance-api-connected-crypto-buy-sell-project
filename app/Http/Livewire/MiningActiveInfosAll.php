<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\miningcryptos;
use App\Models\settings;


class MiningActiveInfosAll extends Component
{
    public $totalkhs;
    public $totalminingusd;
    public $activecoins;

    public function mount()
    {
        $this->totalkhs = miningcryptos::whereuser_id(Auth::user()->id)->sum('mining_power');
        $this->activecoins = miningcryptos::whereuser_id(Auth::user()->id)->wherestatus(1)->count();
        $this->totalminingusd = miningcryptos::whereuser_id(Auth::user()->id)->sum('minig_balance_usd');
    }

    public function refreshdataall()
    {
        $this->totalkhs = miningcryptos::whereuser_id(Auth::user()->id)->sum('mining_power');
        $this->activecoins = miningcryptos::whereuser_id(Auth::user()->id)->wherestatus(1)->count();
        $this->totalminingusd = miningcryptos::whereuser_id(Auth::user()->id)->sum('minig_balance_usd');
    }

    public function render()
    {
        return view('livewire.mining-active-infos-all');
    }
}
