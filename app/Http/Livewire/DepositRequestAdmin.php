<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\transections;

class DepositRequestAdmin extends Component
{
    public $depositall;
    public $depositcount;
    public $depositamount;

    public function mount()
    {
        $this->depositall = transections::wheretype(1)->orderBy('id', 'DESC')->get();
        $this->depositcount = transections::wheretype(1)->count();
        $this->depositamount = transections::wheretype(1)->sum('amount');
    }

    public function render()
    {
        return view('livewire.deposit-request-admin');
    }
}
