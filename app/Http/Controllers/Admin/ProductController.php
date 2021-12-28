<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
   
      
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category' => function($query){
            $query->select('id', 'category_name');
        }, 'section' => function($query){
            $query->select('id', 'name');
        }])->get();
    //   $products = json_decode(json_encode($products), true);
    //     echo "<pre>";
    //     print_r($products);
    //     die();
        return view('admin.products.index')->with(compact('products'));
    }
    
    /**
     * @return status active or inactive
     */
    public function updateProductStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }


    
    /**
     * Delete category
     */

    public function deleteProduct($id)
    {
        //$this->deleteCategoryImageFromDirector($id);
        //$categoryDelete = Category::where('id', $id)->delete();
       
       //  if(isset($categoryDelete)) {
       //     Category::where('parent_id')->first()->delete();
       //  }
       Product::where('id', $id)->delete();
        Session::flash('success_msg', 'Product Deleted Successfully.');
        return redirect()->back();
    }


}
