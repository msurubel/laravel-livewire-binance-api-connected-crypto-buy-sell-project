<?php

namespace App\Http\Livewire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Brian2694\Toastr\Facades\Toastr;

use Livewire\Component;
use App\Models\settings;
use App\Models\User;
use App\Models\deposits;
use App\Models\withdrawals;
use App\Models\cryptofees;

class CryptoExchangeWidget extends Component
{
    protected $listeners = ['RefreshWidgetNew' => 'mount'];

    public $set;
    public $user;
    public $cryptolist;
    public $exchangep = 1;
    public $amount = 0;
    public $trxref_id;
    public $btnhide = 2;
    public $paysymbol;
    public $getsymbol;
    public $payamount;
    public $getamount;
    public $payinvalid;
    public $payinvalidcolor;
    public $getinvalid;
    public $getinvalidcolor;
    public $refname;
    public $refid;
    public $feesusd;
    public $feestotal;
    public $payaddress;
    public $getaddress;
    public $payamountp;
    public $paysymbolp;
    public $trxid;
    public $userrefid;
    public $inputfeestotal;
    public $inputfeesusd;
    public $txid;

    public function mount($referralid)
    {
        $this->set = settings::findOrFail(1);        
        $this->cryptolist = Http::get('https://api.binance.com/api/v1/ticker/price')->json();
        if(User::whereref_id($referralid)->first()){
        $user = User::whereref_id($referralid)->first();
        $this->refname = $user->name;
        $this->userrefid = $referralid;

        $this->paysymbol = "";
        $this->payamount = "";
        $this->getsymbol = "";
        $this->getamount = "0";
        }else{

        }
    }


    public function exchangeorder()
    {
        $ref = Str::random(10);
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();

        if(User::whereref_id($this->userrefid)->first()){
            $user = User::whereref_id($this->userrefid)->first();
            $this->refname = $user->name;

            $deposit = new deposits();
            $deposit->user_id = 1;
            $deposit->purpose = 'For Exchange';
            $deposit->name = $this->paysymbol;
            $deposit->symbol = strtoupper($this->paysymbol);
            $deposit->ref_id = $ref;
            $deposit->trx_amount = $this->inputfeestotal;
            $deposit->trx_amount_usd = 0;
            $deposit->fees = $this->inputfeesusd;
            $deposit->status = 1;
            $deposit->save();

            $withdraw = new withdrawals();
            $withdraw->user_id = 1;
            $withdraw->crypto_id = 1;
            $withdraw->ref = $ref;
            $withdraw->referred_by = $this->userrefid;
            $withdraw->method_name = 'Exchange Withdrawals';
            $withdraw->method_symbol = strtoupper($this->getsymbol);
            $withdraw->method_details = $this->getaddress;
            $withdraw->amount = $this->getamount;
            $withdraw->pay_amount = $this->feestotal;
            $withdraw->pay_symbol = $this->paysymbol;
            $withdraw->amount_usd = 0;
            $withdraw->fees = $this->inputfeesusd;
            $withdraw->status = 1;
            $withdraw->save();            

            $symbolreadyforaddress = strtoupper($this->paysymbol);
            $getpaymentaddress = $api->depositAddress("$symbolreadyforaddress");
            $this->payaddress = $getpaymentaddress['address'];
            $this->payamountp = $this->payamount;
            $this->paysymbolp = $this->paysymbol;
            $this->trxid = $ref;

            $this->exchangep = 2;
        }else{            
            
            
        }
    }


    public function addTrxID()
    {
        $txid = withdrawals::whereref($this->trxid)->first();
        $txid->crypto_txid = $this->txid;
        $txid->save();

        $this->exchangep = 3;
    }

    public function backtohome()
    {
        $this->exchangep = 1;
    }

    public function updated()
    {
        if($this->paysymbol == $this->getsymbol)
        {
            $this->btnhide = 1;
        }
        else
        {
            $this->btnhide = 2;

            $cryptolist = Http::get('https://api.binance.com/api/v1/ticker/price')->json();
            $collection = collect($cryptolist);
            
            //Pay Invalid Finding
            $selectcrypto = ''.strtoupper($this->paysymbol).'USDT';            
            if($collection->where('symbol', $selectcrypto)->first()){                

                $this->payinvalid = 'Correct!';
                $this->payinvalidcolor = "#b6f1bf";                
            }
            else{
                $this->payinvalid = 'Not Valid!';
                $this->payinvalidcolor = "#f1b6b6";
            }   

            if(empty($this->txid)){

            }
            
            //Pay Invalid Finding
            $getselectcrypto = ''.strtoupper($this->getsymbol).'USDT';
            if($collection->where('symbol', $getselectcrypto)->first()){
                $this->getinvalid = 'Correct!';
                $this->getinvalidcolor = "#b6f1bf";

                if(empty($this->paysymbol)){
            
                }else{
                    if(empty($this->getsymbol)){
        
                    }else{
                        if($collection->where('symbol', $selectcrypto)->first()){
                            $set = settings::findOrFail(1);
                            $api = new \Binance\API("$set->api_key","$set->scrt_key");
                            $api->useServerTime();
            
                            $paycrypto = ''.strtoupper($this->paysymbol).'USDT';
                            $getcryto = ''.strtoupper($this->getsymbol).'USDT';                
                            $payprice = $api->price("$paycrypto");
                            $getprice = $api->price("$getcryto");
            
                            $payvalue = $this->payamount*$payprice;
                            if($this->getsymbol == 'BTC'){
                                $this->getamount = $payvalue*$getprice;
                            }else{
                                $this->getamount = $payvalue/$getprice;
                            }

                            if(cryptofees::wheresymbol($this->paysymbol)->first()){
                                $fees = cryptofees::wheresymbol($this->paysymbol)->first();
                                $feessymbol = ''.$fees->symbol.'USDT';
                                $paycryptofeesprice = $api->price("$feessymbol");

                                $feesincrypto = $fees->fees_usd/$paycryptofeesprice;

                                $this->feesusd = $fees->fees_usd;
                                $this->feestotal = $this->payamount+$feesincrypto;
                                $this->inputfeesusd = $fees->fees_usd;
                                $this->inputfeestotal = $this->payamount+$feesincrypto;
                            }else{
                                $fees = $set->withdraw_fees;
                                $paycryptofeesprice = $api->price("$paycrypto");

                                $feesincrypto = $fees/$paycryptofeesprice;

                                $this->feesusd = $fees;
                                $this->feestotal = $this->payamount+$feesincrypto;
                                $this->inputfeesusd = $fees;
                                $this->inputfeestotal = $this->payamount+$feesincrypto;
                            }
                        }else{

                        }
                        
                    }
                } 
            }
            else{
                $this->getamount = 0;
                $this->getinvalid = 'Not Valid!';
                $this->getinvalidcolor = "#f1b6b6";
            }
            
        }
    }

    public function pricerefresh()
    {

        if(empty($this->paysymbol) | empty($this->getsymbol) ){        
            
        }
        else{            

            if(empty($this->paysymbol)){
            
            }else{
                if(empty($this->getsymbol)){
    
                }else{
                    
                    if($this->paysymbol == $this->getsymbol)
        {
            $this->btnhide = 1;
        }
        else
        {
            $this->btnhide = 2;

            $cryptolist = Http::get('https://api.binance.com/api/v1/ticker/price')->json();
            $collection = collect($cryptolist);
            
            //Pay Invalid Finding
            $selectcrypto = ''.strtoupper($this->paysymbol).'USDT';            
            if($collection->where('symbol', $selectcrypto)->first()){                

                $this->payinvalid = 'Correct!';
            }
            else{
                $this->payinvalid = 'Not Valid!';
            }   

            if(empty($this->txid)){

            }
            
            //Pay Invalid Finding
            $getselectcrypto = ''.strtoupper($this->getsymbol).'USDT';
            if($collection->where('symbol', $getselectcrypto)->first()){
                $this->getinvalid = 'Correct!';

                if(empty($this->paysymbol)){
            
                }else{
                    if(empty($this->getsymbol)){
        
                    }else{
                        if($collection->where('symbol', $selectcrypto)->first()){
                            $set = settings::findOrFail(1);
                            $api = new \Binance\API("$set->api_key","$set->scrt_key");
                            $api->useServerTime();
            
                            $paycrypto = ''.strtoupper($this->paysymbol).'USDT';
                            $getcryto = ''.strtoupper($this->getsymbol).'USDT';                
                            $payprice = $api->price("$paycrypto");
                            $getprice = $api->price("$getcryto");
            
                            $payvalue = $this->payamount*$payprice;
                            if($this->getsymbol == 'BTC'){
                                $this->getamount = $payvalue*$getprice;
                            }else{
                                $this->getamount = $payvalue/$getprice;
                            }

                            if(cryptofees::wheresymbol($this->paysymbol)->first()){
                                $fees = cryptofees::wheresymbol($this->paysymbol)->first();
                                $feessymbol = ''.$fees->symbol.'USDT';
                                $paycryptofeesprice = $api->price("$feessymbol");

                                $feesincrypto = $fees->fees_usd/$paycryptofeesprice;

                                $this->feesusd = $fees->fees_usd;
                                $this->feestotal = $this->payamount+$feesincrypto;
                                $this->inputfeesusd = $fees->fees_usd;
                                $this->inputfeestotal = $this->payamount+$feesincrypto;
                            }else{
                                $fees = $set->withdraw_fees;
                                $paycryptofeesprice = $api->price("$paycrypto");

                                $feesincrypto = $fees/$paycryptofeesprice;

                                $this->feesusd = $fees;
                                $this->feestotal = $this->payamount+$feesincrypto;
                                $this->inputfeesusd = $fees;
                                $this->inputfeestotal = $this->payamount+$feesincrypto;
                            }
                        }else{

                        }
                        
                    }
                } 
            }
            else{
                $this->getamount = 0;
                $this->getinvalid = 'Not Valid!';
            }
            
        }
                    
                }
            } 

            if($this->paysymbol == $this->getsymbol)
            {
                $this->btnhide = 1;
            }
            else
            {
                $this->btnhide = 2;
            }
        }
    }

    public function render()
    {
        return view('livewire.crypto-exchange-widget');
    }
}
