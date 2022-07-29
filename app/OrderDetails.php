<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $fillable = ['product_id','order_id','color','size','quantity','status','admin_id'];
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function rating()
    {
        return $this->hasMany(Rating::class,'order_details_id');
    }
    
}
