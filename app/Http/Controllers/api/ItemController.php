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

    public function submitBid(Request $request)
    {   
        $this->validate($request, [
            'auction_items_id' => 'required',
            'user_id' => 'required',
            'price' => 'required'
        ]);
        $bid = Bid::create([
            'auction_items_id' => $request->auction_items_id,
            'user_id' => $request->user_id,
            'price' => $request->price
        ]);
        
        return([
            'submit' => true
        ]);
    }
}
