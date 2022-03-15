<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ProductAttribute;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    public function cart()
    {
        $carts = Cart::userCartItems();
       // $carts->product;
      // echo "<pre>"; print_r($carts); die();
        return view('front.products.cart')->with(compact('carts'));
    }

    public function updateCartQuantity()
    {
        if(request()->ajax())
        {
            $data = request()->all();
            // echo "<pre>";
            // print_r($data);
            // die();
            $cart = Cart::find($data['cartId']);
            $cartStock = ProductAttribute::select('stock')->where(['product_id' => $cart['product_id'],'size' => $cart['size']])->first()->toArray();
            if($data['newQuantity'] > $cartStock['stock'])
            {
                $carts = Cart::userCartItems();
                return response()->json([
                                    'status' => false,
                                    'message' => 'Product Stock is not available.',
                                    'view' => (String)View::make('front.products._cart-items')->with(compact('carts'))]);
            }

            $sizeAvailable = ProductAttribute::where(['product_id' => $cart['product_id'],'size' => $cart['size'],'status' => 1])->count();
            if($sizeAvailable == 0)
            {
                $carts = Cart::userCartItems();
                return response()->json([
                                            'status' => false,
                                            'message' => 'Product Size is not available',
                                            'view' => (String)View::make('front.products._cart-items')->with(compact('carts'))]);
            }
            Cart::where(['id' => $data['cartId']])->update(['quantity' => $data['newQuantity']]);
            $carts = Cart::userCartItems();
            return response()->json(['status'=>true,'view' => (String)View::make('front.products._cart-items')->with(compact('carts'))]);
        }
    }

    public function deleteCartQuantity()
    {
        if(request()->ajax()){
            $data = request()->all();
            Cart::find($data['cartId'])->delete();
            $carts = Cart::userCartItems();
            return response()->json([
                    'status' => true,
                    'message' => 'Item deleted Successfully',
                    'view' => (String)View::make('front.products._cart-items')->with(compact('carts'))
            ]);
        }
    }
}
