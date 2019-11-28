@extends('layouts/admin_layout')

@section('admin')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">{{$event->name}}</h4>
                <div class="card-body">
                    @can('admin')
                        <h6>Ended at: {{$event->ends_at}}</h6>
                        @if (count($event->auctionItems)>0)
                            @foreach ($event->auctionItems as $auctionItem)
                                <?php 
                                    $highestBid = null;
                                    if (count($auctionItem->bids) > 0) {
                                        foreach ($auctionItem->bids as $bid) {
                                            if ($highestBid == null || $highestBid->price < $bid->price) {
                                                $highestBid = $bid;
                                            }
                                        }
                                    }
                                ?>
                                <h6>Items:</h6>
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th>Title of Item:</th>
                                            <th>Winning bid:</th>
                                            <th>Winner:</th>
                                            <th>Winner's email:</th>
                                            <th>Winner notified:</th>
                                            <th>Paid:</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{$auctionItem->item->title}}</td>
                                            <td>{{$highestBid->price}}</td>
                                            <td>{{$auctionItem->user ? $auctionItem->user->first_name . ' ' . $auctionItem->user->last_name : ''}}</td>
                                            <td>{{$auctionItem->user ? $auctionItem->user->email : ''}}</td>
                                            <td>{{$auctionItem->winner_notified ? 'Yes' : 'Not yet'}}</td>
                                            <td>
                                                @if ($auctionItem->payed)
                                                    Paid
                                                @else
                                                    <form action="{{action('AdminController@confirm_payment', $auctionItem->id)}}"
                                                        method="POST" class="d-inline" onsubmit="return confirm('Do you really want to confirm the payment?');">
                                                        <button type="submit" class="btn btn-success">Confirm payment</button>
                                                        @csrf     
                                                    </form>
                                                @endif
                                            </td>
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