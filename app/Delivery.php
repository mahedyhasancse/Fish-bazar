<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $fillable = [
        'time', 'date', 'user_id','status',
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
