<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Brian2694\Toastr\Facades\Toastr;

use GuzzleHttp\Client;

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
use App\Models\miningcryptos;
use App\Models\setmininglist;
use App\Models\buyminingdevice;



class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {        
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
  


    public function index()
    {
        $data['tittle'] = 'User Dashboard';
        $blnc = balances::whereuser_id(Auth::user()->id)->get();
        $data['cryptos'] = cryptos::whereStatus(1)->limit(12)->get();
        $data['totalbalance'] = $blnc->sum('balance_usd');
        $data['balances'] = balances::whereuser_id(Auth::user()->id)->limit(7)->get();
        $data['set'] = settings::findOrFail(1);

        $data['ads'] = siteads::wherestatus(1)->inRandomOrder()->limit(1)->get();
        $data['singlechart'] = balances::whereuser_id(Auth::user()->id)->wherestatus(1)->inRandomOrder()->limit(1)->get();

        $data['transections'] = transections::whereuser_id(Auth::user()->id)->wheretype(3)->orderBy('id', 'DESC')->get();
        $data['monthwisebalance'] = transections::whereuser_id(Auth::user()->id)->wheretype(1)->wherestatus(3)->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->get(['cost','created_at']);
        $data['blogs'] = blogs::wherestatus(1)->orderBy('id', 'DESC')->limit(3)->get();        
        
        return view('user.dashboard', $data);

    }


    public function demo()
    {
        Toastr::warning('Demo Version not allowed for any changes.', 'Warning', ['options']);
        return back();
    }


    public function UserThemeColorChange($id, $set)
    {
        $user = User::findOrFail($id);
        $user->theme_set = $set;
        $user->save();

        return back();
    }



    public function TestingCode ($symbol)
    {       
        
        $cryptolist = Http::get('https://api.binance.com/api/v1/ticker/price?symbol='.$symbol.'USDT')->json();
        $collection = collect($cryptolist);
        $getpricedata = $collection['price'];

        return $getpricedata;
            
    }


    public function UserProfile()
    {
        $data['tittle'] = 'User Profile';
        $data['set'] = settings::findOrFail(1); 
        return view('user.profile', $data);
    }


    public function ProfileImage(request $request)
    {        
        $str = Str::random(10);
        $file = $request->image;
        $filename = $str.'.'.$file->getClientOriginalExtension();
        $request->image->move('img/avatars', $filename);

        $user = User::findOrFail(Auth::user()->id);
        $user->image = $filename;
        $user->save();

        return back();
    }


    public function ProfileDataUpdate(request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->country = $request->country;
        $user->password = Hash::make($request->password);
        $user->save();
        Toastr::success('Your Data Successfully Updated.', 'Saved', ['options']);
        return back();
    }


    public function EmailVerify()
    {
        $data['tittle'] = 'Verify Your Email';
        $data['set'] = settings::findOrFail(1);
        $user = User::findOrFail(Auth::user()->id);               

        if($user->email_auth==1){             
            $str = Str::random(10);
        $user->email_code = $str;
        $user->save();

        $details = [
            'username' => "$user->name",
            'emailcode' => "$str"
        ];

        Mail::to("$user->email")->send(new UserVerification($details));
        Toastr::success('Please check your email.', 'Send!', ['options']);
        return view('auth.verify', $data);
        }
        else{
            Toastr::warning('Your email already verified.', 'Verified', ['options']);
            return redirect('/dashboard');
        }
    }


    public function ReferralIndex(){
        $data['tittle'] = 'Referral System';        
        $data['set'] = settings::findOrFail(1);
        $data['totalref'] = ref_history::whereuser_id(Auth::user()->id)->count();
        $data['referral'] = ref_history::whereuser_id(Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('user.referral', $data);
    }

    public function EmailVerifySuccess (request $request)
    {
        $user = User::findOrFail($request->user_id);
        
        if($user->email_code == ''.$request->emailcode.''){
            $userupt = User::findOrFail($request->user_id);
            $userupt->email_auth = 2;
            $userupt->save();
            Toastr::success('Your Email Successfully Verified.', 'Verified!', ['options']);
            return redirect('/dashboard');
        }
        else{
            Toastr::success('Your code not correct, please try again.', 'Wrong Code', ['options']);
            return back();
        }
    }

    
    public function SendMoney(request $request)
    {
        $set = settings::findOrFail(1);
        $sendfrom = user::findOrFail(Auth::user()->id);
        $sendto = user::whereemail($request->sendto)->first();

        if(user::whereemail($request->sendto)->first()){
            if($sendfrom->balance>$request->amount || $sendfrom->balance==$request->amount)
            {
                $sendfromupdate = user::findOrFail(Auth::user()->id);
                $amounts = $request->amount+$set->intr_fees;
                $sendfromupdate->balance = $sendfromupdate->balance-$amounts;
                $sendfromupdate->save();

                $sendtoupdate = user::findOrFail($sendto->id);
                $sendtoupdate->balance = $sendtoupdate->balance+$request->amount;
                $sendtoupdate->save();

                $transections = new transections();
                $transections->user_id = Auth::user()->id;
                $transections->ref = Str::random(10);
                $transections->method_name = $sendtoupdate->name;
                $transections->method_symbol = $request->sendto;
                $transections->amount = $request->amount;
                $transections->fees = $set->intr_fees;
                $transections->type = 3;
                $transections->status = 3;
                $transections->save();

                Toastr::success('Successfully Send', 'Success', ['options']);
                return back();
            }
            else{
                Toastr::warning('You have no balance', 'No Balance!', ['options']);
                return back();
            }
        }
        else{
            Toastr::warning('We are not found any account with '.$request->sendto.' please check & try again.', 'No Found!', ['options']);
                return back();
        }
    }

    public function SingleCryptoPage($ids)
    {
        $data['tittle'] = 'Trading Panel '.substr("$ids", 0, 3).'';
        $data['set'] = settings::findOrFail(1);

        if(substr("$ids", -4) == 'USDT'){
            $getsymbolactivationdata = cryptos::wheresymbol(substr("$ids", 0, -4))->first();
        }else{
            $getsymbolactivationdata = cryptos::wheresymbol(substr("$ids", 0, -3))->first();
        }

        if($getsymbolactivationdata->status == 1){
            if(substr("$ids", -4) == 'USDT'){
                $data['withdraw_history'] = withdrawals::whereuser_id(Auth::user()->id)->wheremethod_symbol(substr("$ids", 0, -4))->orderBy('id', 'DESC')->get();
                }
                else{
                    $data['withdraw_history'] = withdrawals::whereuser_id(Auth::user()->id)->wheremethod_symbol(substr("$ids", 0, -3))->orderBy('id', 'DESC')->get();
                } 
        
                $data['orders'] = transections::wheremethod_symbol($ids)->whereuser_id(Auth::user()->id)->orderBy('id', 'DESC')->get();
                
                if(substr("$ids", -4) == 'USDT'){
                    if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$ids", 0, -4))->first()){
                    $getblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$ids", 0, -4))->first();
                    $data['buycryptoblnc'] = $getblnc->balance;
                    }
                    else{
                        $data['buycryptoblnc'] = '0';
                    }
                }
                else{
                    if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$ids", 0, -3))->first()){
                        $getblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$ids", 0, -3))->first();
                        $data['buycryptoblnc'] = $getblnc->balance;
                        }
                        else{
                            $data['buycryptoblnc'] = '0';
                        }
                }        
        
        
                
                if(substr("$ids", -4) == 'USDT'){
                    $sellblncuser = user::findOrFail(Auth::user()->id);
                    $sellblncget =  $sellblncuser->balance;
                    $data['sellcryptoblnc'] = $sellblncget;
                }
                else{
                    if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$ids", -3))->first()){
                        $getblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$ids", -3))->first();
                        $data['sellcryptoblnc'] = $getblnc->balance;
                        }
                        else{
                            $data['sellcryptoblnc'] = '0';
                        }
                }
        
        
                $data['symbol'] = $ids;        
                $set = settings::findOrFail(1);
                
                
                return view('user.scrypto', $data);
        }else{
            Toastr::warning('The Coins not active for trade.', 'No Active Coin');
            return back();
        }

        
    }


    public function CryptoBuyAmountFromBalance($ids)
    {        
        $set = settings::findOrFail(1);
        $user = User::findOrFail(Auth::user()->id);

        if(substr("$ids", -4) == 'USDT'){
            $api = new \Binance\API("$set->api_key","$set->scrt_key");
            $getprice = $api->price("$ids");

            $cost = $user->balance;

            if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$ids", 0, -4))->first()){
                $balance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$ids", 0, -4))->first();
                $blncwithfee = $user->balance-$set->fees;
                $amount = $blncwithfee/$getprice;
            }
            else{
                $amount = '0';
            }

            if($set->fees>$user->balance){
                Toastr::warning('You have not enough balance in your Main Account for this trade.', 'Balance Issue');
                return back();
            }
            else{
                return redirect ('/dashboard/trade/spot/'.$ids.'?symbol='.$ids.'&cost='.$cost.'&amount='.$amount.'&details=Active');
            }
            
        }
        else{
            
                if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$ids", -3))->first()){
                    $othercoinbalance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$ids", -3))->first();
                    $othercoinapi = new \Binance\API("$set->api_key","$set->scrt_key");
                    $coinsymbol = $othercoinbalance->symbol."".$set->main_crypto;
                    $sellcoinprice = $othercoinapi->price("$coinsymbol");


                    $cost = $othercoinbalance->balance;
                }
                else{
                    $cost = '0';
                }

           
                $buycoinbalance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$ids", -3))->first();
                $buycoinapi = new \Binance\API("$set->api_key","$set->scrt_key");
                $getothercoinamountprice = $buycoinapi->price("$ids");          
                

                $feeswithcoin = substr("$ids", -3).''.$set->main_crypto;
                $feesapi = new \Binance\API("$set->api_key","$set->scrt_key");
                $feesprice = $feesapi->price("$feeswithcoin");
                $fees = $set->fees/$feesprice;


                $amount = number_format($buycoinbalance->balance/$getothercoinamountprice-$fees, 8);
           

            if($buycoinbalance->balance<$fees){
                Toastr::warning('You have not enough balance in your Main Account for this trade.', 'Balance Issue');
                return back();
            }
            else{
                return redirect ('/dashboard/trade/spot/'.$ids.'?symbol='.$ids.'&cost='.$cost.'&amount='.$amount.'&details=Active');
            }
        }
        

    }



    public function CryptoBuy(request $request)
    {
        $set = settings::findOrFail(1);
        $user = User::findOrFail(Auth::user()->id);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();
        
        if(substr("$request->symbol", -4) == 'USDT'){
            $getfinalpriceusdt = $api->price("$request->symbol");
            $getpriceforavilityamount =  $request->amount*$getfinalpriceusdt;      
            $getbalancedata = $api->balances();
            $blnavilable = $getbalancedata['USDT'];        
            $blnprint = $blnavilable['available'];
        }
        else{
            $cryptoforblndata = substr("$request->symbol", -3);
            $getbalancedata = $api->balances();
            $blnavilable = $getbalancedata["$cryptoforblndata"];        
            $blnprint = $blnavilable['available'];
            
            $getpriceforavility = $api->price("$request->symbol");
            $getpriceforavilityamount = $request->amount*$getpriceforavility;
            }        
        
        if($getpriceforavilityamount<$blnprint){
        
            if(substr("$request->symbol", -4) == 'USDT'){

                $usdtapis = new \Binance\API("$set->api_key","$set->scrt_key");
                $getprice = $usdtapis->price("$request->symbol");
                $amount = $request->amount*$getprice;

                if($user->balance>$amount || $user->balance==$amount)
                {
                $quantity = $request->amount;
                $order = $api->marketBuy("$request->symbol", $quantity);
                $price = $api->price("$request->symbol");

                $transections = new transections();
                $transections->user_id = Auth::user()->id;            
                $transections->ref = Str::random(10);
                $transections->orderId = $order['orderId'];
                $transections->clientOrderId = $order['clientOrderId'];
                $transections->method_name = $request->symbol;
                $transections->method_symbol = $request->symbol;
                $transections->amount = $order['executedQty'];
                $transections->price = $price;
                $transections->cost = $request->amount*$price;
                $transections->market_type = $order['type'];
                $transections->market_side = $order['side'];
                $transections->fees = $set->fees;
                $transections->type = 2;
                $transections->status = $order['status'];
                $transections->save();

                $userupt = User::findOrFail(Auth::user()->id);
                $userupt->balance = $userupt->balance-$request->amount*$price;
                $userupt->save();

                if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -4))->first())
                {
                $balance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -4))->first();
                $balance->balance = $balance->balance+$order['executedQty'];
                $balance->save();
                }
                else
                {
                    $balance = new balances();
                    $balance->user_id = Auth::user()->id;
                    $balance->name = strtolower(substr("$request->symbol", 0, -4));
                    $balance->symbol = substr("$request->symbol", 0, -4);
                    $balance->balance = $balance->balance+$order['executedQty'];
                    $balance->balance_usd = $request->amount*$price;
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
                $getprice = $othercapis->price("$request->symbol");
                $amount = $request->amount*$getprice;

                if($user->balance>$amount || $user->balance==$amount)
                {        
                $quantity = $request->amount;
                $order = $api->marketBuy("$request->symbol", $quantity);
                $price = $api->price("$request->symbol");
                
                $transections = new transections();
                $transections->user_id = Auth::user()->id;            
                $transections->ref = Str::random(10);
                $transections->orderId = $order['orderId'];
                $transections->clientOrderId = $order['clientOrderId'];
                $transections->method_name = $request->symbol;
                $transections->method_symbol = $request->symbol;
                $transections->amount = $order['executedQty'];
                $transections->price = $price;
                $transections->cost = $request->amount*$price;
                $transections->market_type = $order['type'];
                $transections->market_side = $order['side'];
                $transections->fees = $set->fees;
                $transections->type = 2;
                $transections->status = $order['status'];
                $transections->save();

                if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -3))->first())
                {
                $buybalance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -3))->first();
                $buybalance->balance = $buybalance->balance+$order['executedQty'];
                $buybalance->save();

                $sellfinalamount = $request->amount*$price;

                $sellbalance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", -3))->first();
                $sellbalance->balance = $sellbalance->balance-$sellfinalamount;
                $sellbalance->save();
                }
                else
                {
                    $balance = new balances();
                    $balance->user_id = Auth::user()->id;
                    $balance->name = substr("$request->symbol", -3);
                    $balance->symbol = substr("$request->symbol", -3);
                    $balance->balance = $balance->balance-$order['executedQty'];
                    $balance->balance_usd = $request->amount*$price;
                    $balance->status = 1;
                    $balance->save(); 
                }


                $details = [
                    'name' => "$user->name",
                    'refid' => "$transections->ref",
                    'orderid' => "$transections->orderId",
                    'symbol' => "$request->symbol",
                    'amount' => "$transections->amount",
                    'cost' => "$request->amount*$price",
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

    public function CryptoSell(request $request)
    {
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();

        if(substr("$request->symbol", -4) == 'USDT'){
            $cryptoforblndata = substr("$request->symbol", 0, -4);
            $getbalancedata = $api->balances();
            $blnavilable = $getbalancedata["$cryptoforblndata"];        
            $blnprint = $blnavilable['available'];
     
            $getpriceforavilityamount = $request->amount;
        }
        else{
            $cryptoforblndata = substr("$request->symbol", -3);
            $getbalancedata = $api->balances();
            $blnavilable = $getbalancedata["$cryptoforblndata"];        
            $blnprint = $blnavilable['available'];
         
            $getpriceforavilityamount = $request->amount;
            }

        if($getpriceforavilityamount<$blnprint){

            if(substr("$request->symbol", -4) == 'USDT'){

                if(balances::wheresymbol(substr("$request->symbol", 0, -4))->whereuser_id(Auth::user()->id)->first()){
                $cryptoblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -4))->first();
                $cryptoblncdata = $cryptoblnc->balance;
                }
                else
                {
                    $cryptoblncdata = 0; 
                }

                if($cryptoblncdata>$request->amount || $cryptoblncdata==$request->amount)
                {        
                $quantity = $request->amount;
                $order = $api->marketSell("$request->symbol", $quantity);
                $price = $api->price("$request->symbol");

                $transections = new transections();
                $transections->user_id = Auth::user()->id;
                $transections->ref = Str::random(10);
                $transections->orderId = $order['orderId'];
                $transections->clientOrderId = $order['clientOrderId'];
                $transections->method_name = $request->symbol;
                $transections->method_symbol = $request->symbol;
                $transections->amount = $order['executedQty'];
                $transections->price = $price;
                $transections->cost = $request->amount*$price;
                $transections->market_type = $order['type'];
                $transections->market_side = $order['side'];
                $transections->fees = $set->fees;
                $transections->type = 2;
                $transections->status = $order['status'];
                $transections->save();

                $userupt = User::findOrFail(Auth::user()->id);
                $userupt->balance = $userupt->balance+$request->amount*$price;
                $userupt->save();
                
                $balance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -4))->first();
                $balance->balance = $balance->balance-$request->amount;
                $balance->save();


                $details = [
                    'name' => "$user->name",
                    'refid' => "$transections->ref",
                    'orderid' => "$transections->orderId",
                    'symbol' => "$request->symbol",
                    'amount' => "$transections->amount",
                    'cost' => "$request->amount*$price",
                    'markettype' => "$transections->market_type",
                    'marketside' => "$transections->market_side",
                    'status' => "$transections->status",

                ];
        
                Mail::to("$user->email")->send(new TradeConfirmation($details));

                Toastr::success('Order Successfully Created', 'Success', ['options']);
                return back();
                }
                else{
                Toastr::warning('You have no balance in your '.$request->crypto_name.' Account', 'No Balance', ['options']);
                return back();
                }

            }

            else
            {

            }

        }else{
            Toastr::warning('We are not execute your order now, Please contact with our support center.', 'Sorry!');
            return back();
        }
        
    }


    public function CryptoLimit(request $request)
    {
        $set = settings::findOrFail(1);
        $user = User::findOrFail(Auth::user()->id);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();
        $price = $request->price;        

        if($request->type == 1)
        {
            if(substr("$request->symbol", -4) == 'USDT'){
                $getfinalpriceusdt = $api->price("$request->symbol");
                $getpriceforavilityamount =  $request->amount*$getfinalpriceusdt;      
                $getbalancedata = $api->balances();
                $blnavilable = $getbalancedata['USDT'];        
                $blnprint = $blnavilable['available'];
            }
            else{
                $cryptoforblndata = substr("$request->symbol", -3);
                $getbalancedata = $api->balances();
                $blnavilable = $getbalancedata["$cryptoforblndata"];        
                $blnprint = $blnavilable['available'];
                
                $getpriceforavility = $api->price("$request->symbol");
                $getpriceforavilityamount = $request->amount*$getpriceforavility;
                }        
            
            if($getpriceforavilityamount<$blnprint){
            
                if(substr("$request->symbol", -4) == 'USDT'){
    
                    $usdtapis = new \Binance\API("$set->api_key","$set->scrt_key");
                    $getprice = $usdtapis->price("$request->symbol");
                    $amount = $request->amount*$getprice;
    
                    if($user->balance>$amount || $user->balance==$amount)
                    {
                    $quantity = $request->amount;
                    $order = $api->buy("$request->symbol", $quantity, $price);                    
    
                    $transections = new transections();
                    $transections->user_id = Auth::user()->id;            
                    $transections->ref = Str::random(10);
                    $transections->orderId = $order['orderId'];
                    $transections->clientOrderId = $order['clientOrderId'];
                    $transections->method_name = $request->symbol;
                    $transections->method_symbol = $request->symbol;
                    $transections->amount = $order['executedQty'];
                    $transections->price = $price;
                    $transections->cost = $request->amount*$price;
                    $transections->market_type = $order['type'];
                    $transections->market_side = $order['side'];
                    $transections->fees = $set->fees;
                    $transections->type = 2;
                    $transections->status = $order['status'];
                    $transections->save();
    
                    $userupt = User::findOrFail(Auth::user()->id);
                    $userupt->balance = $userupt->balance-$request->amount*$price;
                    $userupt->save();
    
                    if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -4))->first())
                    {
                    $balance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -4))->first();
                    $balance->balance = $balance->balance+$order['executedQty'];
                    $balance->save();
                    }
                    else
                    {
                        $balance = new balances();
                        $balance->user_id = Auth::user()->id;
                        $balance->name = substr("$request->symbol", 0, -4);
                        $balance->symbol = substr("$request->symbol", 0, -4);
                        $balance->balance = $balance->balance+$order['executedQty'];
                        $balance->balance_usd = $request->amount*$price;
                        $balance->status = 1;
                        $balance->save(); 
                    }
    
                    $details = [
                        'name' => "$user->name",
                        'refid' => "$transections->ref",
                        'orderid' => "$transections->orderId",
                        'symbol' => "$request->symbol",
                        'amount' => "$transections->amount",
                        'cost' => "$request->amount*$price",
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
                else{
                    $othercapis = new \Binance\API("$set->api_key","$set->scrt_key");
                    $getprice = $othercapis->price("$request->symbol");
                    $amount = $request->amount*$getprice;
    
                    if($user->balance>$amount || $user->balance==$amount)
                    {        
                    $quantity = $request->amount;
                    $order = $api->marketBuy("$request->symbol", $quantity);
                    $price = $api->price("$request->symbol");
    
                    $transections = new transections();
                    $transections->user_id = Auth::user()->id;            
                    $transections->ref = Str::random(10);
                    $transections->orderId = $order['orderId'];
                    $transections->clientOrderId = $order['clientOrderId'];
                    $transections->method_name = $request->symbol;
                    $transections->method_symbol = $request->symbol;
                    $transections->amount = $order['executedQty'];
                    $transections->price = $price;
                    $transections->cost = $request->amount*$price;
                    $transections->market_type = $order['type'];
                    $transections->market_side = $order['side'];
                    $transections->fees = $set->fees;
                    $transections->type = 2;
                    $transections->status = $order['status'];
                    $transections->save();
    
                    if(balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -3))->first())
                    {
                    $buybalance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -3))->first();
                    $buybalance->balance = $buybalance->balance+$order['executedQty'];
                    $buybalance->save();
    
                    $sellfinalamount = $request->amount*$price;
    
                    $sellbalance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", -3))->first();
                    $sellbalance->balance = $sellbalance->balance-$sellfinalamount;
                    $sellbalance->save();
                    }
                    else
                    {
                        $balance = new balances();
                        $balance->user_id = Auth::user()->id;
                        $balance->name = substr("$request->symbol", -3);
                        $balance->symbol = substr("$request->symbol", -3);
                        $balance->balance = $balance->balance-$order['executedQty'];
                        $balance->balance_usd = $request->amount*$price;
                        $balance->status = 1;
                        $balance->save(); 
                    }

                    $details = [
                        'name' => "$user->name",
                        'refid' => "$transections->ref",
                        'orderid' => "$transections->orderId",
                        'symbol' => "$request->symbol",
                        'amount' => "$transections->amount",
                        'cost' => "$request->amount*$price",
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
        else
        {
            if(substr("$request->symbol", -4) == 'USDT'){
                $cryptoforblndata = substr("$request->symbol", 0, -4);
                $getbalancedata = $api->balances();
                $blnavilable = $getbalancedata["$cryptoforblndata"];        
                $blnprint = $blnavilable['available'];
         
                $getpriceforavilityamount = $request->amount;
            }
            else{
                $cryptoforblndata = substr("$request->symbol", -3);
                $getbalancedata = $api->balances();
                $blnavilable = $getbalancedata["$cryptoforblndata"];        
                $blnprint = $blnavilable['available'];
             
                $getpriceforavilityamount = $request->amount;
                }
    
            if($getpriceforavilityamount<$blnprint){
    
                if(substr("$request->symbol", -4) == 'USDT'){
    
                    if(balances::wheresymbol(substr("$request->symbol", 0, -4))->whereuser_id(Auth::user()->id)->first()){
                    $cryptoblnc = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -4))->first();
                    $cryptoblncdata = $cryptoblnc->balance;
                    }
                    else
                    {
                        $cryptoblncdata = 0; 
                    }
    
                    if($cryptoblncdata>$request->amount || $cryptoblncdata==$request->amount)
                    {        
                    $quantity = $request->amount;
                    $order = $api->sell("$request->symbol", $quantity, $price);
                        
                    $transections = new transections();
                    $transections->user_id = Auth::user()->id;
                    $transections->ref = Str::random(10);
                    $transections->orderId = $order['orderId'];
                    $transections->clientOrderId = $order['clientOrderId'];
                    $transections->method_name = $request->symbol;
                    $transections->method_symbol = $request->symbol;
                    $transections->amount = $request->amount;
                    $transections->price = $price;
                    $transections->cost = $request->amount*$price;
                    $transections->market_type = $order['type'];
                    $transections->market_side = $order['side'];
                    $transections->fees = $set->fees;
                    $transections->type = 2;
                    $transections->status = $order['status'];
                    $transections->save();
    
                    $userupt = User::findOrFail(Auth::user()->id);
                    $userupt->balance = $userupt->balance+$request->amount*$price;
                    $userupt->save();
                    
                    $balance = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->symbol", 0, -4))->first();
                    $balance->balance = $balance->balance-$request->amount;
                    $balance->save();

                    $details = [
                        'name' => "$user->name",
                        'refid' => "$transections->ref",
                        'orderid' => "$transections->orderId",
                        'symbol' => "$request->symbol",
                        'amount' => "$transections->amount",
                        'cost' => "$request->amount*$price",
                        'markettype' => "$transections->market_type",
                        'marketside' => "$transections->market_side",
                        'status' => "$transections->status",
    
                    ];
            
                    Mail::to("$user->email")->send(new TradeConfirmation($details));
    
                    Toastr::success('Order Successfully Created', 'Success', ['options']);
                    return back();
                    }
                    else{
                    Toastr::warning('You have no balance in your '.$request->crypto_name.' Account', 'No Balance', ['options']);
                    return back();
                    }
    
                }
    
                else
                {
    
                }
    
            }else{
                Toastr::warning('We are not execute your order now, Please contact with our support center.', 'Sorry!');
                return back();
            }
        }
        
    }



    public function OrderCancel($symbol, $OrderID, $refid, $userid)
    {
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");

        $trxinfo = transections::whereref($refid)->first();
        $orderstatus = $api->cancel("$symbol", $OrderID);

        $trxinfos = transections::whereref($refid)->first();
        $trxinfos->status = $orderstatus['status'];
        $trxinfos->save();

        if(substr("$symbol", -4) == 'USDT')
        {
            if($trxinfos->market_side=='BUY')
            {
                $userblnc = user::findOrFail($userid);
                $userblnc->balance = $userblnc->balance+$trxinfos->cost;
                $userblnc->save();
            }
            else
            {
                $trxupdate = balances::wheresymbol(substr("$symbol", 0, -4))->whereuser_id(Auth::user()->id)->first();
                $trxupdate->balance = $trxupdate->balance+$trxinfos->amount;
                $trxupdate->save();

                $usrblnupt = User::findOrFail($userid);
                $usrblnupt->balance = $usrblnupt->balance-$trxinfos->cost;
                $usrblnupt->save();

            }
        }
        else
        {
            if($trxinfos->market_side=='BUY')
            {
                $userblnc = balances::wheresymbol(substr("$symbol", 0, -3))->whereuser_id(Auth::user()->id)->first();
                $userblnc->balance = $userblnc->balance+$trxinfos->cost;
                $userblnc->save();
            }
            else
            {
                $trxupdate = balances::wheresymbol(substr("$symbol", 0, -3))->whereuser_id(Auth::user()->id)->first();
                $trxupdate->balance = $trxupdate->balance+$trxinfos->amount;
                $trxupdate->save();
            }
        }

        if($orderstatus){            

            $details = [
                'name' => "$user->name",
                'refid' => "$trxinfos->ref",
                'orderid' => "$trxinfos->orderId",
                'symbol' => "$request->symbol",
                'amount' => "$trxinfos->amount",
                'cost' => "$request->amount*$price",
                'markettype' => "$trxinfos->market_type",
                'marketside' => "$trxinfos->market_side",
                'status' => "$trxinfos->status",

            ];
    
            Mail::to("$user->email")->send(new TradeConfirmation($details));

        Toastr::success('Order Successfully Canceled', 'Canceled', ['options']);
        return back();
        }
        else{
        Toastr::warning('Order Not Successfully Canceled', 'Not Success', ['options']);
        return back();
        }

    }


    public function CryptoMining()
    {
        $data['tittle'] = 'User Dashboard - Main Account';
        $data['set'] = settings::findOrFail(1);
        $data['miningcryptos'] = miningcryptos::whereuser_id(Auth::user()->id)->get();
        $data['buydevice'] = buyminingdevice::whereuser_id(Auth::user()->id)->get();
        $data['totalkhs'] = miningcryptos::whereuser_id(Auth::user()->id)->sum('mining_power');
        $data['totalminingusd'] = miningcryptos::whereuser_id(Auth::user()->id)->sum('minig_balance_usd');
        $data['activecoins'] = miningcryptos::whereuser_id(Auth::user()->id)->wherestatus(1)->count();
        return view('user.crypto_mining', $data);
    }


    public function MainAccount()
    {
        $data['tittle'] = 'User Dashboard - Main Account';
        $data['set'] = settings::findOrFail(1);
        $data['getaways'] = getaways::wherestatus(1)->get();
        $data['transections'] = transections::whereuser_id(Auth::user()->id)->wheretype(1)->orderBy('id', 'DESC')->get();
        $data['transfer'] = transections::whereuser_id(Auth::user()->id)->wheretype(3)->orderBy('id', 'DESC')->get();  
        $data['withdraw_method'] = withdraw_methods::wherestatus(1)->get(); 
        $data['withdraw_history'] = withdrawals::whereuser_id(Auth::user()->id)->orderBy('id', 'DESC')->get();     
        return view('user.main_account', $data);
    }


    public function MainAccountDepositMethods()
    {
        $data['tittle'] = 'User Dashboard - Main Account | Deposit Methods';
        $data['set'] = settings::findOrFail(1);  
        $data['getaways'] = getaways::wherestatus(1)->get();  
        return view('user.deposit_methods', $data);
    }


    public function GetCryptoBalanceAll()
    {
        $data['tittle'] = 'User Dashboard - Crypto Wallets';
        $blnc = balances::whereuser_id(Auth::user()->id)->get();
        $data['totalbalance'] = $blnc->sum('balance_usd');
        $data['getaways'] = getaways::wherestatus(1)->get();
        $data['balances'] = balances::whereuser_id(Auth::user()->id)->get();
        $data['set'] = settings::findOrFail(1);
        
        return view('user.all_crypto_balance', $data);
    }


    public function CryptosAll()
    {
        $data['tittle'] = 'User Dashboard - Cryptos';
        $data['cryptos'] = cryptos::wherestatus(1)->get();
        $data['totalcryptos'] = cryptos::wherestatus(1)->count();
        $data['set'] = settings::findOrFail(1);
        
        return view('user.all_cryptos', $data);
    }


    public function WithdrawMoney(request $request)
    {
        $set = settings::findOrFail(1);
        $user = User::findOrFail(Auth::user()->id);        
        $wtrmth = withdraw_methods::findOrFail($request->method);

        

        if($user->balance>$request->amount || $user->balance==$request->amount)
        {
            $userupdate = User::findOrFail(Auth::user()->id);
            $userupdate->balance = $userupdate->balance-$request->amount-$set->withdraw_fees;
            $userupdate->save();

            $wtrlupdate = new withdrawals();
            $wtrlupdate->user_id = Auth::user()->id;
            $wtrlupdate->ref = Str::random(10);
            $wtrlupdate->method_name = "Account Withdraw";
            $wtrlupdate->method_symbol = $wtrmth->symbol;
            $wtrlupdate->method_details = $request->details;
            $wtrlupdate->amount = $request->amount;
            $wtrlupdate->amount_usd = $request->amount;
            $wtrlupdate->fees = $set->withdraw_fees; 
            $wtrlupdate->status = 1;
            $wtrlupdate->save();
            
            Toastr::success('Withdraw Successfully Submited', 'Success', ['options']);
            return back();

        }
        else{
            Toastr::warning('You have no balance for withdraw', 'Not Success', ['options']);
            return back();
        }
        

    }


    public function WithdrawCrypto (request $request)
    {
        $set = settings::findOrFail(1);
        if(substr("$request->crypto_symbol", -4) == 'USDT'){
        $crypto = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->crypto_symbol", 0, -4))->first();
            if(cryptofees::wheresymbol(substr("$request->crypto_symbol", 0, -4))->wherestatus(1)->first()){
                $withdrawfeesget = cryptofees::wheresymbol(substr("$request->crypto_symbol", 0, -4))->first();
                $withdrawfees = $withdrawfeesget->fees_usd;
            }
            else{
                $withdrawfees = $set->withdraw_fees;
            }
        }           
        else{
            $crypto = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->crypto_symbol", 0, -3))->first();

            if(cryptofees::wheresymbol(substr("$request->crypto_symbol", 0, -3))->wherestatus(1)->first()){
                $withdrawfeesget = cryptofees::wheresymbol(substr("$request->crypto_symbol", 0, -4))->first();
                $withdrawfees = $withdrawfeesget->fees_usd;
            }
            else{
                $withdrawfees = $set->withdraw_fees;
            }
        }
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $price = $api->price("$request->crypto_symbol");
        $fees = $withdrawfees/$price;
        $amount = $request->amount+$fees;  
        
            if(substr("$request->crypto_symbol", -4) == 'USDT'){
            $userupdate = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->crypto_symbol", 0, -4))->first();
            }
            else{
                $userupdate = balances::whereuser_id(Auth::user()->id)->wheresymbol(substr("$request->crypto_symbol", 0, -3))->first();
            }        
        

        if($crypto->balance>$amount || $crypto->balance==$request->amount)
        { 

            $userupdate->balance = $userupdate->balance-$amount;
            $userupdate->save();

            if($userupdate){
                $wtrlupdate = new withdrawals();
                $wtrlupdate->user_id = Auth::user()->id;
                $wtrlupdate->crypto_id = $request->crypto_id;
                $wtrlupdate->ref = Str::random(10);
                $wtrlupdate->method_name = "Account Crypto Withdraw";
                $wtrlupdate->method_symbol = $userupdate->symbol;
                $wtrlupdate->method_details = $request->details;
                $wtrlupdate->amount = $request->amount;
                $wtrlupdate->amount_usd = $request->amount*$price;
                $wtrlupdate->fees = $fees; 
                $wtrlupdate->status = 1;
                $wtrlupdate->save();
            }
            else{

            }
            
            
            Toastr::success('Withdraw Successfully Submited', 'Success', ['options']);
            return back();

        }
        else{
            Toastr::warning('You have no '.$userupdate->symbol.' for withdraw', 'Not Success', ['options']);
            return back();
        }
    }


    public function MainAccountDepositProcess(request $request)
    {
        $data['tittle'] = 'User Dashboard - Main Account Deposit';
        $set = settings::findOrFail(1);
            
        $data['set'] = settings::findOrFail(1);
        Toastr::success('Please Compleate Deposit With information bellow', 'Deposit Details', ['options']);
        return view('user.deposit', $data);          
        
    }


    public function MainAccountDepositAddTxID(request $request)
    {
        $txid = transections::whereref($request->ref_id)->first();
        $txid->crypto_txid = $request->cryptotxid;
        $txid->save();

        Toastr::success('Your TxID Submited Successfully', 'Success', ['options']);
        return redirect('/dashboard/account/main');
    }


}
