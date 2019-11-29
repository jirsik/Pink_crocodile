@extends('layouts/admin_layout')

@section('admin')
    @can('admin')
        
        <div class="card mb-2">
            <h4 class="card-header">Donors List</h4>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">
                                <a href="{{url('/doner?sort=name')}}">Name</a>
                            </th>
                            <th scope="col">
                                <a href="{{url('/doner?sort=contact')}}">Contact Name</a>
                            </th>
                            <th scope="col">
                                Image
                            </th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($doners) > 0)
                            @foreach ($doners as $doner)
                                <tr>
                                    <td>{{$doner->name}}</td>
                                    <td>{{$doner->contact_name}}</td>
                                    <td>
                                        <img class="index_img" src="{{asset($doner->doner_photo_path ?? 'uploads/doners/doner.png')}}" alt="donor">

                                    </td>
                                    <td>
                                        <div class="float-right">
                                            <a href="{{action('DonerController@show', $doner->id)}}"><button class="btn btn-primary">Details</button></a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">There are no donors at the moment</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ $doners->appends(Request::capture()->except('page'))->links() }} 

                <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                <a href="{{action('DonerController@create')}}"><button class="btn btn-primary">Register New Donor</button></a>
            </div>
        </div>

    @else
        <p>You are not authrized to see donors. Please contact admin.</p>
        <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
    @endcan
    
@endsection