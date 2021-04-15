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
    @foreach($newBooks as $book)
    <li>{{$book->title}}</li>
    <p></p>

    @endforeach

    @foreach($books as $book)
    <a class='book' href='/books/{{ $book }}'>
        <h3>{{ $book['title'] }}</h3>
        <img class='cover' src='{{ $book['cover_url'] }}'>
    </a>
    </a>
    @endforeach
</div>
@endif

@endsection
