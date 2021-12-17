<?php

namespace App\Http\Livewire;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use App\Models\settings;
use App\Models\balances;
use App\Models\locked_balances;

class SingleCryptoButtons extends Component
{
    public $amount;
    public $lockeddays;
    public $crypto_symbol;
    public $showinpute = "hide";
    public $earnings;
    public $symbol;
    public $ranges;
    public $color;
    public $usdvalue;
    public $set;

    public function updated()
    {
        if(empty($this->amount)){

        }else{
            if(empty($this->lockeddays)){

            }else{               

                $set = settings::findOrFail(1);
                $getsinglepercent = $this->amount/100;
                $getpercentageamount = $getsinglepercent*$set->locked_amount_profit;
                $daydevided = $getpercentageamount/30;       
                $this->earnings = $daydevided*$this->lockeddays;
            }
        }
    }

    public function mount()
    {
        $this->set = settings::findOrFail(1);
    }

    public function buyrangefst($range)
    {
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();

        if(substr($this->symbol, -4) == 'USDT'){
            $getsymbol = substr($this->symbol, 0, -4).'USDT';
        }else{
            $getsymbol = substr($this->symbol, 0, -3).'USDT';
        }
        
        if(substr($this->symbol, -4) == 'USDT'){
            $balancedata = balances::wheresymbol(substr($this->symbol, 0, -4))->whereuser_id(Auth::user()->id)->first();
        }else{
            $balancedata = balances::wheresymbol(substr($this->symbol, 0, -3))->whereuser_id(Auth::user()->id)->first();
        }
        
        $balancerange = $balancedata->balance/100;
        $this->amount = $balancerange*$range;

        $getsinglepercent = $this->amount/100;
        $getpercentageamount = $getsinglepercent*$set->locked_amount_profit;
        $daydevided = $getpercentageamount/30;
        $getprice = $api->price("$getsymbol");

        $this->earnings = $daydevided*$this->lockeddays;
        $this->usdvalue = $this->amount*$getprice; 
        $this->ranges = $range;
        $this->color = 'active';
        $this->lockeddays = 30;

        $getsinglepercent = $this->amount/100;
        $getpercentageamount = $getsinglepercent*$set->locked_amount_profit;
        $daydevided = $getpercentageamount/30;       
        $this->earnings = $daydevided*$this->lockeddays;
    }

    public function showinputeclick()
    {
        $this->showinpute = "show";
    }

    public function hideinputeclick()
    {
        $this->showinpute = "hide";
    }

    public function LockNowAmount()
    {
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();

        if(substr($this->symbol, -4) == 'USDT'){
            $getsymbol = substr($this->symbol, 0, -4).'USDT';
        }else{
            $getsymbol = substr($this->symbol, 0, -3).'USDT';
        }

        if(substr($this->symbol, -4) == 'USDT'){
            $getlockedsymbol = substr($this->symbol, 0, -4);
        }else{
            $getlockedsymbol = substr($this->symbol, 0, -4);
        }

        $getsymbolprice = $api->price("$getsymbol");
        $getusdbyamount = $this->amount*$getsymbolprice;

        if($getusdbyamount>$set->locked_amount_minimum || $getusdbyamount == $set->locked_amount_minimum){
            
            if(locked_balances::whereuser_id(Auth::user()->id)->wheresymbol($getlockedsymbol)->first()){
                $newamountlocked = number_format ($this->amount, 16);
                $createlock = locked_balances::whereuser_id(Auth::user()->id)->wheresymbol($getlockedsymbol)->first();                
                $createlock->locked_amount = $createlock->locked_amount+$newamountlocked;
                $createlock->save();
            }else{
                $createlock = new locked_balances();
                $createlock->user_id = Auth::user()->id;
                if(substr($this->symbol, -4) == 'USDT'){
                    $createlock->symbol = substr($this->symbol, 0, -4);
                }else{
                    $createlock->symbol = substr($this->symbol, 0, -3);
                }
                $createlock->locked_amount = number_format ($this->amount, 16);
                $createlock->profit = 0;
                $createlock->locked_days = $this->lockeddays;
                $createlock->status = 1;
                $createlock->save();
            }

            if($createlock){
                if(substr($this->symbol, -4) == 'USDT'){
                    $balancedata = balances::wheresymbol(substr($this->symbol, 0, -4))->whereuser_id(Auth::user()->id)->first();
                }else{
                    $balancedata = balances::wheresymbol(substr($this->symbol, 0, -3))->whereuser_id(Auth::user()->id)->first();
                }

                $balancedata->balance = $balancedata->balance-$this->amount;
                $balancedata->save();
                $this->emit('SingleCryptoBalanceLoad');

                $this->amount = 0;
                $this->lockeddays = "30";
                $this->ranges = "";
                $this->usdvalue = 0;

                $this->alert('success', 'Amount Successfully Locked.', [ 
                    'timer' =>  '5500', 
                    'toast' =>  true, 
                    'text' =>  '', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Cancel', 
                    'showCancelButton' =>  false, 
                    'showConfirmButton' =>  false, 
                ]);
            }else{

            }
        }else{
            $this->alert('error', 'The amount must be greater than or equal to the minimum amount.', [
                'timer' =>  '5500', 
                'toast' =>  true, 
                'text' =>  '', 
                'confirmButtonText' =>  'Ok', 
                'cancelButtonText' =>  'Cancel', 
                'showCancelButton' =>  false, 
                'showConfirmButton' =>  false, 
          ]);
        }
    }


    public function render()
    {
        return view('livewire.single-crypto-buttons');
    }
}
