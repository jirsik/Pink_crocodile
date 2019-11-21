<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FinalRequest;
use App\Item;
use App\Doner;

class ItemController extends Controller 
{
    private function getDoner($request)
    {
        if ($request->input('doner_id') === 'new' ) {
            $doner = Doner::create([
                'name' => $request->input('name'),
                'link' => $request->input('link'),
                'about' => $request->input('about'),
                'contact_name' => $request->input('contact_name'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
            ]);

            if($file = $request->file('doner_image')) {
                $file_name =  'pink_doner'.$doner->id . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
                $file->storeAs('doners', $file_name, 'uploads');
    
                $doner->doner_photo_path = 'uploads/doners/' . $file_name;
                //$file->getClientOriginalName(); 
                $doner->save(); 
            }

            $doner_id = $doner->id;
        } else if ($request->input('doner_id') !== 'none') {
            $doner_id = $request->input('doner_id');
        } else {
            $doner_id = null;
        }
        return $doner_id;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $direction = 'ASC';
        $skip_null = '';

        if ($order = $request->input('sort')) {
            switch ($order) {
                case 'doner':
                    $order = 'name';
                    $skip_null = ' IS NULL';
                    break;
                case 'price':
                    $order = 'estimated_price';
                    $direction = 'DESC';
                    $skip_null = ' IS NULL';
                    break;
                case 'assigned':
                    $order = 'itemable_id';
                    break;
                default:
                    $order = 'title';
            }
        } else {
            $order = 'title';
        }

        $items = Item::with('doner', 'itemable', 'itemable.event')
            //joining doners to provide the possibility to sort records by doners name
            ->leftjoin('doners', 'doners.id', '=', 'items.doner_id')
            //joining auctionItems to check if the item was allready sold by auction
            ->leftJoin('auction_items', function($q) {
                $q->on('items.itemable_id', '=', 'auction_items.id');
                $q->where('items.itemable_type', '=', 'App\AuctionItem');
            })
            ->select('items.*')
            //checking if the auction is done, not to display those items
            ->where('ends_at', '>', date("Y-m-d H:i:s", time()) )
            ->orWhere('ends_at', null)
            //skipping items with no doner or assignment
            ->orderByRaw($order . $skip_null)
            ->orderBy($order, $direction)
            ->orderBy('title')
            ->paginate(10);
        return view ('items/index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doners = Doner::orderBy('name')->get();
        return view('items/form', compact('doners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FinalRequest $request)
    {
        // check if creating new doner or getting existing one
        $doner_id = $this->getDoner($request);

        $item = Item::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'estimated_price' => $request->input('estimated_price'),
            'currency' => $request->input('currency'),
            'doner_id' => $doner_id,
        ]);

        if($file = $request->file('item_image')) {
            $file_name =  'pink_item'.$item->id . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $file->storeAs('items', $file_name, 'uploads');

            $item->item_photo_path = 'uploads/items/' . $file_name;
            //$file->getClientOriginalName(); 
            $item->save(); 
        }

        return redirect('/item')->with('success', 'Item created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::with('itemable', 'itemable.event')->findOrFail($id);
        return view('items/show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::with('doner')->findOrFail($id);
        $doners = Doner::orderBy('name')->get();

        return view('items/form', compact('item', 'doners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FinalRequest $request, $id)
    {
        // check if creating new doner
        $doner_id = $this->getDoner($request);

        $item = Item::findOrFail($id);
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

            $item->item_photo_path = 'uploads/items/' . $file_name; //rewrite photo_path because of possible change of extention
            $item->save(); 
        }

        return redirect('/item/'.$id)->with('success', 'Item edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect('/item')->with('success', 'Item deleted!');
    }
}
