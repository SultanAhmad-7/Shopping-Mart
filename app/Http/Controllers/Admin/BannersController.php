<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class BannersController extends Controller
{
    public function index()
    {
        $banners = Banner::where(['status' => 1])->get();
        // echo "<pre>" ; print_r($banners); die();
        return view('admin.banners.index')->with(compact('banners'));
    }

    public function addEditBanner(Request $request,$id=null)
    {
        if($id=="")
        {
            $title = 'Add New Banner';
            $message = 'Banner Added Successfully.';
            $banner = new Banner;
        }else{
            $title = 'Add Banner';
            $message = 'Banner Updated Successfully.';
            $banner = Banner::findOrFail($id);
        }

        if($request->isMethod('POST'))
        {
            $data = $request->all();
                if($request->hasFile('image'))
                {
                    $image = $request->file('image');
                    if($image->isValid())
                    {
                        
                        $extension = $image->extension();
                        $imageName = random_int(111,9999).".".$extension;
                        $path = "img/adm_img/carousel/". $imageName;
                       //echo "<pre>"; print_r($imageName); die();
                       Image::make($image)->resize(1170,480)->save($path);
                       $banner->image = $imageName;
                    }
                    
                  
                }
            $banner->link = $data['link'];
            $banner->title = $data['title'];
            $banner->alt = $data['alt'];
            $banner->status = 1;
            $banner->save();

            return redirect()->route('banner.list')->with('success_msg', $message);
        }
        return view('admin.banners.add-edit-banner')->with(compact('title','banner'));
    }
     /**
     * @return status active or inactive
     */
    public function updateBannerStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Banner::where('id', $data['banner_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'banner_id' => $data['banner_id']]);
        }
    }

    /**
     * Delete Banners
     */
    public function deleteBanner($id)
    {
        //$this->deleteCategoryImageFromDirector($id);
        //$categoryDelete = Category::where('id', $id)->delete();
       
       //  if(isset($categoryDelete)) {
       //     Category::where('parent_id')->first()->delete();
       //  }
       $banner = Banner::where('id', $id)->first();
       $path = 'img/adm_img/carousel/';
       if(! empty($banner) && $banner != '')
       {
        if(file_exists($path.$banner->image))
        {
                unlink($path.$banner->image);
        }
       }

       Banner::where('id', $id)->delete();
        //Session::flash('success_msg', 'Product Deleted Successfully.');
        return redirect()->back()->with('success_msg', 'Banner Deleted Successfully.');
    }
}
