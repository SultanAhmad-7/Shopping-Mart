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
        if(request()->ajax())
        {
            $data = request()->all();
           // echo "<pre>"; print_r($data); die();
           $url = $data['url'];
           $urlCheck = Category::where(['url' => $url, 'status' => 1])->count();
        if(! empty($urlCheck))
        {
            //echo "its working";
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
}
