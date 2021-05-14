@extends('layouts/main')

@section('title')
@endsection

@section('head')
<link href='/css/specimens/show.css' rel='stylesheet'>
@endsection
@section('content')

@if(!$specimen)
This is neither a specimen nor a rock! <a href='/specimens'>Check out the other specimens in our library...</a>
@else


<h1>{{ $specimen['display_name'] }}</h1>
<table class="table  table-bordered">

    <thead>
        <tr>
            <th scope="col">Species</th>
            <th scope="col">Formula</th>
            <th scope="col">Type Locality</th>
            <th scope="col">From meteorite?</th>
            <th scope="col">Rock/ specimen</th>
            <th scope="col">Edit</th>


        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{ $specimen['display_name'] }}</th>

            <td>

                <p> {{ $specimen['type_status'] }}

                </p>
            </td>

            <td>

                <p class='description'>

                    {{ $specimen['comments']}}</p>

            </td>
            <td>
                <p class='description'>
                    {{ $specimen['catalogue_entry'] }}
                </p>
            </td>
            <td>
                <p class='description'>
                    @if( $specimen['CT'] )
                    specimen
                    @else Rock
                    @endif


                </p>
            </td>
            <td>

                <a class='specimen' href='/specimens/{{ $specimen['display_name'] }}/edit'>

                    Edit
                </a>
            </td>


    </tbody>

    @endif
    @endsection
