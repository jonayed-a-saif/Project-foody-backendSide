<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeCategoryProduct extends Model
{	
	protected $with = ['product','home_category'];

    public function product(){

    	return $this->belongsTo(Product::class);
    }

    public function home_category(){

    	return $this->belongsTo(HomeCategory::class);
    }
}
