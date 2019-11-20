<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BidController extends Controller
{
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
    
    public function bid(Request $request)
    {
        $item_bids = Bid::where('auction_items_id', $response->auction_items_id)->get();

        return $item_bids;
    }
}
