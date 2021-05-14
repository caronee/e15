{{-- /resources/views/specimens/create.blade.php --}}
@extends('layouts/main')

@section('title')
Add a specimen
@endsection

@section('content')


@if(session('flash-alert'))
<div class='flash-alert'>
    {{ session('flash-alert')}}
</div>
</ul>
@endif



<h1>Add a specimen</h1>

<p>Want to add a specimen to your list that isn’t in our list? Not a problem- you can add it here!</p>

<form method='POST' action='/specimens'>
    <div class='details'>* Required fields</div>
    {{ csrf_field() }}


    <label for='slug'>* Species Name</label>
    <select name='mineral' id='mineral'>

        <option value=''>
            Pick a Specimen
        </option>

        @foreach($minerals as $mineral)

        <option value='{{ $mineral->id }}'>
            {{$mineral->slug}}
        </option>

        @endforeach
    </select>


    <label for='display_name'>* Institution Name</label>
    <select name='display_name' id='display_name'>
        @foreach ($repositories as $repository)

        @if($repository->country)

        <option value='{{ $repository->id }}'>

            {{$repository->country->country}} | {{$repository->display_name}}


        </option>

        @endif
        @endforeach


    </select>

    <label for='country'>Country</label>
    <select name='country_id' id='country_id'>
        <option value=''> Select a country</option>


        @foreach ($countries as $country)
        <option value='{{ $country->id }}'>
            {{$country->country}}
        </option>

        @endforeach
    </select>


    <label for='catalogue_entry'>Catalogue Number</label>
    <input type='text' name='catalogue_entry' id='catalogue_entry' value='{{ old("catalogue_entry") }}'>

    <label for='type_status'>type status </label>
    <input type='text' name='type_status' id='type_status' value='tbd'>

    <input type='hidden' name='T' id='T' value='0'>
    <input type='checkbox' name='T' id='T' value='1'>

    <label for='T'>Type </label>
    <input type='hidden' name='CT' id='CT' value='0'>
    <input type='checkbox' name='CT' id='CT' value='1'>
    <label for='CT'>CoType </label>

    <input type='hidden' name='HT' id='HT' value='0'>

    <input type='checkbox' name='HT' id='HT' value='1'>
    <label for='HT'>Holo Type </label>
    <input type='hidden' name='NT' id='NT' value='0'>

    <input type='checkbox' name='NT' id='NT' value='1'>
    <label for='NT'>Neo Type </label>
    <input type='hidden' name='PT' id='PT' value='0'>

    <input type='checkbox' name='PT' id='PT' value='1'>
    <label for='PT'>Para Type </label>
    <input type='hidden' name='AT' id='AT' value='0'>
    <input type='checkbox' name='AT' id='AT' value='1'>

    <label for='AT'>AT </label>







    <label for='comments'>Comments</label>
    <textarea name='comments'>{{ old('comments') }}</textarea>

    <button type='submit' class='btn btn-primary'>Add specimen</button>

    @if(count($errors) > 0)
    <ul class='alert alert-danger'>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

</form>
@endsection
