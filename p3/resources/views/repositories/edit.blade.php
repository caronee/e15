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

<?php
    // if data is posted, set value to 1, else to 0
    $check_0 = isset($_POST['check'][0]) ? 1 : 0;
    $check_1 = isset($_POST['check'][1]) ? 1 : 0;
?>


<h1>Edit a repository</h1>

<p>Want to edit a repository to your list that isn’t in our list? Not a problem- you can add it here!</p>

<form method='POST' action='/repositories/{{$repository->slug}}'>
    <div class='details'>* Required fields</div>
    {{ csrf_field() }}
    {{method_field('put')}}

    <label for='slug'>* Display Name</label>
    <input type='text' name='slug' id='slug' value='{{ old("slug", $repository->slug) }}'>



    <label for='country'>Country</label>
    <select name='country_id' id='country_id'>
        <option value=''> Select a country</option>


        @foreach ($countries as $country)
        @if($country->id== $repository->country_id )

        <option value='{{ $country->id }}' selected>
            {{$country->country}}
        </option>
        @else

        <option value='{{ $country->id }}'>
            {{$country->country}}
        </option>
        @endif
        @endforeach
    </select>


    <label for='comments'>Comments</label>
    <textarea name='comments'>{{ old('comments', $repository->comments )}}</textarea>

    <button type='submit' class='btn btn-primary'>Edit repository</button>

    @if(count($errors) > 0)
    <ul class='alert alert-danger'>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

</form>
@endsection
