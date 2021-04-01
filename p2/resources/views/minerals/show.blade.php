@extends('layouts/main')

@section('title')
@endsection

@section('head')
<link href='/css/minerals/show.css' rel='stylesheet'>
@endsection
@section('content')

@if(!$mineral)
This is neither a mineral nor a rock! <a href='/minerals'>Check out the other minerals in our library...</a>
@else


<h1>{{ $mineral['Species'] }}</h1>
<table class="table  table-bordered">

    <thead>
        <tr>
            <th scope="col">Species</th>
            <th scope="col">Formula</th>
            <th scope="col">Type Locality</th>
            <th scope="col">From meteorite?</th>
            <th scope="col">Rock/ Mineral</th>

        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">{{ $mineral['Species'] }}</th>

            <td>

                <p> {{ $mineral['Formula'] }}

                </p>
            </td>

            <td>

                <p class='description'>

                    {{ $mineral['TypeLocality']}}</p>

            </td>
            <td>
                <p class='description'>
                    {{ $mineral['Meteorite'] }}
                </p>
            </td>
            <td>
                <p class='description'>
                    @if( $mineral['Valid'] )
                    Mineral
                    @else Rock
                    @endif


                </p>
            </td>


    </tbody>

    @endif
    @endsection
