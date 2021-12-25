<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subCategories()
    {
        return $this->hasMany(Category::class, 'parent_id','id')->where('status',1);
    }
}
