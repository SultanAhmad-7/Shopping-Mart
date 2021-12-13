<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    
    // public function __construct()
    // {
    // $this->middleware('guest:admin')->only(route('admin.login'));
    // }
  
    public function login() {
        return view('admin.login');
    }

    public function checkLoginCredentials(Request $request) {
       
           // return Hash::make(1234); die(); // password here is 1234
        if($request->isMethod('POST')){
            $credentials = $request->only('email','password');
            if(Auth::guard('admin')->attempt( $credentials)) {
                return redirect(route('admin.dashboard'));
            } else {
                Session::flash('error_login', 'Invalid Your Credentials.');
                return redirect()->back();
            }
        }
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'));
    }
    public function dashboard() {
        return view('admin.dashboard');
    }

    
}
