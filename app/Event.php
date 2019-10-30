<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    public $timestamps = false;
    
    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    public function auction_items()
    {
        return $this->hasMany('App\Auction_item');
    }
}
