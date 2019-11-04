<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doner extends Model
{
    protected $table = 'doners';

    public $timestamps = false;
    
    public function item()
    {
        return $this->hasMany('App\Item');
    }

    protected $fillable = [
        'name', 'link', 'about', 'contact_name', 'phone', 'email', 'photo_path'
    ];
}
