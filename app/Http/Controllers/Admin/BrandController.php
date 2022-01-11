<?php

namespace App\Http\Controllers\Admin;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $title = 'All Brands';
        $brands = Brand::all();
        return view('admin.brands.index')->with(compact('title','brands'));
    }

    public function addEditBrand($id=null)
    {
        if($id=="")
        {
            $title = 'Add Brand';
            $brand = new Brand;
            $message = 'Brand Inserted Successfully';
            $btn = 'Save';
        }else{
            $title = 'Edit Brand';
            // $editBrand = Brand::where('id',$id)->get();
            // $editBrand = json_decode(json_encode($editBrand), true);
            // echo "<pre>";
            // print_r($editBrand);
            // die();
            $brand = Brand::find($id);
            $message = 'Brand Updated Successfully';
            $btn = 'Update';

        }
    
        if(request()->isMethod('POST'))
        {
            $data = request()->all();

            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u'
            ];

            $msgCustomization = [
                'name.required' => 'Brand Name is Required.',
                'name.regex'    => 'Valid Brand Name is Required.'
            ];
            $this->validate(request(), $rules, $msgCustomization);
            $brand->name = $data['name'];
            $brand->status = 1;
            $brand->save();

            return redirect(route('brand.lists'))->with('success_msg', $message);
        }

        return view('admin.brands.create')->with(compact('title', 'btn', 'brand'));
    }

    public function destroy($id)
    {
            //$this->deleteCategoryImageFromDirector($id);
            //$categoryDelete = Category::where('id', $id)->delete();
           
           //  if(isset($categoryDelete)) {
           //     Category::where('parent_id')->first()->delete();
           //  }
           Brand::where('id', $id)->delete();
            return back()->with('success_msg', 'Brand Deleted Successfully.');
        
    }

    // Brand Update Status
    public function updateStatus(Request $request)
    {
        
        if($request->ajax())
        {
            $data = $request->all();
            //return $data;
            if($data['status'] == 'Active'){
                    $status = 0;
            }else {
                $status = 1;
            }
            // Perform MySQL query
            Brand::where('id', $data['brand_id'])->update(['status'=>$status]);
            // Then it will return a response in json form to admin_script success call back
            return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
        }
     }
}
