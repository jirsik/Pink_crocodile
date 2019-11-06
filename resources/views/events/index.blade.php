@extends('layouts/app')

@section('content')
    @can('admin')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <h4 class="card-header">Events List</h4>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                        {{-- 'name', 'location', 'starts_at', 'ends_at', 'coordinator', 'code' --}}
                                    <th scope="col">Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Starts at</th>
                                    <th scope="col">Ends at</th>
                                    <th scope="col">Coordinator</th>
                                    <th scope="col">Code</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($events) > 0)
                                    @foreach ($events as $event)
                                        <tr>
                                            <td>{{$event->name}}</td>
                                            <td>{{$event->location}}</td>
                                            <td>{{$event->starts_at}}</td>
                                            <td>{{$event->ends_at}}</td>
                                            <td>{{$event->coordinator}}</td>
                                            <td>{{$event->code}}</td>
                                            <td>
                                                <div class="float-right">
                                                    <a href="{{action('EventController@show', $event->id)}}"><button class="btn btn-primary">Details</button></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7">There are no events at the moment</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $events->links() }}
                        <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                        <a href="{{action('EventController@create')}}"><button class="btn btn-primary">Add New Event</button></a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>You are not authrized to see doners. Please contact admin.</p>
        <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
    @endcan
    
@endsection