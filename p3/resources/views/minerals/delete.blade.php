@extends('layouts/main')

@section('head')
<link href='/css/minerals/delete.css' rel='stylesheet'>
@endsection

@section('title')
Confirm deletion: {{ $mineral->slug }}
@endsection

@section('content')

<h1>Confirm deletion</h1>


<form method='POST' action='/minerals/{{ $mineral->slug }}'>
    {{ method_field('delete') }}
    {{ csrf_field() }}


    <button type='submit' class='btn btn-danger btn-small'>Delete</button>
</form>



@endsection
