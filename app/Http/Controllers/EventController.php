<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Item;
use App\AuctionItem;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('name')->paginate(10);
        return view ('events/index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::where('itemable_id', null)->paginate(10);
        return view('events.form', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$item_ids = implode(",", $request->input('item'));
        $item_ids = $request->input('item');

        $event = Event::create([
            'name' =>  $request->input('name'),
            'location' =>  $request->input('location'),
            'starts_at' => date("Y-m-d H:i:s", strtotime($request->input('starts_at'))),
            'ends_at' => date("Y-m-d H:i:s", strtotime($request->input('ends_at'))),
            'coordinator' => $request->input('coordinator'),
            'code' =>  '..',
        ]);
        $event->code = 'event' . $event->id;
        $event->save();

        foreach ($item_ids as $item_id) {
            $auction_item = AuctionItem::create([
                'event_id' => $event->id,
                'starts_at' => $event->starts_at,
                'ends_at' => $event->ends_at,
                'minimum_price' => 123,
                // 'event_id', 'starts_at', 'ends_at', 'minimum_price',
            ]);

            $item = Item::FindOrFail($item_id);
            $auction_item->item()->save($item);
        }

        return redirect('/event')->with('success', 'Event created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
