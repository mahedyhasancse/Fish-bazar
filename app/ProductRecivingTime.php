<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRecivingTime extends Model
{
    // order_id
    protected $fillable=[
      'time','date','order_id',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
}
