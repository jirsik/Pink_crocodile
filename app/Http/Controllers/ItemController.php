<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doners = Doner::all();
        return view('items/form', compact('doners'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('doner') === 'none' && $request->input('name') !=='') {
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

        return redirect('/admin')->with('success', 'Item created!');
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
