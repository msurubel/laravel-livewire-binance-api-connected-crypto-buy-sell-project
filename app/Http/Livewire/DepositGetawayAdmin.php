<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\getaways;

class DepositGetawayAdmin extends Component
{
    public $getaways;

    public function mount()
    {
        $this->getaways = getaways::all();
    }

    public function render()
    {
        return view('livewire.deposit-getaway-admin');
    }
}
