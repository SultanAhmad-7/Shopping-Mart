<?php

namespace App;

use CategorySeeder;
use Illuminate\Database\Eloquent\Model;
use ProductImageSeeder;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id')->select('id', 'category_name','url');
        // return $this->belongsTo(Category::class, 'category_id')->where('category.id', $id)->select('category_name');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    // public function category() {
	// 	return $this->hasOne('App\Category','id');
    // }

    // public function category_name($id) {
	// 	return $this->category()->where('id', $id)->first('category_name');
    // }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class)->where('status',1);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function brand() 
    {
        return $this->belongsTo(Brand::class);
    }

    public static function filters()
    {
        
        $productFilter['fabricArray'] = array('Cotton', 'Polyester', 'Whool');
        
        $productFilter['sleeveArray'] = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
        
        $productFilter['patternArray'] = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
           
        $productFilter['fitArray'] = array('Regular', 'Slim');
        
        $productFilter['occasionArray'] = array('Casual', 'Formal');
        return $productFilter;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public static function getDiscountPrice($product_id) 
    {
        $productDetail = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first()->toArray();
        $categoryDetail = Category::select('category_discount')->where('id',$productDetail['category_id'])->first()->toArray();
        
        // Now Either Product Discount exists in database or not if yes then 
        // at top priority Product Discount then Category Discount

        if($productDetail['product_discount'] > 0)
        {
            $discountPrice = $productDetail['product_price'] - (($productDetail['product_price'] * $productDetail['product_discount']) / 100 );
        }else if($categoryDetail['category_discount'] > 0){
            $discountPrice = $productDetail['product_price'] - (($productDetail['product_price'] * $categoryDetail['category_discount']) / 100);
        }else{
            $discountPrice = 0;
        }
        return $discountPrice;
    }

    // on selecting the Size like Small, Medium, Large price will be shown with or without discount
    // our prefer is discount than category vise discount 
    public static function getAttrDiscountPrice($product_id,$size)
    {
        $proAttrDetail = ProductAttribute::where(['product_id' => $product_id,'size'=>$size])->first()->toArray();
        $productDetail = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first()->toArray();
        $categoryDetail = Category::select('category_discount')->where(['id' => $productDetail['category_id']])->first()->toArray();

        if($productDetail['product_discount'] > 0)
        {
            $finalPrice = $proAttrDetail['price'] - (($proAttrDetail['price'] * $productDetail['product_discount']) / 100 );
            $discount = $proAttrDetail['price'] - $finalPrice;
        }
        else if($categoryDetail['category_discount'] > 0 ) {
            $finalPrice = $proAttrDetail['price'] - (($proAttrDetail['price'] * $categoryDetail['category_discount']) / 100);
            $discount = $proAttrDetail['price'] - $finalPrice;
        } else{
            $finalPrice = $proAttrDetail['price'];
            $discount = 0;
        }

        return array('product_price' => $proAttrDetail['price'], 'final_price' => $finalPrice, 'discount' => $discount);
    }
    
}
