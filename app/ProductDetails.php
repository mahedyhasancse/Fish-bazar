<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $fillable = [
        'color', 'size','model','product_id',
    ];
      public function product(){
        return $this->belongsTo('App\Product','product_id');

    }
}
