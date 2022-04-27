<?php

namespace App\Http\Controllers\Front;

use App\Sms;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserRegistrationController extends Controller
{
    public function registerForm()
    {
        return view('front.auth.register');
    }
    /**
     * confirmEmail() method first verify that either email is equal to email persists in the database.
     * then will update the status from 0 to 1, redirect to login screen.
     */
    public function confirmEmail($email)
    {
        # code...
        Session::forget('message');
         $email = base64_decode($email); 
         $confirmEmail = User::where(['email' => $email])->count();
         if($confirmEmail > 0){
             $userDetails = User::where('email',$email)->first();
             if($userDetails->status == 1){
                Session::put('error_message', 'Your Account is already activated, Please Login Now.');
                return redirect('/login');
             }else{
                User::where('email',$email)->update(['status' => 1]);
                $messageData = [
                    'name' => $userDetails['name'],
                    'mobile' => $userDetails['mobile'],
                    'email' => $userDetails['email']
                ];
                Mail::send('emails.register', $messageData,function($message) use($email){
                    $message->to($email)->subject('Confirm your Email Address.');
                });
                return redirect('/login')->with('success', 'Welcome in Shopping Mart Store. your account has been successfully confirmed.');
             }
        
         }else{
             abort(404);
         }
         

    }
    /***
     * checkEmail() method verify that user entered email already exists or not.
     */

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
    /**
     * User Register Method has all the functionality
     * 
     */
    public function registerUser()
    {
        Session::forget('message');
        
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
            $user->status = 0;
            $user->save();
            // send Register SMS
            // $message = "Welcome in Shopping Mart. You have been successfully registered.";
            // $mobile = $data['mobile'];
            // Sms::sendSms($message,$mobile);
            // Send Register Email
            $email = $data['email'];
            $messageData = [
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'email' => $data['email'],
                'code' => base64_encode($data['email'])
            ];
            Mail::send('emails.confirm', $messageData,function($message) use($email){
                $message->to($email)->subject('Confirm your Email Address.');
            });
            Session::flash('confirm_msg', 'We send you an email to confirm your email address.');
            return redirect()->back();
            // if(Auth::attempt(['email' => $data['email'],'password' => $data['password']]))
            // {
            //     return redirect(url('cart'));
            // }
            
         }
       }
        
       
    }
}
