<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable=[
                'title','image','content','parent_id','link'
    ];
    public function items(){
        return $this->hasMany('App\Recipe','parent_id');
    }
    public function parent(){
        return $this->belongsTo('App\Recipe','id');
    }
}
