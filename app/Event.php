<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    public $timestamps = false;

    protected $fillable = [
        'name', 'location', 'starts_at', 'ends_at', 'coordinator', 'code'
    ];
    
    
    public function logs()
    {
        return $this->hasMany('App\Log');
    }

    public function auction_items()
    {
        return $this->hasMany('App\Auction_item');
    }

    // public function items()
    // {
    //     return $this->hasMany('App\Item')->using('App\Auction_item');
    // }
}
