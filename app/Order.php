<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','total','discount','trx_id','order_no','paid','due','status','note','currency'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderDetails(){
        return $this->hasMany(OrderDetails::class,'order_id');
    }
    public function shipped(){
        return  $this->hasOne(Shipping::class);
    }
    public function time(){
        return $this->hasMany('App\ProductRecivingTime','order_id');
    }
    public function card(){
        return $this->hasMany('App\CardPayment','order_id');
    }

}
