<?php

namespace App\Http\Controllers;

    
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ActivationYourAccount;
  



class ActivationController extends Controller
{
    //
    public function activateUserAccount($code){
        $user = User::whereCode($code)->first();
        $user->code =null;
        $user->update (['active'=>1]);
        Auth::login($user);
        
        return redirect('/')->withSuccess( 'Account activated successfully');
    }

    public function resendActivationCode($email){
        $user = User::whereEmail($email)->first();
        if($user->active){
            return redirect('/')->withError('Account already activated');
        }
        Mail::to($user)->send(new ActivationYourAccount($user->code));
        return redirect('/login')->withSuccess( 'activation link sent to your email');
    }
}
