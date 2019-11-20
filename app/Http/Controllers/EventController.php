<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FinalRequest;

use App\Event;
use App\Item;
use App\Auction_item;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('name')->get();
        return view ('events/index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $available_items = Item::where('itemable_id', null)->get();
        return view('events.form', compact('available_items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = $request->input('item');

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
        
        if ($items) {
            foreach ($items as $item_info) {
                if ($item_info['id'] != 0) {
                    $auction_item = Auction_item::create([
                        'event_id' => $event->id,
                        'starts_at' => $item_info['starts_at'] ?? $event->starts_at,
                        'ends_at' => $item_info['ends_at'] ?? $event->ends_at,
                        'minimum_price' => $item_info['min_price'] ?? 1,
                    ]);
        
                    $item = Item::FindOrFail($item_info['id']);
                    $auction_item->item()->save($item);       
                }
            }
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
        $event = Event::with('auction_items', 'auction_items.item')->findOrFail($id);
        
        return view('events/show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::with('auction_items', 'auction_items.item')->findOrFail($id);
        $available_items = Item::where('itemable_id', null)->get();
        return view('events.form', compact('event', 'available_items'));
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
        $event = Event::findOrFail($id);
        $event->name = $request->input('name');
        $event->location = $request->input('location');
        $event->starts_at = date("Y-m-d H:i:s", strtotime($request->input('starts_at')));
        $event->ends_at = date("Y-m-d H:i:s", strtotime($request->input('ends_at')));
        $event->coordinator = $request->input('coordinator');
        $event->save();
        
        //adding new items
        $items = $request->input('item');
        if ($items) {
            foreach ($items as $item_info) {
                if ($item_info['id'] != 0) {
                    $auction_item = Auction_item::create([
                        'event_id' => $event->id,
                        'starts_at' => $item_info['starts_at'] ?? $event->starts_at,
                        'ends_at' => $item_info['ends_at'] ?? $event->ends_at,
                        'minimum_price' => $item_info['min_price'] ?? 1,
                    ]);
        
                    $item = Item::FindOrFail($item_info['id']);
                    $auction_item->item()->save($item);       
                }
            }
        }

        //removing items
        $items_to_unconnect = $request->input('item_to_unconnect');
        if ($items_to_unconnect) {
            foreach ($items_to_unconnect as $auction_item_id) {
                if ($auction_item_id != 0) {


                    $auction_item_to_unconnect = Auction_item::with('item')->findOrFail($auction_item_id);
                    $auction_item_to_unconnect->item->itemable_id = null;
                    $auction_item_to_unconnect->item->itemable_type = null;
                    $auction_item_to_unconnect->item->save();

                    $auction_item_to_unconnect->delete();

                }
            }
        }

        return redirect('/event')->with('success', 'Event updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::with('auction_items', 'auction_items.item')->findOrFail($id);

        if (count($event->auction_items) > 0) {
            foreach ($event->auction_items as $auction_item) {
                $auction_item->item->itemable_id = null;
                $auction_item->item->itemable_type = null;
                $auction_item->item->save();
            }
        }

        $event->auction_items->each->delete();
        $event->delete();

        return redirect('/event')->with('success', 'Event deleted!');
    }
}
