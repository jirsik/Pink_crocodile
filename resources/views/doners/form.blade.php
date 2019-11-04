@extends('layouts/app')

<?php
if (isset($doner)) {
    $action = action('DonerController@update', $doner->id);
    $button_title = 'Edit Doner';
} else {
    $action = action('DonerController@store');
    $button_title = 'Register New Doner';
}
?>

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register doner</div>
                <div class="card-body">
                    @can('admin')
                        <form method="POST" action={{$action}}>
                            @if (isset($doner))
                                <input name="_method" type="hidden" value="put">
                            @endif 
                            @csrf
                            
                            @include('doners/inputs')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{$button_title}}
                                    </button>
                                    <a href="{{url()->previous()}}"><button type="button" class="btn btn-secondary">Go Back</button></a>
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