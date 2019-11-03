@extends('layouts/app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register doner</div>
                <div class="card-body">
                    @can('admin')
                        <form method="POST" action="{{ action('DonerController@store') }}">
                            @csrf
                            
                            @include('doners/inputs')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register doner
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <p>You are not authrized to register doner. Please contact admin.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection