@extends('admin_layout')

@section('admin')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">Event</h4>
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
                                        <tr>
                                            <td>{{$event->name}}</td>
                                            <td>{{$event->ends_at}}</td>
                                            <td>
                                               whatever
                                            </td>
                                        </tr> 
                                 
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