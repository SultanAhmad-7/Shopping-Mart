<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
                // check either user has status 0 or 1 if 0, invalid email/password
                $userEmail = User::where(['email' => $data['email']])->first();
                if($userEmail['status'] == 0)
                {
                    Auth::logout();
                    Session::flash('message', 'Please Confirm your Email Address.');
                    return redirect()->back();
                }
                // update cart table if the user added with session record,
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
