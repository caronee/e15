{{-- /resources/views/books/create.blade.php --}}
@extends('layouts/main')

@section('title')
Add a book
@endsection

@section('content')
<h1>Add a book</h1>

<p>Want to add a book to your list that isn’t in our library? Not a problem- you can add it here!</p>

<form method='POST' action='/books'>
    <div class='details'>* Required fields</div>
    {{ csrf_field() }}

    <label for='title'>* Title</label>
    <input type='text' name='title' id='title'>

    <label for='author'>* Author</label>
    <input type='text' name='author' id='author'>

    <label for='published_year'>* Published Year (YYYY)</label>
    <input type='text' name='published_year' id='published_year'>

    <label for='cover_url'>Cover URL</label>
    <input type='text' name='cover_url' id='cover_url' value='http://'>

    <label for='info_url'>* Wikipedia URL</label>
    <input type='text' name='info_url' id='info_url' value='http://'>

    <label for='purchase_url'>* Purchase URL </label>
    <input type='text' name='purchase_url' id='purchase_url' value='http://'>

    <label for='description'>Description</label>
    <textarea name='description'></textarea>

    <button type='submit'>Add Book</button>
</form>
@endsection
