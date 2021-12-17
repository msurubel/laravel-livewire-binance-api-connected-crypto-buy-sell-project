<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\cryptofees;

class CryptoFeesAdmin extends Component
{
    public $cryptofees;

    public function mount()
    {
        $this->cryptofees = cryptofees::all();  
    }

    public function render()
    {
        return view('livewire.crypto-fees-admin');
    }
}
