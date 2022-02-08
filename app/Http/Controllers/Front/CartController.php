<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function cart()
    {
        $carts = Cart::userCartItems();
       // $carts->product;
      // echo "<pre>"; print_r($carts); die();
        return view('front.products.cart')->with(compact('carts'));
    }
}
