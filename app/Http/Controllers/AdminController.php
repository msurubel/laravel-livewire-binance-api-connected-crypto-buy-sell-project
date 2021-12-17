<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Http\RedirectResponse;
use Brian2694\Toastr\Facades\Toastr;


use App\Models\User;
use App\Models\cryptos;
use App\Models\settings;
use App\Models\balances;
use App\Models\deposits;
use App\Models\getaways;
use App\Models\transections;
use App\Models\withdrawals;
use App\Models\withdraw_methods;
use App\Models\siteads;
use App\Models\cryptofees;
use App\Models\miningcryptos;
use App\Models\setmininglist;
use App\Models\miningdevices;
use App\Models\buyminingdevice;
use App\Models\ref_history;

class AdminController extends Controller
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
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

        $data['totaldeposits'] = transections::wheretype(1)->wherestatus(2)->sum('amount');
        $data['deposited'] = deposits::wherestatus(1)->sum('trx_amount_usd');
        $data['totalwithdraw'] = withdrawals::wherestatus(3)->sum('amount_usd');
        $data['totalcryptoorders'] = transections::wheretype(2)->count();
        $data['totalcoins'] = cryptos::wherestatus(1)->count();
        $data['usersall'] = User::all()->count();
        $data['depositall'] = transections::wheretype(1)->limit(10)->get();
        $data['set'] = settings::whereid(1)->first();
        $data['withdrawall'] = withdrawals::wherestatus(1)->limit(10)->orderBy('id', 'DESC')->get();        
        $data['tittle'] = 'Admin Dashboard';
        return view('admin.home', $data);

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }


    public function demo()
    {
        Toastr::warning('Demo Version not allowed for any changes.', 'Warning', ['options']);
        return back();
    }

    public function settings()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

        
        $data['tittle'] = 'Admin Dashboard | Settings';
        $data['set'] = settings::whereid(1)->first();
        return view('admin.settings', $data);

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }


    public function CryptoMiningDevices()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

        
        $data['tittle'] = 'Admin Dashboard | Mining Device';
        $data['set'] = settings::whereid(1)->first();
        $data['devices'] = miningdevices::all();
        $data['devicesp'] = buyminingdevice::orderBy('id', 'DESC')->get();
        return view('admin.mining_devices', $data);

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }


    public function PurchasedDeviceActive($id)
    {
        $pdevicedata = buyminingdevice::findOrFail($id);
        $confirm = buyminingdevice::findOrFail($id);
        $confirm->status = 1;
        $confirm->save();
        
        $coin = miningcryptos::wheredevice_ref($pdevicedata->order_ref)->first();
        $coin->status = 1;
        $coin->save();

        Toastr::success('Mining Device Activated Suuccessfully.', 'Success');
        return redirect('/admin/crypto/mining/devices?active=purchaseddevices');
    }


    public function CryptoMiningDevicesAdd(request $request)
    {
        $device = new miningdevices();
        $device->name = $request->name;
        $device->cost_kwhs = $request->costkwhs;
        $device->power_kwhs = $request->kwhspower;
        $device->day_income = $request->dayincome;
        $device->power_khs = $request->khspower;
        $device->buy_cost = $request->buycost;
        $device->status = 1;
        $device->save();

        Toastr::success('New Device Added Successfully.', 'Success');
        return back();
    }


    public function MiningDevicePurchasedStatus()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2 || $user->type==3){
            
            $data['tittle'] = 'Site Ads';        
            $data['set'] = settings::findOrFail(1);
            return view('admin.device-purchased-status', $data);
        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        } 
    }


    public function AdminAds()
    {
        $user = User::findOrFail(Auth::user()->id);
        
        if($user->type==2 || $user->type==3){
            $data['tittle'] = 'Site Ads';        
            $data['set'] = settings::findOrFail(1);
            $data['ads'] = siteads::all();
            
            return view('admin.site_ads', $data);
        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        } 
    }


    public function AdminAdsNew(request $request)
    {
        $ads = new siteads();        
        $ads->hilight_text = $request->hilight_text;
        if($request->addtheme == 'dark'){
            $ads->headline = '<span style="color: white">'.$request->headline.'</span>';
            $ads->body_text = '<span style="color: white">'.$request->body_text.'</span>';
        }
        else{
            $ads->headline = '<span style="color: black">'.$request->headline.'</span>';
            $ads->body_text = '<span style="color: black">'.$request->body_text.'</span>';
        }
        $ads->button_show = 1;
        $ads->button_link = $request->button_link;        
        $ads->status = 1;

            $adstr = Str::random(10);
            $adfile = $request->addimage;
            $adfilename = $adstr.'.'.$adfile->getClientOriginalExtension();
            $request->addimage->move('images/ads', $adfilename);

            $bgstr = Str::random(10);
            $bgfile = $request->backgroundimage;
            $bgfilename = $bgstr.'.'.$bgfile->getClientOriginalExtension();
            $request->backgroundimage->move('images/ads', $bgfilename);

        $ads->background_image = $bgfilename;
        $ads->ad_image = $adfilename;

        $ads->save();

        Toastr::success('Your advertise published on you site.', 'Success');
        return back();
    }


    public function AdminAdsEdit(request $request)
    {
        $ads = siteads::findOrFail($request->adsid);        
        $ads->hilight_text = $request->hilight_text;
        if($request->addtheme == 'dark'){
            $ads->headline = '<span style="color: white">'.$request->headline.'</span>';
            $ads->body_text = '<span style="color: white">'.$request->body_text.'</span>';
        }
        else{
            $ads->headline = '<span style="color: black">'.$request->headline.'</span>';
            $ads->body_text = '<span style="color: black">'.$request->body_text.'</span>';
        }
        $ads->button_show = 1;
        $ads->button_link = $request->button_link;        
        $ads->status = 1;

            $adstr = Str::random(10);
            $adfile = $request->addimage;
            $adfilename = $adstr.'.'.$adfile->getClientOriginalExtension();
            $request->addimage->move('images/ads', $adfilename);

            $bgstr = Str::random(10);
            $bgfile = $request->backgroundimage;
            $bgfilename = $bgstr.'.'.$bgfile->getClientOriginalExtension();
            $request->backgroundimage->move('images/ads', $bgfilename);

        $ads->background_image = $bgfilename;
        $ads->ad_image = $adfilename;

        $ads->save();

        Toastr::success('Your advertise Edit Saved Successfully.', 'Success');
        return back();
    }


    public function AdminAdsDelete($id)
    {
        $ads = siteads::findOrFail($id);
        $ads->delete();
        Toastr::success('Your advertise Deleted Successfully.', 'Success');
        return back();
    }


    public function AllGetawaysAdmin()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

        
        $data['tittle'] = 'Admin Dashboard - Add Deposit Getaways';        
        $data['set'] = settings::findOrFail(1);
        
        return view('admin.d_getaways', $data);

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }



    public function GetCryptoBalanceAll()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

        
            $data['tittle'] = 'Admin Dashboard - Cryptos';
            $data['cryptos'] = cryptos::wherestatus(1)->get();
            $data['set'] = settings::findOrFail(1);
            
            return view('admin.livedata.get_cryptos_all', $data);

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }


    public function GetawaysAddNew(request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        
        if($user->type==2){

        
            
            $getaways = new getaways();
            $getaways->crypto_id = 0;
            $getaways->name = $request->name;
            $getaways->symbol = $request->symbol;
            $getaways->status = 1;            
            $getaways->save();

            Toastr::success('The new deposit getaways hase been added in your market.', 'Success');
            return back();
            

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }



    public function GetawaysDisabled($id)
    {
        $getaways = getaways::findOrFail($id);
        $getaways->status = 2;
        $getaways->save();

        Toastr::success('The '.$getaways->name.' deposit getaways hase been disabled in your market.', 'Success');
        return back();
    }


    public function GetawaysActivated($id)
    {
        $getaways = getaways::findOrFail($id);
        $getaways->status = 1;
        $getaways->save();

        Toastr::success('The '.$getaways->name.' deposit getaways hase been activated in your market.', 'Success');
        return back();
    }


    public function AllCryptoLists()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

        
        $data['tittle'] = 'Admin Dashboard - Crypto Lists';     
        $data['set'] = settings::findOrFail(1);
        $data['cryptototal'] = cryptos::all()->count();
        $data['cryptos'] = cryptos::all();
        
        return view('admin.cryptos_list', $data);

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }

    public function CryptoListNew(request $request)
    {
        $cryptolist = Http::get('https://api.binance.com/api/v1/ticker/price')->json();
        $collection = collect($cryptolist);
        $getbyusdt = ''.strtoupper($request->coin_symbol).'USDT';
        $getbybtc = ''.strtoupper($request->coin_symbol).'BTC';
        $getbyeth = ''.strtoupper($request->coin_symbol).'ETH';

        if(cryptos::wheresymbol($request->coin_symbol)->first() || cryptos::wherename($request->coin_name)->first()){
            Toastr::warning('This coin found in your market.', 'Warning');
            return back();
        }else{
            if($collection->where('symbol', $getbyusdt)->first() || $collection->where('symbol', $getbybtc)->first() || $collection->where('symbol', $getbyeth)->first()){
                $cryptofees = new cryptos();
                $cryptofees->name = $request->coin_name;
                $cryptofees->symbol = $request->coin_symbol;
                $cryptofees->status = 1;
                $cryptofees->save();
    
                Toastr::success(''.$request->coin_name.' Added on your marketplace.', 'Success');
                return back();
            }else{
                Toastr::warning('This coin not valid.', 'Warning');
                return back();
            }
            
        }
    }

    public function CryptoListDisabled($id)
    {
        $cryptofees = cryptos::findOrFail($id);        
        $cryptofees->status = 2;
        $cryptofees->save();

        Toastr::success(''.$cryptofees->symbol.' Disabled from your marketplace.', 'Success');
        return back();
    }


    public function CryptoListDelete($id)
    {
        $cryptofees = cryptos::findOrFail($id);
        $cryptofees->delete();

        Toastr::success(''.$cryptofees->symbol.' Delete from your marketplace.', 'Success');
        return back();
    }


    public function CryptoListActivated($id)
    {
        $cryptofees = cryptos::findOrFail($id);        
        $cryptofees->status = 1;
        $cryptofees->save();

        Toastr::success(''.$cryptofees->symbol.' Activated on your marketplace.', 'Success');
        return back();
    }


    public function CryptoFeesNew(request $request)
    {
        $cryptofees = new cryptofees();
        $cryptofees->symbol = $request->symbol;
        $cryptofees->fees_usd = $request->fees_usd;
        $cryptofees->status = 1;
        $cryptofees->save();

        Toastr::success('New Crypto fees added on your marketplace.', 'Success');
        return back();
    }


    public function CryptoFeesDisabled($id)
    {
        $cryptofees = cryptofees::findOrFail($id);        
        $cryptofees->status = 2;
        $cryptofees->save();

        Toastr::success(''.$cryptofees->symbol.' Crypto fees Disabled from your marketplace.', 'Success');
        return redirect('/admin/finance?active=cryptofees');
    }


    public function CryptoFeesActivated($id)
    {
        $cryptofees = cryptofees::findOrFail($id);        
        $cryptofees->status = 1;
        $cryptofees->save();

        Toastr::success(''.$cryptofees->symbol.' Crypto fees Activated on your marketplace.', 'Success');
        return redirect('/admin/finance?active=cryptofees');
    }


    public function SettingsUpdate(request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

        
        $setting = settings::findOrFail(1);
        $setting->name = $request->name;
        $setting->main_crypto = $request->maincrypto;
        $setting->fees = $request->depositfees;  
        $setting->prediction_earning = $request->prediction_earning;      
        $setting->intr_fees = $request->transferfees;

        $setting->locked_amount_profit = $request->locked_amount_profit;
        $setting->locked_amount_minimum = $request->locked_amount_minimum;

        $setting->site_short_d = $request->site_short_d;
        $setting->address = $request->address;
        $setting->phone_number = $request->phone_number;
        $setting->email_id = $request->email_id;

        $setting->chat_script = $request->chat_script;

        $setting->withdraw_fees = $request->withdrawfees;
        $setting->exchange_widget_ref_earning = $request->exchange_widget_ref_earning;
        $setting->ref_bonus = $request->refbonus;
        $setting->api_key = $request->apikey;
        $setting->scrt_key = $request->scrtkey;
        $setting->save();
        Toastr::success('All data successfully updated.', 'Success', ['options']);
        return back();

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }


    public function SettingsImages(request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

            if(empty($request->image)){

            }
            else
            {
                $str = Str::random(10);
                $file = $request->image;
                $filename = $str.'.'.$file->getClientOriginalExtension();
                $request->image->move('img/settings', $filename);

                $settings = settings::findOrFail(1);
                $settings->image_logo = $filename;
                $settings->save();                
            }
            
            
            if(empty($request->imagew)){

            }
            else
            {
                $strs = Str::random(10);
                $filew = $request->imagew;
                $filenamew = $strs.'.'.$filew->getClientOriginalExtension();
                $request->imagew->move('img/settings', $filenamew);

                $settings = settings::findOrFail(1);
                $settings->image_logow = $filenamew;
                $settings->save();                
            } 


            if(empty($request->image_fevicon)){

            }
            else
            {
                $strs = Str::random(10);
                $filew = $request->image_fevicon;
                $filename_image_fevicon = $strs.'.'.$filew->getClientOriginalExtension();
                $request->image_fevicon->move('img/settings', $filename_image_fevicon);

                $settings = settings::findOrFail(1);
                $settings->site_favicon = $filename_image_fevicon;
                $settings->save();                
            }
            
            Toastr::success('Site Main Images Successfully Updated.', 'Success', ['options']);
            return back();

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }


    public function UsersAll()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

            $data['tittle'] = 'User Dashboard - Cryptos';            
            $data['set'] = settings::findOrFail(1);
           $data['userstotal'] = User::all()->count();
           $data['users'] = User::all();
           

           return view ('admin.allusers', $data);

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }


    public function UsersEdit($email)
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

            $data['tittle'] = 'User Dashboard - Cryptos';            
            $data['set'] = settings::findOrFail(1);
            $data['user'] = User::whereemail($email)->first();  
            
            $userid = User::whereemail($email)->first();
            $data['totaltrades'] = transections::whereuser_id($userid->id)->wheretype(2)->count();
            $data['trades'] = transections::whereuser_id($userid->id)->wheretype(2)->get();
            $data['totaldeposits'] = transections::whereuser_id($userid->id)->wheretype(1)->wherestatus(3)->sum('amount');
            $data['totalwithdraws'] = withdrawals::whereuser_id($userid->id)->sum('amount_usd');
           

           return view ('admin.edit_user', $data);

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }


    public function UsersEditSave(request $request)
    {
        $userupt = User::findOrFail($request->userid);
        $userupt->name = $request->editedname;
        $userupt->email = $request->newemail;
        $userupt->type = $request->type;
        $userupt->save();

        Toastr::success('User Details Saved', 'Success');
        return back();
    }




    public function FinanceArea()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

        
        $data['tittle'] = 'Admin Dashboard | Finance Area';
        $data['set'] = settings::whereid(1)->first();        

        return view('admin.finance', $data);

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }



    public function GetOurCoinsAddress($symbol)
    {
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime();                
        $getaddress = $api->depositAddress("$symbol");
        $address = $getaddress['address'];

        return redirect('/admin/finance?address='.$address.'&symbol='.$symbol.'&active=depositrequest');
    }


    public function DepositConfirmed($id, $user_id)
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

        
        $deposit = transections::findOrFail($id);
        $deposit->status = 3;
        $deposit->save();

        $depositdata = transections::findOrFail($id);
        $userupt = User::findOrFail($user_id);
        $userupt->balance = $userupt->balance+$depositdata->amount;
        $userupt->save();

        Toastr::success('Deposit Successfully Approved.', 'Approved', ['options']);
        return back();

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }

    public function withdraw()
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

        
        $data['tittle'] = 'Admin Dashboard | Deposits';
        $data['set'] = settings::whereid(1)->first();        

        return view('admin.withdraw', $data);

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }

    public function WithdrawConfirmed(request $request)
    {
        $user = User::findOrFail(Auth::user()->id);
        if($user->type==2){

        
        $withdraw = withdrawals::findOrFail($request->trx_id);
        $withdraw->status = 3;
        $withdraw->save();

        if($withdraw->method_name == "Exchange Withdrawals")
        {
            $set = settings::findOrFail(1);
            $refuser = User::whereref_id($withdraw->referred_by)->first();
            $refuser->balance = $refuser->balance+$set->exchange_widget_ref_earning;
            $refuser->ref_earnings = $refuser->ref_earnings+$set->exchange_widget_ref_earning;
            $refuser->ref_users = $refuser->ref_users+1;
            $refuser->save();

            $refhistory = new ref_history();
            $refhistory->user_id = $refuser->id;
            $refhistory->name = 'Exchange Widget';
            $refhistory->country = 'Not Set';
            $refhistory->earnings = $set->exchange_widget_ref_earning;
            $refhistory->save();
        }else{

        }


        Toastr::success('Deposit Successfully Approved.', 'Approved', ['options']);
        return redirect('/admin/finance?active=withdrawrequest');

        }
        else{
        Toastr::warning('Sorry your are not allowed to this area.', 'Warning', ['options']);
        return redirect('/dashboard');  
        }
    }
     
}
