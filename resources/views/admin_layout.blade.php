@extends('layouts/app')

@section('content')

@include('inc/navbar')
@include('inc/messages')

<div class="container mt-3">
    @yield('admin')
</div>
    
@endsection
