<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\Doner;
use App\AuctionItem;

class ItemController extends Controller
{
    public function landing()
    {
        $item = AuctionItem::with('item')->where('event_id', 1)->get();

        return $item;
    }
}
