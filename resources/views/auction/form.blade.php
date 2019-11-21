@extends('admin_layout')

@section('admin')
    <div class="form-group row">
        <label for="min_price" class="col-md-4 col-form-label text-md-right">Min. Price:</label>

        <div class="col-md-6">
            <input id="min_price" type="number" class="form-control @error('min_price') is-invalid @enderror" name="min_price" value="{{ old('min_price', $auctionItem->minimum_price) }}">

            @error('min_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="starts_at" class="col-md-4 col-form-label text-md-right">Starts:</label>

        <div class="col-md-6">
            <input id="starts_at" type="datetime-local" class="form-control @error('starts_at') is-invalid @enderror" name="starts_at" value="{{ old('starts_at', date("Y-m-d\TH:i", strtotime($auctionItem->starts_at))) }}">

            @error('starts_at')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <label for="ends_at" class="col-md-4 col-form-label text-md-right">Ends:</label>

        <div class="col-md-6">
            <input id="ends_at" type="datetime-local" class="form-control @error('ends_at') is-invalid @enderror" name="ends_at" value="{{ old('ends_at', date("Y-m-d\TH:i", strtotime($auctionItem->ends_at))) }}">

            @error('ends_at')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
@endsection