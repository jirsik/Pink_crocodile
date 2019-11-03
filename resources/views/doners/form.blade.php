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
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">* Doner's name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="organisation" class="col-md-4 col-form-label text-md-right">Doner's organisation</label>

                                <div class="col-md-6">
                                    <input id="organisation" type="text" class="form-control @error('organisation') is-invalid @enderror" name="organisation" value="{{ old('organisation') }}" autocomplete="organisation" autofocus>

                                    @error('organisation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="about" class="col-md-4 col-form-label text-md-right">About:</label>

                                <div class="col-md-6">
                                    <input id="about" type="text" class="form-control @error('about') is-invalid @enderror" name="about" value="{{ old('about') }}" autocomplete="about" autofocus>

                                    @error('about')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

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