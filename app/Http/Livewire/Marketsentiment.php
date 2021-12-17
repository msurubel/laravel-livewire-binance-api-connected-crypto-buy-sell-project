<?php

namespace App\Http\Livewire;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;

use App\Models\User;
use App\Models\market_sentiment;
use App\Models\settings;
use App\Models\transections;

class Marketsentiment extends Component
{
    protected $listeners = ['Refreshpredictionsection' => 'mount'];


    public $addsentiment = 1;
    public $symbol;
    public $percent;
    public $user;
    public $pubdaycount;
    public $test;
    public $set;

    public function mount($symbol)
    {
        $this->set = settings::findOrFail(1);
        if(substr($symbol, -4) == 'USDT'){
            $getsymbols = substr($symbol, 0, -4);
        }else{
            $getsymbols = substr($symbol, 0, -3);
        }        

        if(market_sentiment::wheresymbol($getsymbols)->count()>0.1){
            if(substr($symbol, -4) == 'USDT'){
                $getsymbol = substr($symbol, 0, -4);
                $wl = market_sentiment::wheresymbol($getsymbol)->whereIn('type', ['BUY'])->where('created_at', '>=', Carbon::now()->subDays(15))->count();
                $total = market_sentiment::wheresymbol($getsymbol)->where('created_at', '>=', Carbon::now()->subDays(15))->count();
                if($wl>0.1){
                    $this->percent = $wl / $total * 100;
                }else{
                    $this->addsentiment = 2;
                } 
            }else{
                $getsymbol = substr($symbol, 0, -3);
                $wl = market_sentiment::wheresymbol($getsymbol)->whereIn('type', ['BUY'])->where('created_at', '>=', Carbon::now()->subDays(15))->count();
                $total = market_sentiment::wheresymbol($getsymbol)->where('created_at', '>=', Carbon::now()->subDays(15))->count();
                if($wl>0.1){
                    $this->percent = $wl / $total * 100;
                }else{
                    $this->addsentiment = 2;
                } 
            }
        }else{
            $this->addsentiment = 2;
        }
        

        $this->user = User::findorFail(Auth::user()->id);
        $publishcounter = market_sentiment::whereuser_id(Auth::user()->id)->where('created_at', '>=', Carbon::now()->subDays(7))->count();

        if($publishcounter>1 || $publishcounter == 1){
            $this->pubdaycount = 2;
        }
        else{
            $this->pubdaycount = 1;
        }
    }


    public function refreshalldata ()
    {
        $this->set = settings::findOrFail(1);
        if(substr($this->symbol, -4) == 'USDT'){
            $getsymbols = substr($this->symbol, 0, -4);
        }else{
            $getsymbols = substr($this->symbol, 0, -3);
        }        

        if(market_sentiment::wheresymbol($getsymbols)->count()>0.1){
            if(substr($this->symbol, -4) == 'USDT'){
                $getsymbol = substr($this->symbol, 0, -4);
                $wl = market_sentiment::wheresymbol($getsymbol)->whereIn('type', ['BUY'])->where('created_at', '>=', Carbon::now()->subDays(15))->count();
                $total = market_sentiment::wheresymbol($getsymbol)->where('created_at', '>=', Carbon::now()->subDays(15))->count();
                if($wl>0.1){
                    $this->percent = $wl / $total * 100;
                }else{
                    $this->addsentiment = 2;
                } 
            }else{
                $getsymbol = substr($this->symbol, 0, -3);
                $wl = market_sentiment::wheresymbol($getsymbol)->whereIn('type', ['BUY'])->where('created_at', '>=', Carbon::now()->subDays(15))->count();
                $total = market_sentiment::wheresymbol($getsymbol)->where('created_at', '>=', Carbon::now()->subDays(15))->count();
                if($wl>0.1){
                    $this->percent = $wl / $total * 100;
                }else{
                    $this->addsentiment = 2;
                }                

            }
        }else{
            $this->addsentiment = 2;
        }
        

        $this->user = User::findorFail(Auth::user()->id);
        $publishcounter = market_sentiment::whereuser_id(Auth::user()->id)->where('created_at', '>=', Carbon::now()->subDays(7))->count();

        if($publishcounter>1 || $publishcounter == 1){
            $this->pubdaycount = 2;
        }
        else{
            $this->pubdaycount = 1;
        }
    }


    public function addbuypradiction()
    {
        $set = settings::findOrFail(1);

        if(substr($this->symbol, -4) == 'USDT'){
            $create = new market_sentiment();
            $create->user_id = Auth::user()->id;
            $create->symbol = substr($this->symbol, 0, -4);
            $create->type = 'BUY';
            $create->save();

            $user = User::findorFail(Auth::user()->id);
            $user->balance = $user->balance+$set->prediction_earning;
            $user->save();

            $transections = new transections();
            $transections->user_id = Auth::user()->id;
            $transections->ref = Str::random(10);
            $transections->method_name = 'Prediction Earning';
            $transections->method_symbol = substr($this->symbol, 0, -4);
            $transections->amount = $set->prediction_earning;
            $transections->fees = 0;
            $transections->type = 1;
            $transections->status = 3;    
            $transections->save();  
            
            $this->addsentiment = 1;

        }else{
            $create = new market_sentiment();
            $create->user_id = Auth::user()->id;
            $create->symbol = substr($this->symbol, 0, -3);
            $create->type = 'BUY';
            $create->save();

            $user = User::findorFail(Auth::user()->id);
            $user->balance = $user->balance+$set->prediction_earning;
            $user->save();

            $transections = new transections();
            $transections->user_id = Auth::user()->id;
            $transections->ref = Str::random(10);
            $transections->method_name = 'Prediction Earning';
            $transections->method_symbol = substr($this->symbol, 0, -3);
            $transections->amount = $set->prediction_earning;
            $transections->fees = 0;
            $transections->type = 1;
            $transections->status = 3;    
            $transections->save();

            $this->addsentiment = 1;
        }
    }

    public function addsellpradiction()
    {
        $set = settings::findOrFail(1);

        if(substr($this->symbol, -4) == 'USDT'){
            $create = new market_sentiment();
            $create->user_id = Auth::user()->id;
            $create->symbol = substr($this->symbol, 0, -4);
            $create->type = 'SELL';
            $create->save();

            $user = User::findorFail(Auth::user()->id);
            $user->balance = $user->balance+$set->prediction_earning;
            $user->save();

            $transections = new transections();
            $transections->user_id = Auth::user()->id;
            $transections->ref = Str::random(10);
            $transections->method_name = 'Prediction Earning';
            $transections->method_symbol = substr($this->symbol, 0, -4);
            $transections->amount = $set->prediction_earning;
            $transections->fees = 0;
            $transections->type = 1;
            $transections->status = 3;    
            $transections->save();  
            
            $this->addsentiment = 1;

        }else{
            $create = new market_sentiment();
            $create->user_id = Auth::user()->id;
            $create->symbol = substr($this->symbol, 0, -3);
            $create->type = 'SELL';
            $create->save();

            $user = User::findorFail(Auth::user()->id);
            $user->balance = $user->balance+$set->prediction_earning;
            $user->save();

            $transections = new transections();
            $transections->user_id = Auth::user()->id;
            $transections->ref = Str::random(10);
            $transections->method_name = 'Prediction Earning';
            $transections->method_symbol = substr($this->symbol, 0, -3);
            $transections->amount = $set->prediction_earning;
            $transections->fees = 0;
            $transections->type = 1;
            $transections->status = 3;    
            $transections->save();

            $this->addsentiment = 1;
        }        
    }

    public function render()
    {
        return view('livewire.marketsentiment');
    }
}
