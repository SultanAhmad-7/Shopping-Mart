<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subCategories()
    {
        return $this->hasMany('App\Category', 'parent_id','id')->where('status',1);
    }

    public function sections() {
        return $this->belongsTo('App\Section', 'section_id')->select('id', 'name');
    }

    public function parentCategory()
    {
        return $this->belongsTo('App\Category', 'parent_id')->select('id', 'category_name');
    }

    /**
     * This categories() method with parameter $url
     * will fetch urls from category and sub-categories.
     */

    public static function categories($url)
    {
        $catDetails = Category::select('id','parent_id','category_name','url','description')->with(['subCategories' => function($query){
          $query->select('id','parent_id','category_name','url','description');  
        }])->where('url', $url)->first()->toArray();
        //dd($catDetails);

        // for breadCrumbs
        
        if($catDetails['parent_id'] == 0) 
        {
            $breadCrumb = "<a href='".url($catDetails['url'])."' >".$catDetails['category_name']."</a>";
        }else{
            $parentCategory = Category::select('category_name','url')->where('id',$catDetails['parent_id'])->first()->toArray();
            $breadCrumb = '<a href="'.$parentCategory['url'].'">'.$parentCategory['category_name'].'</a></a><span class="divider">/</span><a href="'.url($catDetails['url']).'">'.$catDetails['category_name'].'</a>';
            
            
            // "<a href='".$parentCategory['url']."'>"
            //                 .$parentCategory['category_name'].
            //               "</a><span class='divider'>/</span>
            //               <a href='".url($catDetails['url'])."' >".$catDetails['category_name']."</a>";
        }

        $catIds = array();
        $catIds[]  = $catDetails['id'];
        foreach ($catDetails['sub_categories'] as $key => $value) {
            $catIds[] = $value['id'];
        }
       // dd($catIds);
        return array('catIds'=>$catIds,'catDetails'=>$catDetails,'breadCrumb' => $breadCrumb);
    }

}
