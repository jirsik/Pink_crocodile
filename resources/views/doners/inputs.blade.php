<?php
if (isset($doner)) {
    $name = $doner->name;
    $link = $doner->link;
    $about = $doner->about;
    $contact_name = $doner->contact_name;
    $phone = $doner->phone;
    $email = $doner->email;
    $doner_photo_path = $doner->photo_path;
} else {
    $name = '';
    $link = '';
    $about = '';
    $contact_name = '';
    $phone = '';
    $email = '';
    $doner_photo_path = '';
}

?>

<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">* Personal/ Company Name:</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $name) }}">

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="link" class="col-md-4 col-form-label text-md-right">Doner's website</label>

    <div class="col-md-6">
        <input id="link" type="text" class="form-control @error('link') is-invalid @enderror" name="link" value="{{ old('link', $link) }}">

        @error('link')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="about" class="col-md-4 col-form-label text-md-right">About doner:</label>

    <div class="col-md-6">
        <textarea name="about" id="about" rows="10" class="form-control @error('about') is-invalid @enderror">{{ old('about', $about) }}</textarea>
        

        @error('about')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<hr>
<p class="text-center">For admin's use only</p>

<div class="form-group row">
    <label for="contact_name" class="col-md-4 col-form-label text-md-right">Contact Name:</label>

    <div class="col-md-6">
        <input id="contact_name" type="text" class="form-control @error('contact_name') is-invalid @enderror" name="contact_name" value="{{ old('contact_name', $contact_name) }}">

        @error('contact_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="phone" class="col-md-4 col-form-label text-md-right">Phone number:</label>

    <div class="col-md-6">
        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $phone) }}">

        @error('phone')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">Doner's Email:</label>

    <div class="col-md-6">
        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $email) }}">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>