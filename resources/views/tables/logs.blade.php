@extends('admin_layout')

@section('admin')
    @can('admin')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <h4 class="card-header">User's Logs</h4>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Last Login</th>
                                    <th scope="col">Event</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($logs) > 0)
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td>{{$log->user->first_name . " " . $log->user->last_name}}</td>
                                            <td>{{$log->created_at}}</td>
                                            <td>{{(($log->event_id !== null) ? $log->event->name : 'x')}}</td>
                                            <td>
                                                <div class="float-right">
                                                    <a href="{{action('AdminController@log_show', $log->id)}}"><button class="btn btn-primary">Details</button></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>There are no logs at the moment</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        {{ $logs->links() }}
                        <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>You are not authrized to see logs. Please contact admin.</p>
        <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
    @endcan
    
@endsection