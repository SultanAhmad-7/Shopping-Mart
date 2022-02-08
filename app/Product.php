<?php

namespace App;

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
    
}
