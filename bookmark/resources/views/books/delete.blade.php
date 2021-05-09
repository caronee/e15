{{-- /resources/views/books/create.blade.php --}}
@extends('layouts/main')

@section('title')
Add a book
@endsection

@section('content')

@if(session('flash-alert'))
{{session('flash-alert')}}
@endif

<h1>Delete a book!</h1>

<p>Want to delete a book to your list that isn’t in our library? {{ $book->title}}</p>


<form method='POST' action='/books/{{ $book->slug}}'>
    {{ method_field('delete')}}
    {{ csrf_field() }}


    <button type='submit' class='btn brn-danger btn-small'>Delete Book</button>

</form>

@if(count($errors) > 0)
<ul class='alert alert-danger'>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
</ul>
@endif

</form>
@endsection
