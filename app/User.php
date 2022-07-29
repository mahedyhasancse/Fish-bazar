<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username','phone','is_admin', 'email', 'password','first_name','last_name','address','street','post_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function product(){
        return $this->hasMany('App\Product','admin_id');
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class,'admin_id');
    }

    public function profile()
    {
        return $this->hasOne('App\UserProfile');
    }
    public function time()
    {
        return $this->hasMany('App\ProductRecivingTime','user_id');
    }
    public function wishlist()
    {
        return $this->hasOne('App\Wishlist');
    }
    public function delivery(){
        return $this->hasMany('App\Delivery','user_id');
    }
    public function payment(){
        return $this->hasMany(Payment::class,'user_id');
    }
}
