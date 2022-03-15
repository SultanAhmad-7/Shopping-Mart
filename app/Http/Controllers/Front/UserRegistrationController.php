<?php

namespace App\Http\Controllers\Front;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Session\Session;

class UserRegistrationController extends Controller
{
    public function registerForm()
    {
        return view('front.auth.register');
    }

    public function checkEmail(Request $request) 
    {
        $data = $request->all();
        // echo "<pre>";
        // print_r($data);
        // die();
        $emailCheck = User::where('email',$data['email'])->count();
        if($emailCheck>0){
            return "false";
        }else{
            return "true";
        }
    }

    public function registerUser()
    {
        
       if(request()->isMethod('post'))
       {
           $data = request()->all();
            $emailExistsOrNot = User::where(['email' => $data['email']])->count();
         if($emailExistsOrNot > 0)
         {
          return redirect()->back()->with('message', 'Email already exists.');
         }else{
           
            $user = new User();
            $user->name = $data['name'];
            $user->mobile = $data['mobile'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->status = 1;
            $user->save();
            if(Auth::attempt(['email' => $data['email'],'password' => $data['password']]))
            {
                return redirect(url('cart'));
            }
            
         }
       }
        
       
    }
}
