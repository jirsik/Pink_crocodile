<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Doner;
use App\Http\Requests\DonerRequest;

class DonerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doners = Doner::orderBy('name')->get();
        return view ('doners/index', compact('doners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doners/form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonerRequest $request)
    {     
        $doner = Doner::create([
            'name' => $request->input('name'),
            'organisation' => $request->input('organisation'),
            'about' => $request->input('about'),
        ]);

        return redirect('/doner')->with('success', 'Doner created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doner = Doner::findOrFail($id);
        return view('doners/show', compact('doner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doner = Doner::findOrFail($id);
        return view('doners/form', compact('doner'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DonerRequest $request, $id)
    {
        $doner = Doner::findOrFail($id); 
        $doner->name = $request->input('name');
        $doner->organisation = $request->input('organisation');
        $doner->about = $request->input('about');
        $doner->save();
        
        return redirect('/doner')->with('success', 'Doner updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doner = Doner::findOrFail($id);
        $doner->delete();

        return redirect('/doner')->with('success', 'Doner deleted!');
    }
}
