<?php

namespace App\Http\Controllers\Front;

use App\Cart;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    public function index($url)
    {
        if(request()->ajax())
        {
            $data = request()->all();
           // echo "<pre>"; print_r($data); die();
           $url = $data['url'];
           $urlCheck = Category::where(['url' => $url, 'status' => 1])->count();
             if(! empty($urlCheck))
             {
                 //echo "its working";
                 // getting current url
                
                 $categoryDetail = Category::categories($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetail['catIds'])->where('status',1);
                 
                if(isset($data['fabric']) && !empty($data['fabric']))
                {
                 $categoryProducts->whereIn('fabric',$data['fabric']);
                }
                if(isset($data['sleeve']) && !empty($data['sleeve']))
                {
                 $categoryProducts->whereIn('sleeve',$data['sleeve']);
                }
                if(isset($data['pattern']) && !empty($data['pattern']))
                {
                 $categoryProducts->whereIn('pattern',$data['pattern']);
                }
                if(isset($data['fit']) && !empty($data['fit']))
                {
                 $categoryProducts->whereIn('fit',$data['fit']);
                }
                if(isset($data['occasion']) && !empty($data['occasion']))
                {
                 $categoryProducts->whereIn('occasion',$data['occasion']);
                }
                if(isset($_GET['sort']) && !empty($_GET['sort']))
                {
                     if($_GET['sort'] == 'newest-arrivals')
                     {
                         $categoryProducts->orderBy('id','Desc');
                     }else if($_GET['sort'] == 'product-a-z') {
                         $categoryProducts->orderBy('product_name','ASC');
                     }else if($_GET['sort'] == 'product-z-a') {
                         $categoryProducts->orderBy('product_name','DESC');
                     }else if($_GET['sort'] == 'price-low-to-high') {
                         $categoryProducts->orderBy('product_price','ASC');
                     }else if($_GET['sort'] == 'price-hight-to-low') {
                         $categoryProducts->orderBy('product_price','DESC');
                     }
                }else{
                     $categoryProducts->orderBy('id','Desc');
                    }
                    $categoryProducts = $categoryProducts->paginate(6);
                  // $categoryProducts = json_decode(json_encode($categoryProducts),true);
                 //   echo "<pre>"; print_r($categoryDetail); 
                 // echo "<pre>"; print_r($categoryProducts); die();
                    return view('front.products.ajax_product_filter')->with(compact('categoryDetail','categoryProducts','url'));
                 }else{
                     abort(404);
                 }

        }else{
           // $url = Route::getFacadeRoot()->current()->uri();

          //  echo "<pre>"; print_r($url); die();
            $urlCheck = Category::where(['url' => $url, 'status' => 1])->count();
            if(! empty($urlCheck))
            {
                //echo "its working";
                $categoryDetail = Category::categories($url);
                //dd($category);
               
               $categoryProducts = Product::with('brand')->whereIn('category_id',$categoryDetail['catIds'])->where('status',1);
               $categoryProducts = $categoryProducts->paginate(30);
             // $categoryProducts = json_decode(json_encode($categoryProducts),true);
            //   echo "<pre>"; print_r($categoryDetail); 
            // echo "<pre>"; print_r($categoryProducts); die();
            $productFilter = Product::filters();
           $fabricArray = $productFilter['fabricArray'];
           $sleeveArray = $productFilter['sleeveArray'];
          $patternArray = $productFilter['patternArray'];
              $fitArray = $productFilter['fitArray'];
        $occasionArray =  $productFilter['occasionArray'];

        $page_name = 'listing';
               return view('front.products.list')->with(compact('categoryDetail',
                                                                                    'categoryProducts',
                                                                                    'url',
                                                                                    'fabricArray',
                                                                                    'sleeveArray',
                                                                                    'patternArray',
                                                                                    'fitArray',
                                                                            'occasionArray',
                                                                                        'page_name'));
            }else{
                abort(404);
            }
        }
       
    }

    /**
     * show method is used to display the detail-product-page
     */
    public function show($id)
    {
        $productDetail = Product::with('category','brand','images','attributes')->find($id)->toArray();
      //  echo "<pre>"; print_r($productDetail); die();
       $productRelated = Product::where(['category_id' => $productDetail['category']['id']])->where('id','!=',$id)->inRandomOrder()->limit(6)->get()->toArray();
      // echo "<pre>", print_r($productRelated); die();
      $productStocks = ProductAttribute::where('product_id',$id)->sum('stock');
      //echo "<pre>"; print_r($productStocks); die();
     
        return view('front.products.product_detail')
                        ->with(compact(
                                            'productDetail',
                                            'productRelated',
                                            'productStocks'
                                            ));
    }
    /**
     * productPrice for Attributes.
     * SMALL, MEDIUM, LARGE size price will be displayed.
     */

    public function productPrice()
    {
        if(request()->ajax())
        {
            $data = request()->all();
            //echo "<pre>"; print_r($data); die();
            $result = ProductAttribute::where(['product_id' => $data['product_id'], 'size' => $data['size']])->first();
           return $result->price;
        }
    }

    public function addToCart()
    {
        $data = request()->all();
     // echo "<pre>"; print_r($data); die();
       $stock = ProductAttribute::select('stock')->where(['product_id' => $data['product_id'], 'size' => $data['size']])->first()->toArray();
      if($stock['stock'] < $data['quantity'])
      {
          $message = 'Required Product is out of stock';
        Session::flash('error_message', $message);
        return redirect()->back();
      }
        //echo "<pre>"; print_r($stock); die();
        // Now generate Session-Id is user is not login
        $session_id = Session::get('session_id');
        if(empty($session_id))
        {
            $session_id = Session::getId();
            Session::put('session_id', $session_id);
        }

        // check either product exists in cart table or not.
        if(Auth::check())
        {
            $cartProductCount = Cart::where(['product_id'=>$data['product_id'], 'size' => $data['size'], 'user_id' => Auth::user()->id])->count();
        }else{
            $cartProductCount = Cart::where(['product_id'=>$data['product_id'], 'size' => $data['size'], 'session_id' => Session::get('session_id')])->count();
        }

        
        if($cartProductCount > 0)
        {
            $message = 'Product already exists in cart.';
            Session::flash('error_message', $message);
            return redirect()->back();
        }

        $cart = new Cart;
        $cart->session_id = $session_id;
        $cart->product_id = $data['product_id'];
        $cart->size = $data['size'];
        $cart->quantity = $data['quantity'];
        $cart->save();
        $message = 'Added to cart successfully';
        Session::flash('success_message',$message);
        return redirect()->back();

    }
}
