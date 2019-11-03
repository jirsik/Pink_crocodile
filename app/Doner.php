<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doner extends Model
{
    protected $table = 'doners';

    public function item()
    {
        return $this->hasMany('App\Item');
    }
}
