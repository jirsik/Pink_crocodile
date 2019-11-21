<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuctionItem extends Model
{
    protected $table = 'auction_items';
    
    protected $fillable = [
        'event_id', 'starts_at', 'ends_at', 'minimum_price',
    ];
        
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
