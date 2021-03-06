@extends('layouts/main')

@section('title')
{{ $book ? $book['title'] : 'Book not found' }}
@endsection

@section('head')
<link href='/css/books/show.css' rel='stylesheet'>
@endsection

@section('content')

@if(!$book)
Book not found. <a href='/books'>Check out the other books in our library.</a>
@else

hello
<img class='cover' src='{{ $book['cover_url'] }}' alt='Cover photo for {{ $book['title'] }}'>

<h1>{{ $book['title'] }}</h1>

<p>By {{ $book['author'] }} ({{ $book['published_year']}})</p>

<a href='{{ $book['purchase_url'] }}'>Purchase...</a>

<p class='description'>
    {{ $book['description'] }}
    <a href='{{ $book['info_url'] }}'>Learn more...</a>
</p>
<a href='/list/{{ $book['slug'] }}/add'>Add book to List</a>

<a href='{{ $book['slug'] }}/edit'>Edit</a>
<a href='{{ $book['slug'] }}/delete'>Delete</a>


@endif

@endsection




<!--<h1> $ </h1>
        if$
        <p>
            Details about this book will go here... <//?php echo $title; ?>
            Another title <//?= $title;?>
        </p>
        else
        <p>
            Book not found
        </p>
        endif
-->
