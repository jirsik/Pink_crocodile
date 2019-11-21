<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bids';
    protected $fillable = ['auction_item_id', 'user_id', 'price'];

    public function auctionItem()
    {
        return $this->belongsTo('App\AuctionItem');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
