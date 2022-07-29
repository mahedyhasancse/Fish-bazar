<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'company_name','description', 'price', 'quantity', 'category_id','brand_id','admin_id',
    ];
    public function image()
    {
        return $this->hasMany('App\Image','product_id');
    }
    public function admin(){
        return $this->belongsTo('App\User','admin_id');
    }
    public function category(){
        return $this->belongsTo('App\ProductCategory','category_id');
    }
    public function productDetails(){
        return $this->hasOne('App\ProductDetails','product_id');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand', 'brand_id');
    }
    public function offer()
    {
        return $this->hasOne('App\ProductOffer');
    }

    public function orderDetails(){
        return $this->hasMany('App\OrderDetails','product_id');
    }
    public function wishlists()
    {
        return $this->hasMany('App\Wishlist');
    }

    public function rating()
    {
        return $this->hasManyThrough('App\Rating','App\OrderDetails');
    }

}
