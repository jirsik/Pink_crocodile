<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Bid;
use App\AuctionItem;

class BidController extends Controller
{
    public function submitBid(Request $request)
    {   
        //CHECK FIELDS ARE CORRECT
        $this->validate($request, [
            'auction_item_id' => 'required',
            'user_id' => 'required',
            'price' => 'required'
            ]);

        //FIND HIGHEST BID
        $highest_bid = Bid::where('auction_item_id', $request->auction_item_id)->orderBy('price', 'desc')->first();
        
        //ENTER BID IF HIGHER THAN PREVIOUS BIDS
        if( !$highest_bid || $highest_bid->price < $request->price){
            $bid = Bid::create([
                'auction_item_id' => $request->auction_item_id,
                'user_id' => $request->user_id,
                'price' => $request->price
                ]);

            //ADD HIGHEST BIDDER TO AUCTION ITEMS TABLE
            $auction_item = AuctionItem::findOrFail($request->auction_item_id);
            $auction_item->user_id = $request->user_id;
            $auction_item->save();
            
            return([
                'submit' => true
            ]);
        }


        return([
            'submit' => false
        ]);
        
    }
    
    public function myBids($user_id)
    {
        $myBids = Bid::where('user_id', $user_id)->with('auctionItem.user')->with('auctionItem.item')->orderBy('created_at', 'desc')->get();
        if(count($myBids) > 0){
            return $myBids;
        }else{
            return [
                'message' => 'You haven\'t bid on any items yet'
            ];
        }
    }
}
