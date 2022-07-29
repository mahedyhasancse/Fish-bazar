<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    protected $fillable = ['product_id', 'offerPrice','validTill'];
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
