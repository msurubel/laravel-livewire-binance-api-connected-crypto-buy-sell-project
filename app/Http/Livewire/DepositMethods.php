<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use KingFlamez\Rave\Facades\Rave as Flutterwave;
use charlesassets\LaravelPerfectMoney\PerfectMoney;

use Livewire\Component;
use App\Models\getaways;
use App\Models\settings;
use App\Models\transections;
use App\Models\User;
use App\Models\cryptofees;

class DepositMethods extends Component
{

    public $coingetaways;
    public $cardwalletsgetaways;
    public $folded = 1;
    public $getawayid;
    public $needtopay = "0";
    public $amount;
    public $noamount = "";
    public $payamount = "";

    public function mount()
    {
        $this->coingetaways = getaways::wherestatus(1)->wheregetaways_type("coin")->get();
        $this->cardwalletsgetaways = getaways::wherestatus(1)->where('getaways_cat', "noncoin")->get();
        $this->needtopay = "0";
    }

    public function updated()
    {
        $set = settings::findOrFail(1);
        $getawaysdata = getaways::findorFail($this->getawayid);

        if(empty($this->amount)){
            $this->noamount = "#ebc0c0";
            $this->needtopay = "0";
        }else{
            $this->noamount = "";            
            if($getawaysdata->getaways_type == "coin"){            
            
                if($getawaysdata->symbol == "USDT"){
                    $this->needtopay = $this->amount+$set->fees;
                }else{
                    $api = new \Binance\API("$set->api_key","$set->scrt_key");
                    $symbolusdt = $getawaysdata->symbol.'USDT';
                    $getprice = $api->price("$symbolusdt");
    
                    if(cryptofees::wheresymbol($getawaysdata->symbol)->first()){
                        $getfeesdata = cryptofees::wheresymbol($getawaysdata->symbol)->first();
                    }else{
                        $getfeesdata = $set->fees;
                    }
    
                    $amountbycrypto = $this->amount/$getprice;
                    $feesbycrypto = $set->fees/$getprice;
                    $this->needtopay = $amountbycrypto+$feesbycrypto;
                }
    
            }else{        
            $this->needtopay = $this->amount+$set->fees;
            }
        }
    }

    public function noamountclicked()
    {
        $this->noamount = "#ebc0c0";
    }

    public function cryptodepositsub($payamount)
    {
        $set = settings::findOrFail(1);
            $getawaysdata = getaways::findorFail($this->getawayid);
            $refgen = Str::random(10);
            
            if($getawaysdata->symbol == 'USDT')
            {
                $api = new \Binance\API("$set->api_key","$set->scrt_key");
                $api->useServerTime();

                $depositAddress = $api->depositAddress("$getawaysdata->symbol");

                $transections = new transections();
                $transections->user_id = Auth::user()->id;
                $transections->ref = $refgen;
                $transections->method_name = $getawaysdata->name;
                $transections->method_symbol = $getawaysdata->symbol;
                $transections->amount = $payamount;
                $transections->fees = $set->fees;
                $transections->type = 1;
                $transections->status = 1;
                $transections->save();

                $payamount = $this->needtopay;
                $payaddress = $depositAddress['address'];
                $paymethod = $getawaysdata->symbol;
                $ref_id = $refgen;                
                
                return redirect('/dashboard/account/main/deposit/process?payaddress='.$payaddress.'&paymethod='.$paymethod.'&ref_id='.$ref_id.'&payamount='.$payamount.''); 
                
            }
            else
            {              
                $getcrnc = ''.$getawaysdata->symbol.'USDT';
                $api = new \Binance\API("$set->api_key","$set->scrt_key");
                $api->useServerTime();
                $price = $api->price("$getcrnc");
                $depositAddress = $api->depositAddress("$getawaysdata->symbol");

                $transections = new transections();
                $transections->user_id = Auth::user()->id;
                $transections->ref = $refgen;
                $transections->method_name = $getawaysdata->name;
                $transections->method_symbol = $getawaysdata->symbol;
                $transections->amount = $payamount;
                $transections->fees = $set->fees;
                $transections->type = 1;
                $transections->status = 1;
                $transections->save();

                if(cryptofees::wheresymbol($getawaysdata->symbol)->first()){
                    $getfeesdata = cryptofees::wheresymbol($getawaysdata->symbol)->first();
                }else{
                    $getfeesdata = $set->fees;
                }

                $amountwithprice = $payamount/$price;
                $feesamountbycrypto = $set->fees/$price;

                $finalamountvalue = $amountwithprice+$feesamountbycrypto;

                $totalpayamount = $finalamountvalue;
                $payaddress = $depositAddress['address'];
                $paymethod = $getawaysdata->symbol;
                $ref_id = $refgen;
                
                return redirect('/dashboard/account/main/deposit/process?payaddress='.$payaddress.'&paymethod='.$paymethod.'&ref_id='.$ref_id.'&payamount='.$totalpayamount.'');              

            } 
    }


    public function cardorewalletpay ($payamount)
    {
        $user = User::findorFail(Auth::user()->id);
        $set = settings::findOrFail(1);
        $getawaysdata = getaways::findorFail($this->getawayid);
        $refgen = Str::random(10);

        $transections = new transections();
        $transections->user_id = Auth::user()->id;
        $transections->ref = $refgen;
        $transections->method_name = $getawaysdata->name;
        $transections->method_symbol = $getawaysdata->symbol;
        $transections->amount = $payamount;
        $transections->fees = $set->fees;
        $transections->type = 1;
        $transections->status = 1;
        $transections->save();

        if($getawaysdata->name == "Flutterwave"){
            //This generates a payment reference
            $reference = Flutterwave::generateReference();

            // Enter the details of the payment
            $data = [
                'payment_options' => 'card,banktransfer',
                'amount' => $payamount,
                'email' => $user->email,
                'tx_ref' => $refgen,
                'currency' => "USD",
                'redirect_url' => route('callback'),
                'customer' => [
                    'email' => $user->email,
                    "phone_number" => "+8801923094901",
                    "name" => $user->name
                ],

                "customizations" => [
                    "title" => 'Account Deposit and Ref. ID:'.$refgen.'',
                    "description" => "20th October"
                ]
            ];

            $payment = Flutterwave::initializePayment($data);


            if ($payment['status'] !== 'success') {
                // notify something went wrong
                return;
            }
            return redirect($payment['data']['link']);
            
        }elseif($getawaysdata->name == "PerfectMoney"){
            
           PerfectMoney::render(['PAYMENT_AMOUNT' => '100']);           
           //return redirect($pmpay);
        }
    }

    public function inputamount($id)
    {
        $this->getawayid = $id;
        $this->folded = 2;
        $this->needtopay = "0";
        $this->amount = "";
        $this->noamount = "";
    }

    public function foldclose()
    {
        $this->folded = 1;
    }

    public function render()
    {
        return view('livewire.deposit-methods');
    }
}
