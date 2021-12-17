<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\withdrawals;

class WithdrawRequestAdmin extends Component
{
    public $withdrawall;
    public $withdrawcount;

    public function mount()
    {
        $this->withdrawall = withdrawals::orderBy('id', 'DESC')->get();
        $this->withdrawcount = withdrawals::all()->count();
    }

    public function render()
    {
        return view('livewire.withdraw-request-admin');
    }
}
