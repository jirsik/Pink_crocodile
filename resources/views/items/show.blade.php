@extends('layouts/app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">Item</h4>
                <div class="card-body">
                    @can('admin')
                        <p>Title: {{$item->title}}</p>
                        <p>About: {{$item->about}}</p>
                        {{-- finish according to new structure of Doner --}}

                        <a href="{{action('ItemController@index')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>

                        <div class="float-right">
                            <a href="{{action('ItemController@edit', $item->id)}}"><button class="btn btn-primary">Edit</button></a>
                            <form action="{{action('ItemController@destroy', $item->id)}}" method="POST" class="d-inline"> 
                                <input name="_method" type="hidden" value="delete">
                                <button type="submit" class="btn btn-danger">Delte</button>
                                @csrf     
                            </form> 
                        </div>
                    @else
                        <p>You are not authrized to see this content. Please contact admin.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection