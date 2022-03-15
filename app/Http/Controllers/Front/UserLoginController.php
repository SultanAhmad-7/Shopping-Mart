<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserLoginController extends Controller
{
    public function loginForm()
    {
       return view('front.auth.login');
    }

    public function loginUser(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();
            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
            {
                if(!empty(Session::get('session_id')))
                {
                    $user_id = Auth::user()->id;
                    $session_id = Session::get('session_id');
                    Cart::where('session_id', $session_id)->update(['user_id'=>$user_id]);
                }
                return redirect(url('cart'));
            }else{
                return redirect(url('login'))->with('message', 'Invalid Username or Password.');
            }
     
        }
    }

    public function logoutUser()
    {
        Auth::logout();
        return redirect(url('/'));
    }
}
