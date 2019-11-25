@extends('admin_layout')

@section('admin')
    @can('admin')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <h4 class="card-header">Items List</h4>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">
                                        Image
                                    </th>
                                    <th scope="col">
                                        <a href="{{url('/item?sort=title')}}">Title</a>
                                    </th>
                                    <th scope="col">
                                        <a href="{{url('/item?sort=doner')}}">Donor</a>
                                    </th>
                                    <th scope="col">
                                        <a href="{{url('/item?sort=price')}}">Estimated Price</a>
                                    </th>
                                    <th scope="col">
                                        <a href="{{url('/item?sort=assigned')}}">Assigned  / Available</a>
                                    </th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($items) > 0)
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>
                                                <img class="index_img" src="{{asset($item->item_photo_path ?? 'uploads/items/item.png')}}" alt="item">  
                                            </td>
                                            <td>{{$item->title}}</td>
                                            <td>{{ (($item->doner !== null) ? $item->doner->name : '') }}</td>
                                            <td>{{$item->estimated_price . " " . (($item->estimated_price !== null) ? $item->currency : '')}}</td>
                                            <td>
                                                @if ($item->itemable_id)
                                                    <a href="{{action('EventController@show', $item->itemable->event->id)}}">
                                                        {{$item->itemable->event->name}}
                                                    </a>
                                                    
                                                @endif
                                            </td>
                                            <td>
                                                <div class="float-right">
                                                    <a href="{{action('ItemController@show', $item->id)}}"><button class="btn btn-primary">Details</button></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">There are no donors at the moment</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $items->appends(Request::capture()->except('page'))->links() }} 

                        <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                        <a href="{{action('ItemController@create')}}"><button class="btn btn-primary">Add New Item</button></a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>You are not authrized to see donors. Please contact admin.</p>
        <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
    @endcan
    
@endsection