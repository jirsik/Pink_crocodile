@extends('layouts/app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">Event</h4>
                <div class="card-body">
                    @can('admin')
                    <table class="table table-borderless">
                            <tbody>
                                    {{-- 'name', 'location', 'starts_at', 'ends_at', 'coordinator', 'code' --}}

                                <tr>
                                    <th scope="row">Event:</th>
                                    <td colspan="2">{{$event->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Location:</th>
                                    <td colspan="2">{{$event->location}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Starts at:</th>
                                    <td colspan="2">{{$event->starts_at}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Ends at:</th>
                                    <td colspan="2">{{$event->ends_at}}</td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="3">Items: <hr></th>
                                </tr>
                                @if (count($event->auction_items) > 0)
                                    @foreach ($event->auction_items as $auction_item)
                                        <tr>
                                            <th>{{$auction_item->item->title}}</th>
                                            <td>
                                                <img class="index_img" src="{{asset($item->item_photo_path ?? 'uploads/items/item.png')}}" alt="item">  
                                            </td> 
                                            <td>
                                                {{-- buttons --}}
                                                <div class="float-right">
                                                    <a href="{{action('AuctionController@show', $auction_item->id)}}"><button class="btn btn-primary">Details of item</button></a>
                                                </div>
                                            </td> 
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="2">
                                            <p>No Item assigned yet</p>
                                        </td>
                                    </tr>
                                @endif
                               
                            </tbody>
                          </table>
                        
                        <a href="{{$back ?? action('EventController@index')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                        
                        @if (strtotime($event->ends_at) > time())
                            <div class="float-right">
                                <a href="{{action('EventController@edit', $event->id)}}"><button class="btn btn-primary">Edit event</button></a>
                                <form action="{{action('EventController@destroy', $event->id)}}" method="POST" class="d-inline"> 
                                    <input name="_method" type="hidden" value="delete">
                                    <button type="submit" class="btn btn-danger">Delte</button>
                                    @csrf     
                                </form> 
                            </div>
                        @endif
                    @else
                        <p>You are not authrized to see this content. Please contact admin.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection