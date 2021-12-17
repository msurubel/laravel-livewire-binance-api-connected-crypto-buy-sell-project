<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Livewire\Component;
use App\Models\settings;
use App\Models\User;
use App\Models\balances;

class Showtradingsellprice extends Component
{
    public $amount;
    public $symbol;
    public $costs;
    public $userbalance;
    public $ability;
    public $color;
    public $ranges;
    public $loading;
    public $buycryptoblnc;
    public $sellcryptoblnc;
    public $notify = 1;
    public $notifytype;
    public $notifymassage;


    public function mount($userbalance)
    {
        $this->userbalance = $userbalance;

        if(substr("$this->symbol", -4) == 'USDT'){
            if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first()){
            $getblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first();
            $this->buycryptoblnc = $getblnc->balance;
            }
            else{
                $this->buycryptoblnc = '0';
            }
        }
        else{
            if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -3))->first()){
                $getblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -3))->first();
                $this->buycryptoblnc = $getblnc->balance;
                }
                else{
                    $this->buycryptoblnc = '0';
                }
        }

        if(substr("$this->symbol", -4) == 'USDT'){
            $sellblncuser = user::findOrFail(Auth::user()->id);
            $sellblncget =  $sellblncuser->balance;
            $this->sellcryptoblnc = $sellblncget;
        }
        else{
            if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", -3))->first()){
                $getblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", -3))->first();
                $this->sellcryptoblnc = $getblnc->balance;
                }
                else{
                    $this->sellcryptoblnc = '0';
                }
        }
    }

    public function CryptoSell()
    {
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();

        if(substr("$this->symbol", -4) == 'USDT'){
            $cryptoforblndata = substr("$this->symbol", 0, -4);
            $getbalancedata = $api->balances();
            $blnavilable = $getbalancedata["$cryptoforblndata"];        
            $blnprint = $blnavilable['available'];
     
            $getpriceforavilityamount = $this->amount;
        }
        else{
            $cryptoforblndata = substr("$this->symbol", -3);
            $getbalancedata = $api->balances();
            $blnavilable = $getbalancedata["$cryptoforblndata"];        
            $blnprint = $blnavilable['available'];
         
            $getpriceforavilityamount = $this->amount;
            }

        if($getpriceforavilityamount<$blnprint){

            if(substr("$this->symbol", -4) == 'USDT'){

                if(balances::wheresymbol(substr("$this->symbol", 0, -4))->whereuser_id(Auth::user()->id)->first()){
                $cryptoblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first();
                $cryptoblncdata = $cryptoblnc->balance;
                }
                else
                {
                    $cryptoblncdata = 0; 
                }

                if($cryptoblncdata>$this->amount || $cryptoblncdata==$this->amount)
                {        
                $quantity = $this->amount;
                $order = $api->marketSell("$this->symbol", $quantity);
                $price = $api->price("$this->symbol");

                $transections = new transections();
                $transections->user_id = Auth::user()->id;
                $transections->ref = Str::random(10);
                $transections->orderId = $order['orderId'];
                $transections->clientOrderId = $order['clientOrderId'];
                $transections->method_name = $this->symbol;
                $transections->method_symbol = $this->symbol;
                $transections->amount = $order['executedQty'];
                $transections->price = $price;
                $transections->cost = $this->amount*$price;
                $transections->market_type = $order['type'];
                $transections->market_side = $order['side'];
                $transections->fees = $set->fees;
                $transections->type = 2;
                $transections->status = $order['status'];
                $transections->save();

                $userupt = User::findOrFail(Auth::user()->id);
                $userupt->balance = $userupt->balance+$this->amount*$price;
                $userupt->save();
                
                $balance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first();
                $balance->balance = $balance->balance-$this->amount;
                $balance->save();


                $details = [
                    'name' => "$user->name",
                    'refid' => "$transections->ref",
                    'orderid' => "$transections->orderId",
                    'symbol' => "$this->symbol",
                    'amount' => "$transections->amount",
                    'cost' => "$this->amount*$price",
                    'markettype' => "$transections->market_type",
                    'marketside' => "$transections->market_side",
                    'status' => "$transections->status",

                ];
        
                Mail::to("$user->email")->send(new TradeConfirmation($details));

                $this->alert('success', 'Order Successfully Created.', [
                    'timer' =>  '5500', 
                    'toast' =>  true, 
                    'text' =>  '', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Cancel', 
                    'showCancelButton' =>  false, 
                    'showConfirmButton' =>  false, 
                ]);

                $this->emit('OrderListRefresh');
                $this->emit('SingleCryptoBalanceLoad');
                }
                else{                

                $this->alert('error', 'You have no balance in your Account.', [ 
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

            else
            {
                

            }

        }else{
            $this->alert('error', 'We are not execute your order now.', [ 
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

    public function sellrangefst($range)
    {       
        $this->notify = 1; 
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();
        $price = $api->price("$this->symbol");

        $getpvalue = $this->userbalance;
        $getdp = $getpvalue/100;
        $getbln = $getdp*$range;
        $finalrange = $getbln;

        $this->amount = str_replace(',', '', number_format("$finalrange", 6));
        $this->ranges = $range;
        $this->color = 'active';

        if($this->amount == 0){
            $this->costs = 0;
        }
        else{
            $this->costs = $finalrange*$price;               
        }     
        
    }

    public function updated($amount, $symbol)
    {        
        $this->notify = 1;
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();
        $price = $api->price("$this->symbol");

            if($this->amount == 0){
                $this->costs = 0;
            }
            else{
                $this->costs = $this->amount*$price;
                $this->ranges = 100;               
            }                              
             
        
    }

    public function render()
    {
        return view('livewire.showtradingsellprice');
    }
}
