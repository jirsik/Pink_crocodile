@extends('layouts/app')


@section('content')

<div class="root-container">

    <div id="root"></div>

    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        // const w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
        const h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
        // document.getElementById('root').style.width = w
        document.getElementById('root').style.height = h
    </script>
</div>
 
@endsection