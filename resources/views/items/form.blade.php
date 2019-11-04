@extends('layouts/app')

<?php
if (isset($item)) {
    $title = $item->title;
    $description = $item->description;
    $estimated_price = $item->estimated_price;
    $currency = $item->currency;
    $doner_id = $item->doner->id;
    $photo_path = $item->photo_path;

    $action = action('ItemController@update', $item->id);
    $button_title = 'Edit Item';
} else {
    $title = '';
    $description = '';
    $estimated_price = '';
    $currency = 'CZK';
    $doner_id = 'none';
    $photo_path = '';

    $action = action('ItemController@store');
    $button_title = 'Add New Item';
}
?>

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Item</div>
                <div class="card-body">
                    @can('admin')
                        <form method="POST" action={{$action}}>
                            @csrf
                            @if (isset($item))
                                <input name="_method" type="hidden" value="put">
                            @endif 
                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">* Title:</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $title) }}">

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
                                    <textarea name="description" id="description" rows="10" class="form-control @error('description') is-invalid @enderror">{{ old('description', $description) }}</textarea>

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
                                    <select id="currency" class="form-control @error('currency') is-invalid @enderror" name="currency">
                                        <option value="CZK" {{($currency === 'CZK') ? 'Selected' : ''}}>CZK</option>
                                        <option value="EUR" {{($currency === 'EUR') ? 'Selected' : ''}}>EUR</option>
                                        <option value="USD" {{($currency === 'USD') ? 'Selected' : ''}}>USD</option>
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
                                    <input id="estimated_price" type="text" class="form-control @error('estimated_price') is-invalid @enderror" name="estimated_price" value="{{ old('estimated_price', $estimated_price) }}">

                                    @error('estimated_price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="old-doner" class="@error('name') d-none @enderror">
                                <hr>
                                <div class="form-group row">
                                    <label for="doner" class="col-md-4 col-form-label text-md-right">Doner:</label>
                                    <div class="col-md-6">
                                        <select id="doner" class="form-control @error('doner') is-invalid @enderror" name="doner">
                                            <option value="none" {{($doner_id === 'none') ? 'Selected' : ''}}>not defined</option>
                                            <option hidden value="new">new</option>
                                            @foreach ($doners as $doner_info) :
                                                <option value="{{$doner_info->id}}"  {{($doner_info->id === $doner_id) ? 'Selected' : ''}}>{{$doner_info->name}}</option>
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
                                <hr>
                            </div>

                            <div id="new-doner" class="d-none @error('name') d-block @enderror">
                                <hr>
                                @include('doners/inputs')
                                <div class="form-group row">
                                    <div class="col-md-6 offset-md-4">
                                        <button id ="doner-buton-back" type="button" class="btn btn-secondary">
                                            Do not add new doner
                                        </button>
                                    </div>
                                </div>
                                <hr>
                            </div>

                            {{-- photo still missing --}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{$button_title}}
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
            let doner_button = document.querySelector('#doner-buton');
            let doner_button_back = document.querySelector('#doner-buton-back');
            let old_doner = document.querySelector('#old-doner');
            let new_doner = document.querySelector('#new-doner');
            let doner = document.querySelector('#doner'); //select element
            let doner_name = document.querySelector('#name'); //doner name element
            let doner_last_value = '';
            
            doner_button.onclick = function () {
                old_doner.classList.toggle('d-none');
                new_doner.classList.toggle('d-block');
                doner_last_value = doner.value;
                doner.value = 'new';
            };

            doner_button_back.onclick = function () {

                old_doner.classList.toggle('d-none');
                new_doner.classList.toggle('d-block');
                doner.value = doner_last_value;
                doner_name.value = '';
            };
        });
    </script>
@endsection