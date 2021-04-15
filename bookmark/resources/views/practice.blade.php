@extends('layouts/main')

@section('content')

<h1>Practice</h1>
@foreach($methods as $method)
<a href='{{ str_replace('practice', '/practice/', $method) }}'>{{ $method }}</a><br>
@endforeach

@endsection
