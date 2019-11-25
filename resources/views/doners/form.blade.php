@extends('admin_layout')

<?php
if (isset($doner)) {
    $action = action('DonerController@update', $doner->id);
    $button_title = 'Edit Doner';
    $back_link = action('DonerController@show', $doner->id);
} else {
    $action = action('DonerController@store');
    $button_title = 'Register New Doner';
    $back_link = route('admin');
}

$any_error = (count($errors->all()) > 0 ) ? true : false;

?>

@section('admin')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Register donor</div>
                <div class="card-body">
                    @can('admin')
                        @if ($any_error)
                            <hr>
                            <p class="ml-2" style="color: green;">This form did not pass the validation. If you uploaded an image which you want to add, you have to upload the image again.</p>
                            <hr>
                        @endif
                        <form method="POST" action={{$action}} enctype="multipart/form-data">
                            @csrf

                            @if (isset($doner))
                                <input name="_method" type="hidden" value="put">
                            @endif 
                            <input name="form" type="hidden" value="doner">
                            
                            @include('doners/inputs')

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{$button_title}}
                                    </button>
                                    <a href={{$back_link}}><button type="button" class="btn btn-secondary">Go Back</button></a>
                                </div>
                            </div>
                        </form>
                    @else
                        <p>You are not authrized to register donor. Please contact admin.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection