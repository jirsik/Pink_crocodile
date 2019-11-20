@extends('layouts/app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">Auction - Item</h4>
                <div class="card-body">
                    @can('admin')
                        <table class="table table-borderless">
                    {{-- 'event_id', 'starts_at', 'ends_at', 'minimum_price', --}}
                    {{-- item:         'title', 'description', 'estimated_price', 'currency', 'doner_id', 'item_photo_path', --}}
                    {{-- item->doner:         'name', 'link', 'about', 'contact_name', 'phone', 'email', 'doner_photo_path' --}}
                            <tbody>
                                <tr>
                                    <th scope="row">Title:</th>
                                    <td>
                                        <h3>{{$auction_item->item->title}}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Image:</th>
                                    <td><img class="show_img" src="{{asset($auction_item->item->item_photo_path ?? 'uploads/items/item.png')}}" alt="item">  </td>
                                </tr>
                                <tr>
                                    <th scope="row">Estimated price:</th>
                                    <td>{{$auction_item->item->estimated_price? $auction_item->item->estimated_price . " " . $auction_item->item->currency : ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Minimum price:</th>
                                    <td>{{$auction_item->minimum_price?  $auction_item->minimum_price . " " . $auction_item->item->currency : ''}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Starts at:</th>
                                    <td>{{$auction_item->starts_at}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">End at:</th>
                                    <td>{{$auction_item->ends_at}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Doner:</th>
                                    <td>{{$auction_item->item->doner->name}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">About Item:</th>
                                    <td>{{$auction_item->item->about}}</td>
                                </tr>
                                <tr>
                                    <th>
                                        <a href="{{$back ?? action('EventController@index')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                                    </th>
                                    <td>
                                        <div class="float-right">
                                            @if (strtotime($auction_item->event->ends_at) < time())   
                                                This auction is gone
                                            @else
                                                <a href="{{action('AuctionController@edit', $auction_item->id)}}"><button class="btn btn-primary">Edit</button></a>
                                                <form action="{{action('AuctionController@destroy', $auction_item->id)}}" method="POST" class="d-inline"> 
                                                    <input name="_method" type="hidden" value="DELETE">
                                                    <button type="submit" class="btn btn-danger">Delte</button>
                                                    @csrf     
                                                </form> 
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <p>You are not authrized to see this content. Please contact admin.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection