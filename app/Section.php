<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{

        public static function sections() 
        {
                return Section::with('categories')->where('status',1)->get();
        }

        public function categories()
        {
            return  $this->hasMany(Category::class,'section_id')
                                ->where(['parent_id' => 'Root', 'status' => 1])
                                                                        ->with('subCategories');
        }

}
