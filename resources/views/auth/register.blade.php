@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('* First Name:') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('* Last Name:') }}</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alias" class="col-md-4 col-form-label text-md-right">{{ __('Alias:') }}</label>

                            <div class="col-md-6">
                                <input id="alias" type="text" class="form-control @error('alias') is-invalid @enderror" name="alias" value="{{ old('alias') }}" autocomplete="alias" autofocus>

                                @error('alias')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('* E-Mail Address:') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('* Password:') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('* Confirm Password:') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone number:') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <hr> <p class="col-md-6 offset-md-4">Address:</p>
                       
                        <div class="form-group row">
                            
                            <label for="address_street_and_num" class="col-md-4 col-form-label text-md-right">{{ __('Street and number:') }}</label>

                            <div class="col-md-6">
                                <input id="address_street_and_num" type="text" class="form-control @error('address_street_and_num') is-invalid @enderror" name="address_street_and_num" value="{{ old('address_street_and_num') }}" autocomplete="address_street_and_num" autofocus>

                                @error('address_street_and_num')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="address_city" class="col-md-4 col-form-label text-md-right">{{ __('City:') }}</label>

                            <div class="col-md-6">
                                <input id="address_city" type="text" class="form-control @error('address_city') is-invalid @enderror" name="address_city" value="{{ old('address_city') }}" autocomplete="address_city" autofocus>

                                @error('address_city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="address_post_code" class="col-md-4 col-form-label text-md-right">{{ __('Post code:') }}</label>

                            <div class="col-md-6">
                                <input id="address_post_code" type="text" class="form-control @error('address_post_code') is-invalid @enderror" name="address_post_code" value="{{ old('address_post_code') }}" autocomplete="address_post_code" autofocus>

                                @error('address_post_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            
                            <label for="address_country" class="col-md-4 col-form-label text-md-right">{{ __('Country:') }}</label>

                            <div class="col-md-6">
                                <input id="address_country" type="text" class="form-control @error('address_country') is-invalid @enderror" name="address_country" value="{{ old('address_country') }}" autocomplete="address_country" autofocus>

                                @error('address_country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                        <br>
                        <p class="col-md-10 offset-md-1">* Only these fields are required for basic registration.</p>
                        <br>
                        <p class="col-md-10 offset-md-1">However, to be able to participate on auction, make sure that you finnish full registration with phone number and address.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
