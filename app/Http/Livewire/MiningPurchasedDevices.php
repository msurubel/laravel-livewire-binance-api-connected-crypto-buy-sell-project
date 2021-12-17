<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

use App\Models\User;
use App\Models\setmininglist;
use App\Models\miningcryptos;
use App\Models\settings;
use App\Models\miningdevices;
use App\Models\buyminingdevice;

class MiningPurchasedDevices extends Component
{

    protected $listeners = ['RefreshBuyDevices' => 'mount'];

    public $buydevice;

    public function mount()
    {
        $this->buydevice = buyminingdevice::whereuser_id(Auth::user()->id)->orderBy('id', 'DESC')->get();
    }

    public function liveupdatealldata()
    {
        $this->buydevice = buyminingdevice::whereuser_id(Auth::user()->id)->orderBy('id', 'DESC')->get(); 
    }

    public function render()
    {
        return view('livewire.mining-purchased-devices');
    }
}
