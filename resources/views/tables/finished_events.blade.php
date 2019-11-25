@extends('admin_layout')

@section('admin')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">Finished Events</h4>
                <div class="card-body">
                    @can('admin')
                    <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Event:</th>
                                    <th>Ended at:</th>
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
        </div>
    </div>
@endsection