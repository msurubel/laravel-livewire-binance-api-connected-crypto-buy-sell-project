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


class Showtradingbuyprice extends Component
{
    public $amount;
    public $symbol;
    public $costs;
    public $userbalance;
    public $ability;
    public $color;
    public $ranges;
    public $buycryptoblnc;
    public $sellcryptoblnc;
    public $notify = 1;
    public $notifytype;
    public $notifymassage;
    public $loading;


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

    public function CryptoBuy()
    {
        $set = settings::findOrFail(1);
        $user = User::findOrFail(Auth::user()->id);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();
        
        if(substr("$this->symbol", -4) == 'USDT'){
            $getfinalpriceusdt = $api->price("$this->symbol");
            $getpriceforavilityamount =  $this->amount*$getfinalpriceusdt;      
            $getbalancedata = $api->balances();
            $blnavilable = $getbalancedata['USDT'];        
            $blnprint = $blnavilable['available'];
        }
        else{
            $cryptoforblndata = substr("$this->symbol", -3);
            $getbalancedata = $api->balances();
            $blnavilable = $getbalancedata["$cryptoforblndata"];        
            $blnprint = $blnavilable['available'];
            
            $getpriceforavility = $api->price("$this->symbol");
            $getpriceforavilityamount = $this->amount*$getpriceforavility;
            }        
        
        if($getpriceforavilityamount<$blnprint){
        
            if(substr("$this->symbol", -4) == 'USDT'){

                $usdtapis = new \Binance\API("$set->api_key","$set->scrt_key");
                $getprice = $usdtapis->price("$this->symbol");
                $amount = $this->amount*$getprice;

                if($user->balance>$amount || $user->balance==$amount)
                {
                $quantity = $this->amount;
                $order = $api->marketBuy("$this->symbol", $quantity);
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
                $userupt->balance = $userupt->balance-$this->amount*$price;
                $userupt->save();

                if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first())
                {
                $balance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -4))->first();
                $balance->balance = $balance->balance+$order['executedQty'];
                $balance->save();
                }
                else
                {
                    $balance = new balances();
                    $balance->user_id = Auth::user()->id;
                    $balance->name = strtolower(substr("$this->symbol", 0, -4));
                    $balance->symbol = substr("$this->symbol", 0, -4);
                    $balance->balance = $balance->balance+$order['executedQty'];
                    $balance->balance_usd = $this->amount*$price;
                    $balance->status = 1;
                    $balance->save(); 
                }

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
            else{
                $othercapis = new \Binance\API("$set->api_key","$set->scrt_key");
                $getprice = $othercapis->price("$this->symbol");
                $amount = $this->amount*$getprice;

                if($user->balance>$amount || $user->balance==$amount)
                {        
                $quantity = $this->amount;
                $order = $api->marketBuy("$this->symbol", $quantity);
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

                if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -3))->first())
                {
                $buybalance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", 0, -3))->first();
                $buybalance->balance = $buybalance->balance+$order['executedQty'];
                $buybalance->save();

                $sellfinalamount = $this->amount*$price;

                $sellbalance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$this->symbol", -3))->first();
                $sellbalance->balance = $sellbalance->balance-$sellfinalamount;
                $sellbalance->save();
                }
                else
                {
                    $balance = new balances();
                    $balance->user_id = Auth::user()->id;
                    $balance->name = substr("$this->symbol", -3);
                    $balance->symbol = substr("$this->symbol", -3);
                    $balance->balance = $balance->balance-$order['executedQty'];
                    $balance->balance_usd = $this->amount*$price;
                    $balance->status = 1;
                    $balance->save(); 
                }


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

                }
                else{
                $this->alert('error', 'You have no balance in your Main Account.', [ 
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

        }
        else{
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

    public function buyrangefst($range)
    {
        $this->notify = 1;
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();
        $price = $api->price("$this->symbol");

        $getpvalue = $this->userbalance;
        $getdp = $getpvalue/100;
        $getbln = $getdp*$range;
        $finalrange = $getbln/$price;

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
        return view('livewire.showtradingbuyprice');
    }
}
