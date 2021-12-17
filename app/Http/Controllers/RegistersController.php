<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;



use App\Models\User;
use App\Models\settings;
use App\Models\ref_history;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\hdnevmain;
use App\Models\hdnevsub;
use App\Models\ftrnevmain;
use App\Models\ftrnevsub;
use App\Models\miningcryptos;
use App\Models\setmininglist;

class RegistersController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    public function index ()
    {
        $data['tittle'] = 'Register New Account';
        $data['set'] = settings::findOrFail(1);
        $data['msgalert'] = '';
        $data['headermain'] = hdnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['headersub'] = hdnevsub::wherestatus(1)->get();
        $data['footermain'] = ftrnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['footersub'] = ftrnevsub::wherestatus(1)->get();
		if(Auth::user()){
			return redirect()->intended('/dashboard');
		}else{
	        return view('auth.register', $data);
		}
    }


    public function NewUserLogin()
    {
        $data['tittle'] = 'User Dashboard - Login';
        $data['set'] = settings::findOrFail(1);
        $data['msgalert'] = 'Your Account Created, You can login now.';
        $data['headermain'] = hdnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['headersub'] = hdnevsub::wherestatus(1)->get();
        $data['footermain'] = ftrnevmain::wherestatus(1)->orderBy('place_id')->get();
        $data['footersub'] = ftrnevsub::wherestatus(1)->get();
        return view('auth.login-new', $data);
    }


    public function NewUser(request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validator->fails()) {
            // adding an extra field 'error'...
            $data['tittle']='Register';
            $data['errors']=$validator->errors();
            $data['set'] = settings::findOrFail(1);
            $data['headermain'] = hdnevmain::wherestatus(1)->orderBy('place_id')->get();
            $data['headersub'] = hdnevsub::wherestatus(1)->get();
            $data['footermain'] = ftrnevmain::wherestatus(1)->orderBy('place_id')->get();
            $data['footersub'] = ftrnevsub::wherestatus(1)->get();
            $data['msgalert'] = '';
            return view('auth.register', $data);
        }

        $set = settings::findOrFail(1);        


        if(empty($request->referedby)){
            $crtuser = new User();
            $crtuser->name = $request->name;
            $crtuser->email = $request->email;
            $crtuser->ref_id = Str::random(7);
            $crtuser->password = Hash::make($request->password);
            $crtuser->save();


            $mininglist = setmininglist::wherestatus(1)->get();

            foreach($mininglist as $cmlists){
                $createmining = new miningcryptos();
                $createmining->user_id = $crtuser->id;
                $createmining->name = $cmlists->name;
                $createmining->symbol = $cmlists->symbol;
                $createmining->minig_balance = 0;
                $createmining->mining_power = 0;
                $createmining->status = 2;
                $createmining->save();
            }
            
            return redirect('/login'.'?msg=Your Account Created, You can login now.');
            
           
        }
        else{
            if(User::where('ref_id', $request->referedby)->first()){
                $crtuser = new User();
                $crtuser->name = $request->name;
                $crtuser->email = $request->email;
                $crtuser->ref_id = Str::random(7);
                $crtuser->password = Hash::make($request->password);
                $crtuser->save();

                $refuser = User::where('ref_id', $request->referedby)->first();
                $refuser->balance = $refuser->balance+$set->ref_bonus;
                $refuser->ref_users = $refuser->ref_users+'1';
                $refuser->ref_earnings = $refuser->ref_earnings+$set->ref_bonus;

                $refhistory = new ref_history();
                $refhistory->user_id = $refuser->id;
                $refhistory->name = $request->name;
                $refhistory->country = 'Not Set';
                $refhistory->earnings = $set->ref_bonus;
                $refhistory->save();
                $refuser->save();
               

                return redirect('/login'.'?msg=Your Account Created, You can login now.');
                
            }
            else{
                $data['tittle'] = 'Register New Account';
                $data['set'] = settings::findOrFail(1);
                $data['msgalert'] = 'Your Referel link not valid please check or remove "?ref=' .$request->referedby. '" from register link and try again.';
                return view('auth.register', $data);
            }
        }
        

    }
}
