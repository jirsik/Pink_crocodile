@extends('layouts/app')

<?php
if (isset($event)) {
    $name = $event->name;
    $location = $event->location;
    $starts_at = $event->starts_at;
    $ends_at = $event->ends_at;
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

//according to isset($event) show list or available items or assigned items

?>

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Event</div>
                <div class="card-body">
                    @can('admin')
                        <form method="POST" action={{$action}}>
                            @csrf
                            @if (isset($event))
                                <input name="_method" type="hidden" value="put">
                            @endif 

                            {{-- this input tells FinelRequest what data it shoud validate --}}
                            <input name="form" type="hidden" value="event"> 
{{-- 'name', 'location', 'starts_at', 'ends_at', 'coordinator', 'code' --}}
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

                            <div id="add-items" class="@if($assigned_items) d-none @endif">
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button id ="item-button" type="button" class="btn btn-secondary">
                                            Add Items
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div id="available-items" class="card d-none @if($assigned_items) d-block @endif mb-2">
                                    <div class="card-header">Available Items</div>        
                                    <div class="card-body">

                                            {{-- 'title', 'description', 'estimated_price', 'currency', 'doner_id', 'photo_path', --}}

                                        <table class="table">
                                            <thead>
                                              <tr>
                                                <th scope="col">Title</th>
                                                <th scope="col">Doner</th>
                                                <th scope="col">Picture</th>
                                                <th scope="col">Add</th>
                                              </tr>
                                            </thead>
                                            <tbody>

                                              
                                                @if (count($items)>0)
                                                    @foreach ($items as $item)
                                                        <tr>
                                                            <td>{{$item->title}}</td>
                                                            <td>{{$item->doner?$item->doner->name:'annonymus'}}</td>
                                                            <td>
                                                                <img src={{$item->photo_path}} alt="item" />
                                                            </td>
                                                            <td>
                                                                <input type="checkbox" name="vehicle1" value="true"> Add To Auction
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    
                                                @else
                                                    <tr>
                                                        <td colspan="4">There are no available items at the moment.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        {{ $items->links() }}
                                        <div class="form-group row">
                                            <div class="col-md-6 offset-md-4">
                                                <button id ="item-button-back" type="button" class="btn btn-light">
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
    {{-- <script> // should be elsewhere
        document.addEventListener('DOMContentLoaded', () => {
            let doner_button = document.querySelector('#doner-buton');
            let doner_button_back = document.querySelector('#doner-buton-back');
            let old_doner = document.querySelector('#old-doner');
            let new_doner = document.querySelector('#new-doner');
            let doner = document.querySelector('#doner_id'); //select element
            let doner_name = document.querySelector('#name'); //doner name element
            let doner_last_value = 'none';
            
            doner_button.onclick = function () {
                old_doner.classList.toggle('d-none');
                new_doner.classList.toggle('d-block');
                doner_last_value = doner.value;
                doner.value = 'new';
            };

            doner_button_back.onclick = function () {

                old_doner.classList.toggle('d-none');
                new_doner.classList.toggle('d-block');
                doner.value = doner_last_value;
                //doner_name.value = '';
            };
        });
    </script> --}}
@endsection