<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Mail\UserVerification;

class MailController extends Controller
{
    public function UserVerification($name, $emailcode)
    {
        $details = [
            'username' => '$name',
            'emailcode' => '$emailcode'
        ];

        Mail::to("msurubel1@gmail.com")->send(new UserVerification($details));
    }
}
