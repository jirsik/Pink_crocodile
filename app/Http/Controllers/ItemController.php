<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;
use App\Item;
use App\Doner;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::orderBy('title')->get();
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
    public function store(ItemRequest $request)
    {
        if ($request->input('doner') === 'new' ) {
            $request->validate([
                'name' => 'required|string|max:35',
                'organisation' => 'nullable|string|max:35',
                'about' => 'nullable|string|max:500',
                'photo_path' => 'nullable|string|max:200',
            ]);
            $doner = Doner::create([
                'name' => $request->input('name'),
                'organisation' => $request->input('organisation'),
                'about' => $request->input('about'),
            ]);
            $doner_id = $doner->id;
        } else if ($request->input('doner') !== 'none') {
            $doner_id = $request->input('doner');
        } else {
            $doner_id = null;
        }

        $item = Item::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'estimated_price' => $request->input('estimated_price'),
            'currency' => $request->input('currency'),
            'doner_id' => $doner_id,
            //missing photo_path
        ]);

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
        $item = Item::findOrFail($id);
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
    public function update(ItemRequest $request, $id)
    {
        if ($request->input('doner') === 'new' ) {
            $request->validate([
                'name' => 'required|string|max:35',
                'organisation' => 'nullable|string|max:35',
                'about' => 'nullable|string|max:500',
                'photo_path' => 'nullable|string|max:200',
            ]);

            $doner = Doner::create([
                'name' => $request->input('name'),
                'organisation' => $request->input('organisation'),
                'about' => $request->input('about'),
            ]);
            $doner_id = $doner->id;
        } else if ($request->input('doner') !== 'none') {
            $doner_id = $request->input('doner');
        } else {
            $doner_id = null;
        }

        $item = Item::findOrFail($id);
        $item->title = $request->input('title');
        $item->description = $request->input('description');
        $item->estimated_price = $request->input('estimated_price');
        $item->currency = $request->input('currency');
        $item->doner_id = $doner_id;
        $item->save();

        return redirect('/item')->with('success', 'Item edited!');
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
