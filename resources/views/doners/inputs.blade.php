<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">* Doner's name</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>

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
    <label for="about" class="col-md-4 col-form-label text-md-right">About doner:</label>

    <div class="col-md-6">
        <textarea name="about" id="about" rows="10" class="form-control @error('about') is-invalid @enderror" autofocus>{{ old('about') }}</textarea>
        

        @error('about')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>