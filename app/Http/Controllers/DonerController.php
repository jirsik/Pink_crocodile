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
    public function index(Request $request)
    {
        if ($order = $request->input('sort')) {
            switch ($order) {
                case 'contact':
                    $order = 'contact_name';
                    break;
                default:
                    $order = 'name';
            }
        } else {
            $order = 'name';
        }

        $doners = Doner::orderBy($order)->orderBy('name')->paginate(15);
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
            'link' => $request->input('link'),
            'about' => $request->input('about'),
            'contact_name' => $request->input('contact_name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email')
        ]);

        if($file = $request->file('doner_image')) {
            $file_name =  'pink_doner'.$doner->id . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $file->storeAs('doners', $file_name, 'uploads');

            $doner->doner_photo_path = 'uploads/doners/' . $file_name;
            //$file->getClientOriginalName(); 
            $doner->save(); 
        }

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
        $doner->link = $request->input('link');
        $doner->about = $request->input('about');
        $doner->contact_name = $request->input('contact_name');
        $doner->phone = $request->input('phone');
        $doner->email = $request->input('email');
        $doner->save();

        if($file = $request->file('doner_image')) {
            if ($doner->doner_photo_path) {
                if (file_exists(public_path($doner->doner_photo_path))) {
                    unlink(public_path($doner->doner_photo_path)); // delete old file
                }
            }
            $file_name =  'pink_doner'.$doner->id . '.' . pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $file->storeAs('doners', $file_name, 'uploads');

            $doner->doner_photo_path = 'uploads/doners/' . $file_name; //rewrite photo_path because of possible change of wxtention
            $doner->save(); 
        }
        
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
        $doner = Doner::with('items')->findOrFail($id);
        foreach ($doner->items as $item ) {
            $item->doner_id = null;
            $item->save();
        }
        
        $doner->delete();

        return redirect('/doner')->with('success', 'Doner deleted!');
    }
}
