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

    public function auctionItems()
    {
        return $this->hasMany('App\AuctionItem');
    }

    // public function items()
    // {
    //     return $this->hasMany('App\Item')->using('App\AuctionItem');
    // }
}
