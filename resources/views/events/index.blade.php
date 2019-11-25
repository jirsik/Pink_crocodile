@extends('admin_layout')

@section('admin')
    @can('admin')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <h4 class="card-header">Events List</h4>
                    <div class="card-body">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                                aria-selected="true">Upcomming</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                                aria-selected="false">Ongoing</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                                aria-selected="false">Passed</a>
                            </li>
                        </ul>
                        @if (count($events) > 0)

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
                                           
                                                @foreach ($events as $event)
                                                    @if (strtotime($event->starts_at) > time())
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
                                                    @endif
                                                @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
                                            
                                                @foreach ($events as $event)
                                                    @if (strtotime($event->starts_at) < time() && strtotime($event->ends_at) > time())
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
                                                    @endif
                                                @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
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
                                            
                                                @foreach ($events as $event)
                                                    @if (strtotime($event->ends_at) < time())
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
                                                    @endif
                                                @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @else
                            <p>
                                There are no events at the moment
                            </p>
                        @endif

                        <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                        <a href="{{action('EventController@create')}}"><button class="btn btn-primary">Add New Event</button></a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>You are not authrized to see events. Please contact admin.</p>
        <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
    @endcan
    
@endsection