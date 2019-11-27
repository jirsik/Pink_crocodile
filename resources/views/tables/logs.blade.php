@extends('layouts/admin_layout')

@section('admin')
    @can('admin')
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-2">
                    <h4 class="card-header">Users</h4>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Full Name</th>
                                    <th scope="col">Last Login</th>
                                    <th scope="col">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($users) > 0)
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{$user->first_name}}</td>
                                            <td>{{$user->last_name}}</td>
                                            <td>
                                                @if ($user->role->pluck('role')->contains('admin'))
                                                    Admin
                                                @else
                                                <form action="{{action('AdminController@make_admin', $user->id)}}"
                                                    method="POST" class="d-inline" onsubmit="return confirm('Do you really want to make this user admin?');">
                                                    <button type="submit" class="btn btn-success">Make admin</button>
                                                    @csrf     
                                                </form>
                                                @endif
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
                        {{ $users->links() }}
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