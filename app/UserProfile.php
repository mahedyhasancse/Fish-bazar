<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = ['user_id', 'firstName', 'lastName', 'birthday', 'address'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
