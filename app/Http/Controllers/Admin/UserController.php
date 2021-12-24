<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.users.index',compact('users'));
    }

    public function updateUserStatus(Request $request){
        if($request->ajax()){
            $data = $request->all();
           
            if($data['status'] == "UnBlock"){
                $status = 0;
            }else{
                $status = 1;
            }
            // MySQL eloquent will update the status against the specific id.
            User::where('id', $data['user_id'])->update(['status' => $status]);
            // After Update status, it will return response to ajax success call back method.
            return response()->json(['status' => $status, 'user_id' => $data['user_id']]);
        }
    }
}
