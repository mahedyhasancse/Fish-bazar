<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable=[
        'name','image',
    ];
    public function product()
    {
        return $this->hasMany('App\Product', 'brand_id');
    }
    public function brandBanner(){
        return $this->hasMany('App\BrandBanner','brand_id');
    }
}
