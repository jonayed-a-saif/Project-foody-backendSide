<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeCategory extends Model
{
    protected $guarded = [];

    public function products(){
    	return $this->hasMany(HomeCategoryProduct::class,'home_category_id','id');
    }

    public function limit_products() {
        return $this->products()->take(8);
    }
}
