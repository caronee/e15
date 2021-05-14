{{-- /resources/views/minerals/create.blade.php --}}
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



<h1>Add a mineral</h1>

<p>Add new IMA minerals here!</p>

<form method='POST' action='/minerals'>
    <div class='details'>* Required fields</div>
    {{ csrf_field() }}


    <label for='slug'>* Species Name</label>
    <input type='text' name='slug' id='slug' value='{{ old("slug") }}'>

    <label for='formula'>Formula</label>
    <input type='text' name='formula' id='formula' value='{{ old("formula" )}}'>



    <label for='IMA_reference'>* IMA_reference</label>
    <input type='text' name='IMA_reference' id='IMA_reference' value='{{ old("IMA_reference") }}'>


    <label for='locality'>Type Locality </label>
    <input type='text' name='locality' id='locality' value='{{ old('locality') }}'>

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

    <button type='submit' class='btn btn-primary'>Add mineral</button>

    @if(count($errors) > 0)
    <ul class='alert alert-danger'>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

</form>
@endsection
