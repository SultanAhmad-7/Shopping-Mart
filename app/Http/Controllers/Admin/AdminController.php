<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function settings()
    {
        $adminDetail = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        return view('admin.admin_settings')->with(compact('adminDetail'));
    }

    public function chkCurrentPwd(Request $request) 
    {
        $data = $request->all();
        if(Hash::check($data['chkcurrpwd'], Auth::guard('admin')->user()->password))
        {
            echo "true";
        }else {
            echo "false";
        }
    }

    /**
     *  It will check new and confirm password, work if both gonna match.
     */
    public function updatePassword(Request $request)
    {
        if($request->isMethod('POST'))
        {
            $data = $request->all();
            // first we will check either current password is ok or not.
            if(Hash::check($data['chkcurrpwd'], Auth::guard('admin')->user()->password))
            {
                    // if current password is ok then this will run.
                    if($data['newpwd'] == $data['confirmpwd'])
                     {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['newpwd'])]);
                    Session::flash("success_msg", "Password Updated Successfully.");
                    } else {
                        Session::flash('error_msg', "Confirmed Password is not matched.");
                    }
            }else{
                Session::flash('error_msg', "Current Password is not matched.");
            }
          return  redirect()->back();
        }
    }

    // admin detail will be updated.
    public function admindetail(Request $request)
    {
        
        // Now verify Admin Data is correct or not
        if ($request->isMethod('post')) {
            $data = $request->all();

            // echo "<pre>";
            // print_r($data);
            // die;
            $rules = [

                'adm_name' => 'required|alpha',
                'adm_mobile' => 'required|numeric',
                'adm_img' => 'required|image'
            ];
            $msgCustomize = [
                'adm_name.required' => 'Admin Name is Required.',
                'adm_name.alpha' => 'Admin Name must contain Alphatic Letters.',
                'adm_mobile.required' => 'Amin Mobile # is Required.',
                'adm_mobile.numeric' => 'Admin Mobile # Must Be In Numberic Form.',
                'adm_img.required' => 'Admin Profile Image is Required',
                'adm_img.image' => 'Valid Admin Profile Image is Required.'
            ];
            $this->validate($request, $rules, $msgCustomize);

            if ($request->hasFile('adm_img')) {
                $image_tmp = $request->file('adm_img');
                if ($image_tmp->isValid()) {
                    // // Get image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = random_int(111, 999) . '.' . $extension;
                    $imagePath = 'img/adm_img/admin_photos/' . $imageName;
                    // Upload the image
                    Image::make($image_tmp)->resize('400', '400')->save($imagePath);
                } else if (!empty($data['current_admin_image'])) {
                    $imageName = $data['current_admin_image'];
                } else {
                    $imageName = "";
                }
            }
            Admin::where('email', Auth::guard('admin')->user()->email)
                ->update(['name' => $data['adm_name'], 'mobile' => $data['adm_mobile'], 'image' => $imageName]);
            Session::flash("success_msg", "Admin Detail Updated Successfully.");
            return redirect()->back();
        }

        return view('admin/admin_detail');
    }
}
