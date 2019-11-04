@extends('layouts/app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">Doner</h4>
                <div class="card-body">
                    @can('admin')
                        <p>Name: {{$doner->name}}</p>
                        <p>Organisation: {{$doner->organisation}}</p>
                        <p>About: {{$doner->about}}</p>
                        <a href="{{action('DonerController@index')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>

                        <div class="float-right">
                            <a href="{{action('DonerController@edit', $doner->id)}}"><button class="btn btn-primary">Edit</button></a>
                            <form action="{{action('DonerController@destroy', $doner->id)}}" method="POST" class="d-inline"> 
                                <input name="_method" type="hidden" value="DELETE">
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