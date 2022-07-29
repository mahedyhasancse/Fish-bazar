<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardPayment extends Model
{
   protected $fillable=[
       'name','amount','currency','order_id','card_no','expiry_month','expiry_year','cvv'
   ];
   public function order()
   {
       return $this->belongsTo(Order::class);
   }
}
