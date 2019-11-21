<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FinalRequest;
use App\AuctionItem;
use App\Item;
use App\Doner;



class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auctionItem = AuctionItem::with('item', 'item.doner')->findOrFail($id);
        return view('auction.show', compact('auctionItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doners = Doner::orderBy('name')->get();
        $auctionItem = AuctionItem::with('item')->findOrFail($id);
        $item = $auctionItem->item; //form for auctionItem is extending form for items and that one is expecting items on its own!
        return view('auction.form', compact('auctionItem', 'doners', 'item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $auctionItem = AuctionItem::with('item')->findOrFail($id);
        $item = $auctionItem->item;
        if ($request->input('doner_id') !== 'none') {
            $doner_id = $request->input('doner_id');
        } else {
            $doner_id = null;
        }

        $auctionItem->minimum_price = $request->input('min_price');
        $auctionItem->starts_at = date("Y-m-d H:i:s", strtotime($request->input('starts_at')));
        $auctionItem->ends_at = date("Y-m-d H:i:s", strtotime($request->input('ends_at')));
        $auctionItem->save();

        $item->title = $request->input('title');
        $item->description = $request->input('description');
        $item->estimated_price = $request->input('estimated_price');
        $item->currency = $request->input('currency');
        $item->doner_id = $doner_id;
        $item->save();

        if($file = $request->file('item_image')) {
            if ($item->item_photo_path) {
                if (file_exists(public_path($item->item_photo_path))) {
                    unlink(public_path($item->item_photo_path)); // delete old file
                }
            }
            $file_name =  'pink_item'.$item->id . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $file->storeAs('items', $file_name, 'uploads');

            $item->item_photo_path = 'uploads/items/' . $file_name; //rewrite photo_path because of possible change of wxtention
            $item->save(); 
        }

        return redirect('/auction/item/'.$id)->with('success', 'Item for auction edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::with('itemable')->findOrFail($id);
        $auctionItem = $item->itemable;

        $auctionItem->delete();

        $item->itemable_id = null;
        $item->itemable_type = null;
        $item->save();


        return redirect('/item/'.$id)->with('success', 'Item Unassigned!');
    }


}
