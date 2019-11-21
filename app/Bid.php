<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = 'bids';
    protected $fillable = ['auction_item_id', 'user_id', 'price'];

    public function auction_item()
    {
        return $this->belongsTo('App\Auction_item');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
