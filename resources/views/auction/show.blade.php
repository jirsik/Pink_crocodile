@extends('layouts/admin_layout')

@section('admin')

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
                                <h3>{{$auctionItem->item->title}}</h3>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Image:</th>
                            <td><img class="show_img" src="{{asset($auctionItem->item->item_photo_path ?? 'uploads/items/item.png')}}" alt="item">  </td>
                        </tr>
                        <tr>
                            <th scope="row">Estimated price:</th>
                            <td>{{$auctionItem->item->estimated_price? $auctionItem->item->estimated_price . " " . $auctionItem->item->currency : ''}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Minimum price:</th>
                            <td>{{$auctionItem->minimum_price?  $auctionItem->minimum_price . " " . $auctionItem->item->currency : ''}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Starts at:</th>
                            <td>{{$auctionItem->starts_at}}</td>
                        </tr>
                        <tr>
                            <th scope="row">End at:</th>
                            <td>{{$auctionItem->ends_at}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Doner:</th>
                            <td>{{$auctionItem->item->doner->name ?? ''}}</td>
                        </tr>
                        <tr>
                            <th scope="row">About Item:</th>
                            <td>{{$auctionItem->item->about}}</td>
                        </tr>
                        <tr>
                            <th>
                                <a href="{{$back ?? action('EventController@index')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                            </th>
                            <td>
                                <div class="float-right">
                                    @if (strtotime($auctionItem->event->ends_at) < time())   
                                        This auction is gone
                                    @else
                                        <a href="{{action('AuctionController@edit', $auctionItem->id)}}"><button class="btn btn-primary">Edit</button></a>
                                        <form action="{{action('AuctionController@destroy', $auctionItem->id)}}" method="POST" class="d-inline"> 
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
@endsection