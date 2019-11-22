@extends('admin_layout')

@section('admin')
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
                                <td>
                                    <img class="show_img" src="{{asset($item->item_photo_path ?? 'uploads/items/item.png')}}" alt="item">  
                                </td> 
                              </tr>
                              <tr>
                                <th scope="row">Assign To:</th>
                                {{-- need to be changed --}}
                                <td>
                                  @if ($item->itemable)
                                  <a href="{{action('EventController@show', $item->itemable->event->id)}}">
                                      {{$item->itemable->event->name}}
                                  </a>
                                  @endif
                                </td> 
                              </tr>
                            </tbody>
                          </table>
                        
                        <a href="{{$back ?? action('ItemController@index')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                        
                        <div class="float-right">
                            @if ($item->itemable && strtotime($item->itemable->event->ends_at) < time())   
                                This auction is gone
                            @else
                              <a href="{{action('ItemController@edit', $item->id)}}"><button class="btn btn-primary">Edit</button></a>
                              @if ($item->itemable)
                                <form action="{{action('AuctionController@destroy', $item->id)}}"
                                  method="POST" class="d-inline">
                                  <input name="_method" type="hidden" value="delete">
                                  <button type="submit" class="btn btn-danger">Unassign from auction</button>
                                  @csrf     
                                </form> 
                              @else
                                <form action="{{action('ItemController@destroy', $item->id)}}"
                                  method="POST" class="d-inline">
                                  <input name="_method" type="hidden" value="delete">
                                  <button type="submit" class="btn btn-danger">Delte</button>
                                  @csrf     
                                </form>
                              @endif
                            @endif
                        </div>
                    @else
                        <p>You are not authorized to see this content. Please contact admin.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection