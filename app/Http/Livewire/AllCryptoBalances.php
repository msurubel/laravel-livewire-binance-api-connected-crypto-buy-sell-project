<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

use App\Models\balances;
use App\Models\getaways;
use App\Models\settings;

class AllCryptoBalances extends Component
{
    public $balances;
    public $assets;
    public $found = 1;
    public $getbalancesall;
    public $totalbalance;
    public $getaways;
    public $set;


    public function mount() 
    {
        $this->balances = balances::whereuser_id(Auth::user()->id)->get();
        $this->getaways = getaways::wherestatus(1)->get();
        $this->set = settings::findOrFail(1);

        $blnc = balances::whereuser_id(Auth::user()->id)->get();       
        $this->totalbalance = $blnc->sum('balance_usd');
    }

    public function UpdateAssetsAll()
    {
        $blnc = balances::whereuser_id(Auth::user()->id)->get();       
        $this->totalbalance = $blnc->sum('balance_usd');

        if(empty($this->assets)){
        $this->balances = balances::whereuser_id(Auth::user()->id)->get();
        }
        else{
            if(balances::whereuser_id(Auth::user()->id)->wheresymbol($this->assets)->first()){
                $this->balances = balances::whereuser_id(Auth::user()->id)->wheresymbol($this->assets)->get();
                $this->found = 1;
            }
            else{
                $this->found = 0;
            }        
        }
    }

    public function updated()
    {
        if(empty($this->assets)){
            $this->balances = balances::whereuser_id(Auth::user()->id)->get();
            $this->found = 1;
        }
        else{
            if(balances::whereuser_id(Auth::user()->id)->wheresymbol($this->assets)->first()){
                $this->balances = balances::whereuser_id(Auth::user()->id)->wheresymbol($this->assets)->get();
                $this->found = 1;
            }
            else{
                $this->found = 0;
            }        
        }
    }


    public function render()
    {
        return view('livewire.all-crypto-balances');
    }
}
