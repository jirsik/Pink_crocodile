<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'items';

    public $timestamps = false;

    protected $fillable = [
        'title', 'description', 'estimated_price', 'currency', 'doner_id', 'item_photo_path',
    ];

    public function itemable()
    {
        return $this->morphTo();
    }

    public function doner()
    {
        return $this->belongsTo('App\Doner');
    }
}
