<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandBanner extends Model
{
    protected $fillable=[
        'image','brand_id'
    ];
    public function brand(){
        return $this->belongsTo('App\Brand','brand_id');

    }
}
