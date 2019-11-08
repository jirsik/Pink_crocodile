@extends('layouts/app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header">Doner</h4>
                <div class="card-body">
                    @can('admin')
                        <table class="table table-borderless">
                            <tbody>
                                    {{-- 'name', 'link', 'about', 'contact_name', 'phone', 'email', 'photo_path' --}}
                              <tr>
                                <th scope="row">Name:</th>
                                <td>{{$doner->name}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Link:</th>
                                <td>{{$doner->link}}</td>
                              </tr>
                              <tr>
                                <th scope="row">About:</th>
                                <td>{{$doner->about}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Contact Name:</th>
                                <td>{{$doner->contact_name}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Phone:</th>
                                <td>{{$doner->phone}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Email:</th>
                                <td>{{$doner->email}}</td>
                              </tr>
                              <tr>
                                <th scope="row">Photo:</th>
                                {{-- need to be changed --}}
                                <td>{{$doner->photo_path}}</td> 
                              </tr>
                            </tbody>
                          </table>
                        <a href="{{$back ?? action('DonerController@index')}}"><button type="button" class="btn btn-secondary">Go Back</button></a>

                        <div class="float-right">
                            <a href="{{action('DonerController@edit', $doner->id)}}"><button class="btn btn-primary">Edit</button></a>
                            <form action="{{action('DonerController@destroy', $doner->id)}}" method="POST" class="d-inline"> 
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delte</button>
                                @csrf     
                            </form> 
                        </div>
                    @else
                        <p>You are not authrized to see this content. Please contact admin.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection