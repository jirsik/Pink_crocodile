@extends('admin_layout')

@section('admin')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">Event</h4>
                <div class="card-body">
                    @can('admin')
                        <h1>{{$event->name}}</h1>
                        <h5>Ended at: {{$event->ends_at}}</h5>
                        @if (count($event->auctionItems)>0)
                            @foreach ($event->auctionItems as $auctionItem)
                                <h5>Items:</h5>
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Item:</th>
                                            <th>Sold:</th>
                                            <th>Winner:</th>
                                            <th>Winner notified:</th>
                                            <th>Payed:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$auctionItem->item->title}}</td>
                                            <td>{{count($auctionItem->bids)>0 ? 'Yes' : 'No'}}</td>
                                            <td>{{$auctionItem->user->first_name . ' ' . $auctionItem->user->last_name}}</td>
                                            <td>{{$auctionItem->winner_notified ? 'Yes' : 'Not yet'}}</td>
                                            <td>{{$auctionItem->payed? 'Payed' : 'Not yet'}}</td>
                                        </tr> 
                                    </tbody>
                                </table> 
                            @endforeach  
                        @endif
                    @else
                        <p>You are not authrized to see this content. Please contact admin.</p>
                    @endcan
                    <a href="{{action('AdminController@finished_events')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                </div>
            </div>
        </div>
    </div>
@endsection