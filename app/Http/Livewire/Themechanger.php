<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Themechanger extends Component
{
    public $userid;

    public function changetheme($tid){
        $user = User::findOrFail($this->userid);
        $user->theme_set = $tid;
        $user->save();
        return redirect()->back(''.Request::url().'');
    }


    public function render()
    {
        return view('livewire.themechanger');
    }
}
