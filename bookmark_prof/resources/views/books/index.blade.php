@extends('layouts/main')

@section('title')
All books
@endsection

@section('head')
<link href='/css/books/index.css' rel='stylesheet'>
@endsection

@section('content')

<h1>All Books</h1>

@if(count($books) == 0)
No books have been added yet...
@else
<div id='books'>
    @foreach($books as $slug => $book)
    <a class='book' href='/books/{{ $slug }}'>
        <h3>{{ $book['title'] }}</h3>
        <img class='cover' src='{{ $book['cover_url'] }}'>
    </a>
    </a>
    @endforeach
</div>
@endif

@endsection
