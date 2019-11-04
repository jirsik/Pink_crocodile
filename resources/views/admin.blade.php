@extends('layouts/app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-2">
                <h4 class="card-header">Doners</h4>

                <div class="card-body">
                    <a href="{{action('DonerController@index')}}"><button class="btn btn-primary">Show Doners</button></a>
                    <a href="{{action('DonerController@create')}}"><button class="btn btn-primary">Register Doner</button></a>
                </div>
            </div>

            <div class="card mb-2">
                <h4 class="card-header">Items</h4>

                <div class="card-body">
                    <a href="{{action('ItemController@index')}}"><button class="btn btn-primary">Show Items</button></a>
                    <a href="{{action('ItemController@create')}}"><button class="btn btn-primary">Add New Item</button></a>
                </div>
            </div>
        </div>
    </div>
 
@endsection
