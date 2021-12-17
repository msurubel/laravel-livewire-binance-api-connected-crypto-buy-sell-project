<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Models\User;
use App\Models\setmininglist;
use App\Models\miningcryptos;
use App\Models\settings;
use App\Models\miningdevices;
use App\Models\buyminingdevice;
use App\Models\transections;

class Cryptominingform extends Component
{
    public $setminingc;
    public $thsp;
    public $set;
    public $devices;
    public $deviceid;
    public $dqty;
    public $coinid;
    public $cost = 0;
    public $khs = 0;
    public $kwhs = 0;
    public $earnings = 0;
    public $devicename = 'Not Selected';
    public $notify = 1;
    public $notifytype;
    public $notifymassage;
    public $deviceintfees = 0;
    

    public function mount()
    {
        $this->setminingc = setmininglist::wherestatus(1)->get();
        $this->set = settings::findOrFail(1);
        $this->devices = miningdevices::wherestatus(1)->get();
        $this->dqty = 1;
    }

    public function updated($deviceid)
    {
        $set = settings::findOrFail(1);

        if(empty($this->deviceid)){
            $this->cost = 0;
            $this->khs = 0;
            $this->kwhs = 0;
            $this->earnings = 0;
            $this->devicename = 'Not Selected';
        }
        else{
            $devicedata = miningdevices::findOrFail($this->deviceid);        
            if(empty($this->dqty)){
                $this->cost = $devicedata->buy_cost;
                $this->khs = $devicedata->power_khs;
                $this->kwhs = $devicedata->power_kwhs;
                $this->earnings = $devicedata->day_income;
                $this->devicename = $devicedata->name;
            }
            else{
                $this->cost = $devicedata->buy_cost*$this->dqty;
                $this->khs = $devicedata->power_khs*$this->dqty;
                $this->kwhs = $devicedata->power_kwhs*$this->dqty;
                $this->earnings = $devicedata->day_income*$this->dqty;
                $this->devicename = $devicedata->name;
                $this->deviceintfees = $set->mining_device_int_fees;
            }
            $this->notify = 1;
        }
    }


    public function buyminingdevices()
    {
        $set = settings::findOrFail(1);
        $userdata = User::findOrFail(Auth::user()->id);
        $devicedata = miningdevices::findOrFail($this->deviceid); 
        $cost = $devicedata->buy_cost*$this->dqty;
        $finalcost = $cost+$set->mining_device_int_fees;
        $dstr = Str::random(10);
        $cryptodata = miningcryptos::wheresymbol("$this->coinid")->whereuser_id(Auth::user()->id)->first();
       
        if($cryptodata->status == 1 || $cryptodata->status == 2){
            if($userdata->balance>$finalcost){
                $khs = $devicedata->power_khs*$this->dqty;
                $earnings = $devicedata->day_income*$this->dqty;
                

                $addpower = miningcryptos::wheresymbol("$this->coinid")->whereuser_id(Auth::user()->id)->first();
                $addpower->mining_power = $addpower->mining_power+$khs;
                $addpower->day_income = $addpower->day_income+$earnings;
                $addpower->device_ref = $dstr;
                $addpower->status = 3;
                $addpower->save(); 
                
                $userupt = User::findOrFail(Auth::user()->id);
                $userblnvalue = $userupt->balance-$cost;
                $userupt->balance = $userblnvalue-$set->mining_device_int_fees;
                $userupt->save();
                
                $device = new buyminingdevice();
                $device->order_ref = $dstr;
                $device->user_id = Auth::user()->id;
                $device->name = $devicedata->name;
                $device->symbol_for = $this->coinid;
                $device->cost_kwhs = 0.10;
                $device->power_kwhs = $devicedata->power_kwhs;
                $device->day_income = $devicedata->day_income;
                $device->power_khs = $devicedata->power_khs;
                $device->quantity = $this->dqty;
                $device->buy_cost = $cost;
                $device->status = 2;
                $device->save();

                $transections = new transections();
                $transections->user_id = Auth::user()->id;
                $transections->ref = Str::random(10);
                $transections->method_name = 'Purchased Mining Device ('.$devicedata->name.')';
                $transections->method_symbol = 'Mining Device';
                $transections->amount = $cost;
                $transections->fees = $set->mining_device_int_fees;
                $transections->type = 4;
                $transections->status = 1;
                $transections->save();                

                $this->alert('success', 'Device Successfully Purchased.', [ 
                    'timer' =>  '5500', 
                    'toast' =>  true, 
                    'text' =>  '', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Cancel', 
                    'showCancelButton' =>  false, 
                    'showConfirmButton' =>  false, 
                ]);

                $this->emit('RefreshBuyDevices');
                $this->emit('RefreshTransferPower');

            }
            else{
                $this->alert('error', 'You have no balance.', [ 
                    'timer' =>  '5500', 
                    'toast' =>  true, 
                    'text' =>  '', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Cancel', 
                    'showCancelButton' =>  false, 
                    'showConfirmButton' =>  false, 
                ]);
            }
        }else{
            $this->notify = 2;
            $this->notifytype = 'warning';
            $this->notifymassage = 'You can not buy or add kH/s Power for not active crypto.';

            $this->alert('error', 'You can not buy more power for NOT ACTIVE crypto.', [ 
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
        return view('livewire.cryptominingform');
    }
}
