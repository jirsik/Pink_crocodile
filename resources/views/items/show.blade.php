@extends('layouts/app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">Item</h4>
                <div class="card-body">
                    @can('admin')
                    <table class="table table-borderless">
                            <tbody>
                              <tr>
                                <th scope="row">Title:</th>
                                <td>{{$item->title}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Description:</th>
                                <td>{{$item->description}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Estimated Price:</th>
                                <td>{{$item->estimated_price . " " . (($item->estimated_price !== null) ? $item->currency : '')}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Doner's Name:</th>
                                <td>{{ (($item->doner !== null) ? $item->doner->name : '') }}</td>
                              </tr>
                              <tr>
                                <th scope="row">Photo:</th>
                                {{-- need to be changed --}}
                                <td>{{$item->item_photo_path}}</td> 
                              </tr>
                            </tbody>
                          </table>
                        
                        <a href="{{$back ?? action('ItemController@index')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>

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