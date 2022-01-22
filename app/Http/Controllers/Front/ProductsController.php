<?php

namespace App\Http\Controllers\Front;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index($url)
    {
        $urlCheck = Category::where(['url' => $url, 'status' => 1])->count();
        if(! empty($urlCheck))
        {
            //echo "its working";
            $categoryDetail = Category::categories($url);
            //dd($category);
           
           $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetail['catIds'])->where('status',1)->paginate(6);
         // $categoryProducts = json_decode(json_encode($categoryProducts),true);
        //   echo "<pre>"; print_r($categoryDetail); 
        // echo "<pre>"; print_r($categoryProducts); die();
           return view('front.products.list')->with(compact('categoryDetail','categoryProducts'));
        }else{
            echo "its not working";
        }
    }
}
