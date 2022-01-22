<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

        public static function sections() 
        {
                $sections = Section::with('categories')->where('status',1)->get();
                return $sections;
        }

        public  function categories()
        {
            return  $this->hasMany(Category::class,'section_id')
                                ->where(['parent_id' => 'Root', 'status' => 1])
                                                                        ->with('subCategories');
        }

}
