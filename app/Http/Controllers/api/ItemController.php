<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;
use App\Doner;
use App\AuctionItem;
use App\Bid;

class ItemController extends Controller
{
    public function landing()
    {
        $items = AuctionItem::with('item.doner')->where('event_id', 1)->get();

        return $items;
    }
}
