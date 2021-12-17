<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

use App\Models\miningcryptos;

class MiningPowerTransferForm extends Component
{
    protected $listeners = ['RefreshTransferPower' => 'mount'];

    public $mscryptos;
    public $mrcryptos;
    public $sender;
    public $reciver;
    public $notvalid = 1;
    public $notify = 1;
    public $notifytype;
    public $notifymassage;
    public $confirm = 2;

    public function mount()
    {
        $this->mscryptos = miningcryptos::whereuser_id(Auth::user()->id)->wherestatus(1)->get();
        $this->mrcryptos = miningcryptos::whereuser_id(Auth::user()->id)->get();
    }

    public function updated()
    {
        if($this->sender == $this->reciver)
        {
            $this->notvalid = 2;
            $this->notify = 1;
        }
        else{
            $this->notvalid = 1;
            $this->notify = 1;
        }
    }

    public function PowerTransferConfirm()
    {
        if(empty($this->reciver)){

        }
        else{
            $this->confirm = 1;
            $this->notify = 1;
        }         
    }

    public function TransferPower()
    {        
        $sender = miningcryptos::whereuser_id(Auth::user()->id)->wheresymbol($this->sender)->first();
        
        if(empty($sender->mining_power)){
            $this->confirm = 2;
            
            $this->alert('error', 'You have no kH/s Power.', [ 
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

            if(miningcryptos::whereuser_id(Auth::user()->id)->wherestatus(3)->count()>1 || miningcryptos::whereuser_id(Auth::user()->id)->wherestatus(3)->count()== 1){
                $this->alert('error', 'You have on process crypto.', [ 
                    'timer' =>  '5500', 
                    'toast' =>  true, 
                    'text' =>  '', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Cancel', 
                    'showCancelButton' =>  false, 
                    'showConfirmButton' =>  false, 
                ]);
                $this->confirm = 2;
            }else{
                $reciver = miningcryptos::whereuser_id(Auth::user()->id)->wheresymbol($this->reciver)->first();
                $reciver->mining_power = $reciver->mining_power+$sender->mining_power;
                $reciver->day_income = $reciver->day_income+$sender->day_income;
                $reciver->status = 1;
                $reciver->save();

                $sender->day_income = 0;
                $sender->mining_power = 0;
                $sender->status = 2;
                $sender->save();

                $this->confirm = 2;

                $this->alert('success', 'Your kH/s Power Transfered.', [ 
                    'timer' =>  '5500', 
                    'toast' =>  true, 
                    'text' =>  '', 
                    'confirmButtonText' =>  'Ok', 
                    'cancelButtonText' =>  'Cancel', 
                    'showCancelButton' =>  false, 
                    'showConfirmButton' =>  false, 
                ]);
                $this->confirm = 2;
            }           
                    
        }
    }

    public function render()
    {
        return view('livewire.mining-power-transfer-form');
    }
}
