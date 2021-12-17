<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Mail\UserVerification;
use App\Mail\TradeConfirmation;

use App\Models\User;
use App\Models\cryptos;
use App\Models\settings;
use App\Models\balances;
use App\Models\deposits;
use App\Models\getaways;
use App\Models\transections;
use App\Models\withdrawals;
use App\Models\withdraw_methods;
use App\Models\ref_history;
use App\Models\blogs;
use App\Models\siteads;
use App\Models\cryptofees;

class TradingPanel extends Component
{

    public $symbol;
    public $amount = 0;


    public function cryptobuy()
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
                    $balance->name = substr("$this->symbol", 0, -4);
                    $balance->symbol = substr("$this->symbol", 0, -4);
                    $balance->balance = $balance->balance+$order['executedQty'];
                    $balance->balance_usd = $this->amount*$price;
                    $balance->status = 1;
                    $balance->save(); 
                }

                Toastr::success('Order Successfully Created', 'Success', ['options']);
                return back();
                }
                else{
                Toastr::warning('You have no balance in your Main Account', 'No Balance', ['options']);
                return back();
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

                Toastr::success('Order Successfully Created', 'Success', ['options']);
                return back();
                }
                else{
                Toastr::warning('You have no balance in your Main Account', 'No Balance', ['options']);
                return back();
                }
            }

        }
        else{
            Toastr::warning('We are not execute your order now, Please contact with our support center.', 'Sorry!');
            return back();
        }
    }


    public function render()
    {
        return view('livewire.trading-panel');
    }
}
