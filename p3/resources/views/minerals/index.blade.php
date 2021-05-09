@extends('layouts/main')

@section('title')
All minerals
@endsection

@section('head')
<link href='/css/minerals/index.css' rel='stylesheet'>
@endsection

@section('content')

<h1>All minerals</h1>

@if(count($minerals) == 0)
No minerals have been added yet...

@else
<div id='books'>



    @foreach($minerals as $slug => $mineral)
    <a class='mineral' href='/minerals/{{ $mineral['Species'] }}'>

        <h3>{{ $mineral['Species'] }}</h3>

        {{ $mineral['Formula'] }}

    </a>

    @endforeach
</div>
@endif

@endsection
