<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Models\miningcryptos;
use App\Models\transections;
use App\Models\User;
use App\Models\balances;

class MiningFundTransfer extends Component
{
    public $minigcryptos;
    public $sender;
    public $reciver = 'mainaccount';
    public $notvalid = 1;
    public $notify = 1;
    public $notifytype;
    public $notifymassage;
    public $confirm = 2;

    public function mount()
    {
        $this->minigcryptos = miningcryptos::whereuser_id(Auth::user()->id)->get();
    }

    public function updated()
    {
        $this->notify = 1;
        $this->reciver = $this->reciver;
    }

    public function FundTransferConfirm()
    {
        if(empty($this->reciver)){

        }
        else{
            $this->confirm = 1;
            $this->notify = 1;
        }        
    }

    public function TransferFund()
    {        
        $sender = miningcryptos::whereuser_id(Auth::user()->id)->wheresymbol($this->sender)->first();
        
        if(empty($sender->minig_balance)){
            $this->confirm = 2;
            
            $this->alert('error', 'Your have no balance.', [ 
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
            if($this->reciver == 'mainaccount'){
            $mcrypto = miningcryptos::whereuser_id(Auth::user()->id)->wheresymbol($this->sender)->first();
            $user = User::findOrFail(Auth::user()->id);
            $user->balance = $user->balance+$mcrypto->minig_balance_usd;
            $user->save();            

            $transections = new transections();
            $transections->user_id = Auth::user()->id;
            $transections->ref = Str::random(10);
            $transections->method_name = 'Transfer Mining Balance of ('.$this->sender.')';
            $transections->method_symbol = 'Transfer Mining Fund';
            $transections->amount = $mcrypto->minig_balance_usd;
            $transections->fees = 0;
            $transections->type = 4;
            $transections->status = 1;
            $transections->save();

            $mcrypto->minig_balance = 0;
            $mcrypto->minig_balance_usd = 0;
            $mcrypto->save();

            $this->confirm = 2;

            $this->alert('success', 'Your Mining Balance Transfered.', [ 
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
                $mcrypto = miningcryptos::whereuser_id(Auth::user()->id)->wheresymbol($this->sender)->first();
                if(balances::whereuser_id(Auth::user()->id)->wheresymbol($this->sender)->first())
                {
                $balance = balances::whereuser_id(Auth::user()->id)->wheresymbol($this->sender)->first();
                $balance->balance = $balance->balance+$mcrypto->minig_balance;
                $balance->save();
                }
                else
                {
                    $balance = new balances();
                    $balance->user_id = Auth::user()->id;
                    $balance->name = strtolower($this->sender);
                    $balance->symbol = $this->sender;
                    $balance->balance = $mcrypto->minig_balance;
                    $balance->balance_usd = $mcrypto->minig_balance_usd;
                    $balance->status = 1;
                    $balance->save(); 
                }
                $mcrypto->minig_balance = 0;
                $mcrypto->minig_balance_usd = 0;
                $mcrypto->save();

                $this->confirm = 2;

                $this->notify = 2; 
                $this->notifytype = 'success';
                $this->notifymassage = 'Your Mining Balance Transfered.';
            }
                    
        }
    }


    public function render()
    {
        return view('livewire.mining-fund-transfer');
    }
}
