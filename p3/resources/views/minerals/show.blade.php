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


<h1>{{ $mineral['slug'] }}</h1>
<table class="table  table-bordered">

    <thead>
        <tr>
            <th scope="col">Species</th>
            <th scope="col">IMA_reference</th>

            <th scope="col">Formula</th>
            <th scope="col">Type Locality</th>
            <th scope="col">Country</th>

            <th scope="col">Publication</th>
            <th scope="col">Publication Year</th>

        </tr>
    </thead>
    <tbody>
        @foreach($mineral as $minerals)


        <tr>
            <th scope="row">{{ $mineral['slug'] }}</th>
            <td>
                <p class='description'>{{ $mineral['IMA_reference']}}</p>
            </td>

            <td>
                <p> {{ $mineral['formula'] }}
                </p>
            </td>

            <td>
                <p class='description'>{{ $mineral['locality']}}</p>
            </td>
            <td>
                <p class='description'>{{ $mineral['country']}}</p>
            </td>


            <td>
                <p class='description'>
                    {{$mineral['publication'] }}
                </p>
            </td>
            <td>
                <p class='description'>
                    {{ $mineral['published_year'] }}
                </p>
            </td>
            @endforeach


</table>
</tbody>

@endif
@endsection
