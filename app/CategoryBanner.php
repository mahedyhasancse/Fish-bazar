<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryBanner extends Model
{
    protected $fillable=[
      'image','category_id'
    ];
    public function category(){
        return $this->belongsTo('App\ProductCategory','category_id');

    }
}
