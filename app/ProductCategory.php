<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable=[
        'name','slug','parent_id','image',
    ];
    public function parent(){
        return $this->belongsTo('App\ProductCategory','parent_id');
    }
    public function categoryBanner(){
        return $this->hasMany('App\CategoryBanner','category_id');
    }
    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    public function subcategories()
    {
        return $this->hasMany('App\ProductCategory', 'parent_id', 'id');
    }
    
}
