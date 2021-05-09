{{-- /resources/views/books/create.blade.php --}}
@extends('layouts/main')

@section('title')
Add a book
@endsection

@section('content')

@if(session('flash-alert'))
{{session('flash-alert')}}
@endif

<h1>Edit a book</h1>

<p>Want to edit a book? Not a problem- you can edit it here!</p>

<form method='POST' action='/books/{{$book->slug}}'>
    <div class=' details'>* Required fields</div>
    {{ csrf_field() }}
    {{ method_field('put') }}

    @include('includes/error-field', ['fieldName' => 'slug'])


    <label for='title'>* Title</label>
    <input type='text' name='title' id='title' value='{{ old('slug', $book->title)}}'>

    @include('includes/error-field', ['fieldName' => 'title'])


    <label for='title'>* short URL</label>
    <input type='text' name='slug' id='slug' value='{{ old('slug', $book->slug)}}'>

    <label for='author_id'>* Author</label>
    <select name='author_id' dusk='author-id-select' id='author_id'>
        <option value=''>Choose one...</option>
        @foreach($authors as $author)
        <option value='{{ $author->id }}' {{ $author->id == $book->author->id ? 'selected' : '' }}>{{ $author->last_name }}, {{ $author->first_name }}</option>
        @endforeach
    </select>


    <label for='published_year'>* Published Year (YYYY)</label>
    <input type='text' name='published_year' id='published_year' value='{{ old('slug', $book->published_year)}}'>


    <label for='cover_url'>Cover URL</label>
    <input type='text' name='cover_url' id='cover_url' value='{{ old('slug', $book->cover_url)}}'>


    <label for='info_url'>* Wikipedia URL</label>
    <input type='text' name='info_url' id='info_url' value='{{ old('slug', $book->info_url)}}'>


    <label for='purchase_url'>* Purchase URL </label>
    <input type='text' name='purchase_url' id='purchase_url' value='{{ old('slug', $book->purchase_url)}}'>


    <label for='description'>Description</label>
    <textarea name='description'>{{ old('slug', $book->description)}}</textarea>



    <button type='submit'>Save Changes</button>

    @if(count($errors) > 0)
    <ul class='alert alert-danger'>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

</form>
@endsection
