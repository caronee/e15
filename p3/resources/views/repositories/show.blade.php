@extends('layouts/main')

@section('title')
@endsection

@section('head')
<link href='/css/repositories/show.css' rel='stylesheet'>
@endsection
@section('content')

@if(!$repository)
This is neither a repository nor a rock! <a href='/repositories'>Check out the other repositories in our library...</a>
@else


<h1>{{ $repository['display_name'] }}</h1>
<table class="table  table-bordered">

    <thead>
        <tr>
            <th scope="col">Species</th>
            <th scope="col">Formula</th>
            <th scope="col">Type Locality</th>
            <th scope="col">From meteorite?</th>
            <th scope="col">Rock/ repository</th>
            <th scope="col">Edit</th>


        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{ $repository['display_name'] }}</th>

            <td>

                <p> {{ $repository['type_status'] }}

                </p>
            </td>

            <td>

                <p class='description'>

                    {{ $repository['comments']}}</p>

            </td>
            <td>
                <p class='description'>
                    {{ $repository['catalogue_entry'] }}
                </p>
            </td>
            <td>
                <p class='description'>
                    @if( $repository['CT'] )
                    repository
                    @else Rock
                    @endif


                </p>
            </td>
            <td>

                <a class='repository' href='/repositories/{{ $repository['display_name'] }}/edit'>

                    Edit
                </a>
            </td>


    </tbody>

    @endif
    @endsection
