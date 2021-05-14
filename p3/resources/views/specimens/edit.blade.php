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

<?php
    // if data is posted, set value to 1, else to 0
    $check_0 = isset($_POST['check'][0]) ? 1 : 0;
    $check_1 = isset($_POST['check'][1]) ? 1 : 0;
?>


<h1>Edit a specimen</h1>

<p>Want to edit a specimen !</p>

<form method='POST' action='/specimens/{{$specimen->display_name}}'>
    <div class='details'>* Required fields</div>
    {{ csrf_field() }}
    {{method_field('put')}}

    <label for='display_name'>* Institution Name</label>
    <select name='display_name' id='display_name'>
        @foreach ($repositories as $repository)
        @if($repository->id== $specimen->repository_id )

        <option value='{{ $repository->id }}' selected>
            {{$repository->display_name}}
        </option>
        @else

        <option value='{{ $repository->id }}'>
            {{$repository->display_name}}
        </option>
        @endif
        @endforeach
    </select>

    <label for='slug'>* Species Name</label>

    <select name='mineral_id' id='mineral_id'>


        <option value=''> Select a Mineral</option>


        @foreach ($minerals as $mineral)
        @if($mineral->id== $specimen->mineral_id )

        <option value='{{ $mineral->id }}' selected>
            {{$mineral->slug}}
        </option>
        @else

        <option value='{{ $mineral->id }}'>
            {{$mineral->slug}}
        </option>
        @endif
        @endforeach

    </select>



    <label for='IMA_reference'>* IMA_reference</label>
    <input type='text' name='IMA_reference' id='IMA_reference' value='{{ old("IMA_reference", $specimen->IMA_reference )}}'>

    <label for='country'>Country</label>
    <select name='country_id' id='country_id'>


        <option value=''> Select a country</option>


        @foreach ($countries as $country)
        @if($country->id== $specimen->country_id )

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


    <label for='catalogue_entry'>Catalogue Number</label>
    <input type='text' name='catalogue_entry' id='catalogue_entry' value='{{ old("catalogue_entry", $specimen->catalogue_entry) }}'>
    </br>

    <h3 style='text-align: left'>Select the type of type specimen that the repository has. A repository can have more than one type of specimen.</h3>

    <input type='hidden' name='T' id='T' value='0'>

    <input type='checkbox' name='T' id='T' value='{{ old("T", $specimen->T )}}' @if(old("T", $specimen->T)) checked @endif>



    <label for='T'>Type </label>
    <input type='hidden' name='CT' id='CT' value='0'>
    <input type='checkbox' name='CT' id='CT' value='1' @if(old("CT", $specimen->CT)) checked @endif>
    <label for='CT'>CoType </label>

    <input type='hidden' name='HT' id='HT' value='0'>

    <input type='checkbox' name='HT' id='HT' value='1' @if(old("HT", $specimen->HT)) checked @endif>
    <label for='HT'>Holo Type </label>
    <input type='hidden' name='NT' id='NT' value='0'>

    <input type='checkbox' name='NT' id='NT' value='1' @if(old("NT", $specimen->NT)) checked @endif>
    <label for='NT'>Neo Type </label>
    <input type='hidden' name='PT' id='PT' value='0'>

    <input type='checkbox' name='PT' id='PT' value='1' @if(old("PT", $specimen->PT)) checked @endif>
    <label for='PT'>Para Type </label>
    <input type='hidden' name='AT' id='AT' value='0'>
    <input type='checkbox' name='AT' id='AT' value='1' @if(old("AT", $specimen->AT)) checked @endif>

    <label for='AT'>AT </label>







    <label for='comments'>Comments</label>
    <textarea name='comments'>{{ old('comments', $specimen->comments )}}</textarea>

    <button type='submit' class='btn btn-primary'>Edit specimen</button>

    @if(count($errors) > 0)
    <ul class='alert alert-danger'>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

</form>
@endsection
