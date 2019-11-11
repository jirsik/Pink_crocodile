<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionItem extends Model
{
    protected $table = 'auction_items';

    public $timestamps = false;

    public function event()
    {
        return $this->belongsTo('App\Event');
    }

    public function item()
    {
        return $this->morphOne('App\Item', 'itemable');
    }

    public function bids()
    {
        return $this->hasMany('App\Bid');
    }
}
