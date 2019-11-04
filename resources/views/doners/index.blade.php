@extends('layouts/app')

@section('content')
    @can('admin')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <h4 class="card-header">Doners List</h4>
                    <div class="card-body">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Contact Name</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($doners))
                                    @foreach ($doners as $doner)
                                        <tr>
                                            <td>{{$doner->name}}</td>
                                            <td>{{$doner->contact_name}}</td>
                                            <td>
                                                <div class="float-right">
                                                    <a href="{{action('DonerController@show', $doner->id)}}"><button class="btn btn-primary">Details</button></a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>There are no doners at the moment</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p>You are not authrized to see doners. Please contact admin.</p>
        <a href="{{route('admin')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
    @endcan
    
@endsection