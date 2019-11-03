@extends('layouts/app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Item</div>
                <div class="card-body">
                    @can('admin')
                        <form method="POST" action="{{ action('ItemController@store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">* Title:</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">Description:</label>

                                <div class="col-md-6">
                                    <textarea name="description" id="description" rows="10" class="form-control @error('description') is-invalid @enderror" autocomplete="description" autofocus>{{ old('description') }}</textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="currency" class="col-md-4 col-form-label text-md-right">Currency:</label>
                                <div class="col-md-6">
                                    <select id="currency" class="form-control @error('currency') is-invalid @enderror" name="currency" autocomplete="currency" autofocus>
                                        <option value="CZK">CZK</option>
                                        <option value="EUR">EUR</option>
                                        <option value="USD">USD</option>
                                    @error('currency')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="estimated_price" class="col-md-4 col-form-label text-md-right">Estimated Price:</label>

                                <div class="col-md-6">
                                    <input id="estimated_price" type="text" class="form-control @error('estimated_price') is-invalid @enderror" name="estimated_price" value="{{ old('estimated_price') }}" autocomplete="estimated_price" autofocus>

                                    @error('estimated_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="old-doner">
                                <div class="form-group row">
                                    <label for="doner" class="col-md-4 col-form-label text-md-right">Doner:</label>
                                    <div class="col-md-6">
                                        <select id="doner" class="form-control @error('doner') is-invalid @enderror" name="doner" autocomplete="doner" autofocus>
                                            <option value="none">not defined</option>
                                            @foreach ($doners as $doner) :
                                                <option value="{{$doner->id}}">{{$doner->name}}</option>
                                            @endforeach
                                            
                                        @error('doner')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </select>
                                    </div>
                                </div>
    
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button id ="doner-buton" type="button" class="btn btn-secondary">
                                            New Doner
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div id="new-doner" class="d-none">
                                <hr>
                                @include('doners/inputs')
                                <div class="form-group row">
                                        <div class="col-md-6 offset-md-4">
                                            <button id ="doner-buton-back" type="button" class="btn btn-secondary">
                                                Back
                                            </button>
                                        </div>
                                    </div>
                            </div>

                            {{-- photo still missing --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Add Item
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <p>You are not authrized to add an item. Please contact admin.</p>
                    @endcan
                </div>
            </div>
        </div>
    </div>
    <script> // should be elsewhere
        document.addEventListener('DOMContentLoaded', () => {
            let button = document.querySelector('#doner-buton');
            let button_back = document.querySelector('#doner-buton-back');
            let old_doner = document.querySelector('#old-doner');
            let new_doner = document.querySelector('#new-doner');
            let doner = document.querySelector('#doner'); //select element
            let doner_name = document.querySelector('#name'); //doner name element
            
            button.onclick = function () {
                old_doner.classList.toggle('d-none');
                new_doner.classList.toggle('d-none');
                doner.value = 'none';
                console.log(doner.value);
            };

            button_back.onclick = function () {
                old_doner.classList.toggle('d-none');
                new_doner.classList.toggle('d-none');
                doner.value = 'none';
                doner_name.value = '';
                console.log(doner.value);
                console.log(doner_name.value);

            };
        });
    </script>
@endsection