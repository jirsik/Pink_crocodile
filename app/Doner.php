<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doner extends Model
{
    protected $table = 'doners';

    public $timestamps = false;

    protected $hidden = [
        'email', 'phone'
    ];
    
    public function items()
    {
        return $this->hasMany('App\Item');
    }

    protected $fillable = [
        'name', 'link', 'about', 'contact_name', 'phone', 'email', 'doner_photo_path'
    ];
}
