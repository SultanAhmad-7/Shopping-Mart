<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Product;
use App\Section;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // $sections = Section::sections();
        // $sections = json_decode(json_encode($sections), true);
        $productFeaturedCount = Product::where(['status' => 1,'is_featured' => 'Yes'])->count();
        $productFeatured = Product::where('is_featured', 'Yes')->get()->toArray();
        $productFeaturedChunk = array_chunk($productFeatured, 4);
        $productLatest = Product::where('status',1)->take(6)->orderBy('id','desc')->get()->toArray();

        //echo "<pre>"; print_r($productLatest); die();
        //$products = Product::where(['status'=>1, 'is_featured' => 'Yes'])->get();
        //$products = json_decode(json_encode($products), true);
        //echo "<pre>"; print_r($productFeaturedChunk); die();
        $page = 'index';
        return view('front.index')
                            ->with(compact('page',
                                             //'sections',
                                            'productFeaturedChunk',
                                            'productFeaturedCount',
                                            'productLatest'));
    }

    public function about()
    {
        return view('front.about');
    }
}
