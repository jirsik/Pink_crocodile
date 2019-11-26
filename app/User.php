<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'alias', 'email', 'password', 'phone', 'address_street_and_num', 'address_city', 'address_post_code', 'address_country',
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'address_city', 'address_country', 'address_post_code', 'address_street_and_num', 'email', 'email_verified_at', 'phone'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    public function role()
    {
        return $this->hasOne('App\Role', 'user_id', 'id');
    }

    public function bids()
    {
        return $this->hasMany('App\Bid');
    }
}
