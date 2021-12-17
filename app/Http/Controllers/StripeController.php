<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\settings;

class StripeController extends Controller
{
    public function stripe()
    {
        $data['tittle'] = 'Bank Card Payment | Stripe';
        $data['set'] = settings::findOrFail(1);
        return view('user.paymentpage.stripe', $data);
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100,
                "currency" => "USD",
                "source" => $request->stripeToken,
                "description" => "This payment is testing purpose of websolutionstuff.com",
        ]);
   
        Session::flash('success', 'Payment Successful !');
           
        return back();
    }
}
