@extends('layouts/app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Welcome to Pink Crocodile</h1>
            <div class="card">
                <div class="card-header">Doner</div>

                <div class="card-body">
                    <a href="{{action('DonerController@create')}}"><button class="btn btn-primary">Register Doner</button></a>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Item</div>

                <div class="card-body">
                    <a href="{{action('ItemController@create')}}"><button class="btn btn-primary">Add New Item</button></a>
                </div>
            </div>
        </div>
    </div>
 
@endsection
