<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\balances;
use App\Models\settings;
use App\Models\locked_balances;

class SingleCryptoBalance extends Component
{
    protected $listeners = ['SingleCryptoBalanceLoad' => 'UpdateAssetsAll'];

    public $symbol;
    public $buycryptoblnc;
    public $balance_usd;
    public $getsymbol;
    public $lockedbalance;
    public $set;
    public $writelockedamount = "show";
    public $lockedamount;
    public $lockedamountprofit;
    public $showprofitwithdraw = 1;


    public function UpdateAssetsAll()
    {
        
        if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first()){
        $getblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first();
        $this->buycryptoblnc = $getblnc->balance;
        }
        else{
            $this->balance_usd = '0';
        } 

        if(substr($this->symbol, -4) == 'USDT'){
            $getsymbol = substr($this->symbol, 0, -4);
        }else{
            $getsymbol = substr($this->symbol, 0, -3);
        }
        
        if(locked_balances::whereuser_id(Auth::user()->id)->wheresymbol($getsymbol)->first()){
            $lockeddataamount = locked_balances::whereuser_id(Auth::user()->id)->wheresymbol($getsymbol)->first();
            $lockeddataprofit = locked_balances::whereuser_id(Auth::user()->id)->wheresymbol($getsymbol)->first();
            $this->lockedamount = $lockeddataamount->locked_amount;
            $this->lockedamountprofit = $lockeddataprofit->profit;
        }
        else{
            $this->lockedamount = '0';
            $this->lockedamountprofit = '0';
        }
        
    }


    public function lockedprofitfolded()
    {
        $this->showprofitwithdraw = 2;
    }

    public function lockedprofitfoldedclose()
    {
        $this->showprofitwithdraw = 1; 
    }

    public function ShowLockedAmountInpute(){
        $this->writelockedamount = "hide";
    }

    public function mount($symbol)
    {
        $this->set = settings::findOrFail(1);
        if(substr("$this->symbol", -4) == 'USDT'){
            if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first()){
            $getblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first();
            $this->buycryptoblnc = $getblnc->balance;
            $this->balance_usd = $getblnc->balance_usd;
            $this->getsymbol = substr("$symbol", 0, -4);
            }
            else{
                $this->buycryptoblnc = '0';
                $this->balance_usd = '0';
                $this->getsymbol = substr("$symbol", 0, -4);
            }

            if(locked_balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first()){
            $lockeddataamount = locked_balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first();
            $lockeddataprofit = locked_balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first();
            $this->lockedamount = $lockeddataamount->locked_amount;
            $this->lockedamountprofit = $lockeddataprofit->profit;
            }
            else{
                $this->lockedamount = '0';
                $this->lockedamountprofit = '0';
            }
            
        }
        else{
            if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -3))->first()){
                $getblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -3))->first();
                $this->buycryptoblnc = $getblnc->balance;
                $this->balance_usd = $getblnc->balance_usd;
                $this->getsymbol = substr("$symbol", 0, -3);
                }
                else{
                    $this->buycryptoblnc = '0';
                    $this->balance_usd = '0';
                    $this->getsymbol = substr("$symbol", 0, -3);
                }

                if(locked_balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -3))->first()){
                $lockeddataamount = locked_balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -3))->first();
                $lockeddataprofit = locked_balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -3))->first();
                $this->lockedamount = $lockeddataamount->locked_amount;
                $this->lockedamountprofit = $lockeddataprofit->profit;
                }
                else{
                    $this->lockedamount = '0';
                    $this->lockedamountprofit = '0';
                }
        }

        $this->lockedbalance = "0";
        
    }    


    public function render()
    {
        return view('livewire.single-crypto-balance');
    }
}
