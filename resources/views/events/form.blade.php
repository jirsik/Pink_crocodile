@extends('layouts/admin_layout')

<?php
if (isset($event)) {
    $name = $event->name;
    $location = $event->location; //2009-11-13T20:00
    $starts_at = date("Y-m-d\TH:i", strtotime($event->starts_at)); //date("Y-m-d H:i", strtotime($event->starts_at));
    $ends_at = date("Y-m-d\TH:i", strtotime($event->ends_at));
    $coordinator = $event->coordinator;
    $code = $event->code;
    
    $action = action('EventController@update', $event->id);
    $button_title = 'Edit Event';
    $back_link = action('EventController@show', $event->id);
    
    $assigned_items = true;
    
} else {
    $name = '';
    $location = '';
    $starts_at = '';
    $ends_at = '';
    $coordinator = '';
    $code = '';
    
    $action = action('EventController@store');
    $button_title = 'Add New Event';
    $back_link = route('admin');
    
    $assigned_items = false;
}

//check if add item window was open and open it or close it
$auction_form = old('form', 'event');
$auction_error = false;

if (count($errors->all()) > 0 && $auction_form == 'auction') {
    $auction_error = true;
}

?>

@section('admin')
    <input name="form" type="hidden" value="event"> {{-- tels to FinalRequest.php how to valitade data --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$button_title}}</div>
                <div class="card-body">
                    @can('admin')
                        <form method="POST" action={{$action}}>
                            @csrf
                            @if (isset($event))
                                <input name="_method" type="hidden" value="put">
                            @endif 

                            <input name="form" id="form" type="hidden" value={{$auction_form}}> 

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">* Name:</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $name) }}">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="location" class="col-md-4 col-form-label text-md-right">Location:</label>

                                <div class="col-md-6">
                                    <input id="location" type="text" class="form-control @error('location') is-invalid @enderror" name="location" value="{{ old('location', $location) }}">

                                    @error('location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="starts_at" class="col-md-4 col-form-label text-md-right">* Starts at:</label>

                                <div class="col-md-6">
                                    <input id="starts_at" type="datetime-local" class="form-control @error('starts_at') is-invalid @enderror" name="starts_at" value="{{ old('starts_at', $starts_at) }}">

                                    @error('starts_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="ends_at" class="col-md-4 col-form-label text-md-right">* Ends at:</label>

                                <div class="col-md-6">
                                    <input id="ends_at" type="datetime-local" class="form-control @error('ends_at') is-invalid @enderror" name="ends_at" value="{{ old('ends_at', $ends_at) }}">

                                    @error('ends_at')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="coordinator" class="col-md-4 col-form-label text-md-right">Coordinator:</label>

                                <div class="col-md-6">
                                    <input id="coordinator" type="text" class="form-control @error('coordinator') is-invalid @enderror" name="coordinator" value="{{ old('coordinator', $coordinator) }}">

                                    @error('coordinator')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            @if (isset($event) && count($event->auctionItems)>0)
                                
                                <div id="assigned-items" class="card d-block mb-2">
                                    <div class="card-header">Assigned Items</div>        
                                    <div class="card-body">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Est. Price</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Remove</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($event->auctionItems as $i => $auctionItem)
                                                    <tr>
                                                        <td>{{$auctionItem->item->title}}</td>
                                                        <td>{{$auctionItem->item->estimated_price ? $auctionItem->item->estimated_price . ' ' . $auctionItem->item->currency : '??'}}</td>
                                                        <td>
                                                            <img class="index_img" src="{{asset($auctionItem->item->item_photo_path ?? 'uploads/items/item.png')}}" alt="item">  
                                                        </td>
                                                        <td>
                                                            <input type="hidden" name="item_to_unconnect[{{$i}}]" value="{{$auctionItem->id}}">
                                                            <input type="checkbox" name="item_to_unconnect[{{$i}}]" checked value="0"> uncheck to unconnect
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                                    
                            <div id="add-items" class="@if($auction_error) d-none @endif">
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button id ="item-button" type="button" class="btn btn-secondary">
                                            Add Items
                                        </button>
                                    </div>
                                </div>
                            </div>
    
                            <div id="available-items" class="card d-none @if($auction_error) d-block @endif mb-2">
                                    <div class="card-header">Available Items</div>        
                                    <div class="card-body">

                                        <table class="table">
                                            <thead>
                                              <tr>
                                                <th scope="col">Title</th>
                                                <th scope="col">Est. Price</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Add</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              
                                                @if (count($available_items)>0)
                                                    @foreach ($available_items as $i=>$item)
                                                        <tr>
                                                            <td>{{$item->title}}</td>
                                                            <td>{{$item->estimated_price ? $item->estimated_price . ' ' . $item->currency : '??'}}</td>
                                                            <td>
                                                                <img class="index_img" src="{{asset($item->item_photo_path ?? 'uploads/items/item.png')}}" alt="item">  
                                                            </td>
                                                            <td>
                                                                <div>
                                                                    <input type="hidden" name="item[{{$i}}][id]" value="0">
                                                                	<input type="checkbox" name="item[{{$i}}][id]" value="{{$item->id}}" class="text-md-left" {{old('item.'. $i .'.id') ? 'checked' : '' }}> Add To Auction
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="item[{{$i}}][min_price]" class="col-md-4 col-form-label text-md-right">Min. Price ({{$item->currency}}):</label>
                                    
                                                                    <div class="col-md-8">
                                                                        <input id="item[{{$i}}][min_price]" type="number" class="form-control @error('item.'. $i .'.min_price') is-invalid @enderror" name="item[{{$i}}][min_price]" value="{{ old('item.'. $i .'.min_price') }}">
                                    
                                                                        @error('item.'. $i .'.min_price')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="item[{{$i}}][starts_at]" class="col-md-4 col-form-label text-md-right">Starts:</label>
                                    
                                                                    <div class="col-md-8">
                                                                        <input id="item[{{$i}}][starts_at]" type="datetime-local" class="form-control @error('item.'. $i .'.starts_at') is-invalid @enderror" name="item[{{$i}}][starts_at]" value="{{ old('item.'. $i .'.starts_at') }}">
                                    
                                                                        @error('item.'. $i .'.starts_at')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="item[{{$i}}][ends_at]" class="col-md-4 col-form-label text-md-right">Ends:</label>
                                                                    <div class="col-md-8">
                                                                        <input id="item[{{$i}}][ends_at]" type="datetime-local" class="form-control @error('item.'. $i .'.ends_at') is-invalid @enderror" name="item[{{$i}}][ends_at]" value="{{ old('item.'. $i .'.ends_at') }}">
                                        
                                                                        @error('item.'. $i .'.ends_at')
                                                                            <span class="invalid-feedback" role="alert">
                                                                                <strong>{{ $message }}</strong>
                                                                            </span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    
                                                @else
                                                    <tr>
                                                        <td colspan="4">There are no available items at the moment, but you can add the items later.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <button id ="item-button-back" type="button" class="btn btn-secondary">
                                                    Do not add items
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            {{-- photo still missing --}}
                            <hr>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{$button_title}}
                                    </button>
                                    <a href={{$back_link}}><button type="button" class="btn btn-secondary">Go Back</button></a>
                                </div>
                            </div>
                        </form>
                    @else
                        <p>You are not authrized to add an item. Please contact admin.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection