@extends('layouts/admin_layout')

@section('admin')
  
    <div class="card">
        <h4 class="card-header">Finished Events</h4>
        <div class="card-body">
            @can('admin')
            <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Event:</th>
                            <th>Ended at:</th>
                            <th>Items (sold / not sold):</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($events)>0)
                            @foreach ($events as $event)
                                <tr>
                                    <td>{{$event->name}}</td>
                                    <td>{{$event->ends_at}}</td>
                                    <td>
                                        <?php
                                            $sold = 0;
                                            if (count($event->auctionItems) > 0) {
                                                foreach ($event->auctionItems as $auctionItem) {
                                                    count($auctionItem->bids) > 0 && $sold++;
                                                }
                                            }
                                        ?>
                                        {{$sold . ' / ' . (count($event->auctionItems) - $sold)}}
                                    </td>
                                    <td>
                                        <div class="float-right">
                                            <a href="{{action('AdminController@finished_event_info', $event->id)}}"><button class="btn btn-primary">Details</button></a>
                                        </div>
                                    </td>
                                </tr> 
                            @endforeach
                        @endif
                    </tbody>
                    </table>
            @else
                <p>You are not authrized to see this content. Please contact admin.</p>
            @endcan
            <a href="{{action('HomeController@admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
        </div>
    </div>
  
@endsection