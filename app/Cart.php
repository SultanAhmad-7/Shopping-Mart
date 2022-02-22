<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    /**
     * This method is invoked at CartController
     */
    public static function userCartItems()
    {
        if(Auth::check())
        {
            $userCartItem = Cart::with(['product' => function($query){
                $query->select('id','product_name','product_color','product_code','product_price','main_image');
            }])->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get()->toArray();
        }else{
            $userCartItem = Cart::with(['product' => function($query){
                $query->select('id','product_name','product_color','product_code','product_price','main_image');
            }])->where('session_id', Session::get('session_id'))->orderBy('id','DESC')->get()->toArray();
        }

        return $userCartItem;
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // This function is called at front.products.cart.blade.php file 
    /**
     * This method is invoked at front.products.cart page 
     * statically
     */
    public static function getAttrPrice($product_id, $size) 
    {
        $attrPrice = ProductAttribute::select('price')->where(['product_id'=>$product_id, 'size' => $size])->first()->toArray();
        //echo "<pre>"; print_r($attrPrice); die(); 
         return $attrPrice['price'];
    }
}
