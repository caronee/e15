{{-- /resources/views/repositories/create.blade.php --}}
@extends('layouts/main')

@section('title')
Add a repository
@endsection

@section('content')


@if(session('flash-alert'))
<div class='flash-alert'>
    {{ session('flash-alert')}}
</div>
</ul>
@endif



<h1>Add a repository</h1>

<p>Does your institution not exist in our list? Add it here!</p>

<form method='POST' action='/repositories'>
    <div class='details'>* Required fields</div>
    {{ csrf_field() }}
    <label for='slug'>* Institution Name</label>
    <input type='text' name='slug' id='slug' value='{{ old("slug") }}'>


    <label for='display_name'>* Display Name</label>
    <input type='text' name='display_name' id='display_name' value='{{ old("display_name") }}'>


    <label for='country'>Country</label>
    <select name='country_id' id='country_id'>
        <option value=''> Select a country</option>


        @foreach ($countries as $country)
        <option value='{{ $country->id }}'>
            {{$country->country}}
        </option>

        @endforeach
    </select>


    <label for='comments'>Comments</label>
    <textarea name='comments'>{{ old('comments') }}</textarea>

    <button type='submit' class='btn btn-primary'>Add repository</button>

    @if(count($errors) > 0)
    <ul class='alert alert-danger'>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

</form>
@endsection
