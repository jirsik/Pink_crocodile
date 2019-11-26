@extends('layouts/admin_layout')

<?php
if (isset($item)) {
    $title = $item->title;
    $description = $item->description;
    $estimated_price = $item->estimated_price;
    $currency = $item->currency;
    $doner_id = $item->doner_id;
    $item_photo_path = $item->item_photo_path;
    
    $action = action('ItemController@update', $item->id);
    $button_title = 'Edit Item';
    $back_link = action('ItemController@show', $item->id);
} else {
    $title = '';
    $description = '';
    $estimated_price = '';
    $currency = 'CZK';
    $doner_id = 'none';
    $item_photo_path = '';
    
    $action = action('ItemController@store');
    $button_title = 'Add New Item';
    $back_link = route('admin');
}

//for editing auction
if (isset($auctionItem)) {
    $action = action('AuctionController@update', $auctionItem->id);
    $button_title = 'Edit Item for auction';
    $back_link = action('AuctionController@show', $auctionItem->id);
}


$doner_id = old('doner_id', $doner_id);

$any_error = false;
$doner_error = false;

if (count($errors->all()) > 0 ) {
    $any_error = true;
    if ($doner_id == 'new') {
        $doner_error = true;
    }
}
?>

@section('admin')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$button_title}}</div>
                <div class="card-body">
                    @can('admin')
                        @if ($any_error)
                            <hr>
                            <p class="ml-2" style="color: green;">This form did not pass the validation. If you uploaded an image which you want to add, you have to upload the image again.</p>
                            <hr>
                        @endif
                        <form method="POST" action={{$action}} enctype="multipart/form-data">
                            @csrf
                            @if (isset($item))
                                <input name="_method" type="hidden" value="put">
                            @endif 
                            <input name="form" type="hidden" value="item">
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">* Title:</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $item->title ?? '') }}">

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description:</label>

                                <div class="col-md-6">
                                    <textarea name="description" id="description" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description', $description) }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="currency" class="col-md-4 col-form-label text-md-right">Currency:</label>
                                <div class="col-md-6">
                                    <select id="currency" class="form-control @error('currency') is-invalid @enderror" name="currency">
                                        <option value="CZK" {{($currency === 'CZK') ? 'Selected' : ''}}>CZK</option>
                                        <option value="EUR" {{($currency === 'EUR') ? 'Selected' : ''}}>EUR</option>
                                        <option value="USD" {{($currency === 'USD') ? 'Selected' : ''}}>USD</option>
                                    @error('currency')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="estimated_price" class="col-md-4 col-form-label text-md-right">Estimated Price:</label>

                                <div class="col-md-6">
                                    <input id="estimated_price" type="text" class="form-control @error('estimated_price') is-invalid @enderror" name="estimated_price" value="{{ old('estimated_price', $estimated_price) }}">

                                    @error('estimated_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            {{-- using this form even for updating auctionItem --}}
                            @yield('auction')

                            @if ($item_photo_path !== '' && $item_photo_path !== null)
                                <hr>
                                <p class="ml-2" style="color: green;">Uploading new image will delete actual image!</p>
                            @endif

                            <div class="form-group row"> 
                                <label for="item_image" class="col-md-4 col-form-label text-md-right">Upload Image:</label>
                                <div class="col-md-6">
                                    <input type="file" id="item_image" name="item_image" class="form-control @error('item_image') is-invalid @enderror">

                                    @error('item_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="old-doner" class="@if($doner_error) d-none @endif">
                                @if (!isset($item))
                                    <hr>
                                @endif
                                <div class="form-group row">
                                    <label for="doner_id" class="col-md-4 col-form-label text-md-right">Donor:</label>
                                    <div class="col-md-6">
                                        <select id="doner_id" class="form-control @error('doner_id') is-invalid @enderror" name="doner_id">
                                            <option value="none" {{($doner_id === 'none') ? 'Selected' : ''}}>not defined</option>
                                            <option hidden value="new" {{($doner_id === 'new') ? 'Selected' : ''}}>new</option>
                                            @foreach ($doners as $doner_info) :
                                                <option value="{{$doner_info->id}}"  {{($doner_id == $doner_info->id) ? 'Selected' : ''}}>{{$doner_info->name}}</option>
                                            @endforeach
                                            
                                        @error('doner_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </select>
                                    </div>
                                </div>
                                
                                @if (!isset($item))
                                    <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <button id ="doner-button" type="button" class="btn btn-secondary">
                                                New Donor
                                            </button>
                                        </div>
                                    </div>
                                    <hr>
                                @endif
                            </div>

                            <div id="new-doner" class="card d-none @if($doner_error) d-block @endif mb-2">
                                    <div class="card-header">New Donor</div>        
                                    <div class="card-body">
                                        @include('doners/inputs')
                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-4">
                                                <button id ="doner-button-back" type="button" class="btn btn-light">
                                                    Do not add new donor
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                            {{-- photo still missing --}}

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