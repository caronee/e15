{{-- /resources/views/repositories/create.blade.php --}}
@extends('layouts/main')

@section('title')
Add a mineral
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


<h1>Edit a mineral</h1>

<p>Want to edit a mineral to your list that isn’t in our list? Not a problem- you can add it here!</p>

<form method='POST' action='/minerals/{{$mineral->slug}}'>
    <div class='details'>* Required fields</div>
    {{ csrf_field() }}
    {{method_field('put')}}

    <label for='slug'>* Mineral Name</label>
    <input type='text' name='slug' id='slug' value='{{ old("slug", $mineral->slug) }}'>

    <label for='formula'>Formula </label>
    <input type='text' name='formula' id='formula' value='{{ old("formula", $mineral->formula )}}'>



    <label for='locality'>Type Locality </label>
    <input type='text' name='locality' id='locality' value='{{ old('locality', $mineral->locality) }}'>



    <label for='country'>Country</label>
    <select name='country_id' id='country_id'>
        <option value=''> Select a country</option>


        @foreach ($countries as $country)
        @if($country->id== $mineral->country_id )

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
    <textarea name='comments'>{{ old('comments', $mineral->comments )}}</textarea>

    <button type='submit' class='btn btn-primary'>Edit mineral</button>

    @if(count($errors) > 0)
    <ul class='alert alert-danger'>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

</form>
@endsection
