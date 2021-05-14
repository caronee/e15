@extends('layouts/main')

@section('title')
All specimens
@endsection

@section('head')
<link href='/css/specimens/index.css' rel='stylesheet'>
@endsection

@section('content')

<h1>Type Specimens Storage</h1>

@if(count($specimens) == 0)
No specimens have been added yet...

@else
<div id='books'>
    <table class="table  table-bordered">

        <thead>
            <tr>
                <th scope="col">Species</th>
                <th scope="col">Repository</th>
                <th scope="col">Country</th>
                <th scope="col">Publication</th>
                <th scope="col">Published Year</th>


                <th scope="col">Type</th>
                <th scope="col">Catalogue Entry</th>


                <th scope="col">Comments</th>

                <th scope="col">Edit</th>
                <th scope="col">Delete</th>


            </tr>
        </thead>
        <tbody>
            @foreach($specimens as $specimen)
            @if($specimen->mineral)

            <tr>

                <td>
                    <p> {{ $specimen->mineral->slug }}
                    </p>
                </td>
                <td>
                    @if($specimen->repository)

                    <a class='specimen' href='/repositories/{{ $specimen->repository->repository_id }}'>
                        {{ $specimen->repository->display_name }}

                    </a>
                    @endif
                </td>
                <td>
                    @if($specimen->country)
                    <a class='specimen' href='/specimens/{{ $specimen->country->country_id }}'>
                        {{$specimen->country->country }}
                    </a>
                    @endif
                </td>

                <td>
                    <p> {{ $specimen->mineral->publication}}

                    </p>
                </td>
                <td>
                    <p> {{ $specimen->mineral->published_year }}

                    </p>
                </td>
                <td>
                    <p> {{ $specimen->type_status }}

                    </p>
                </td>

                <td>

                    <p> {{ $specimen->catalogue_entry }}

                    </p>
                </td>
                <td>
                    <p> {{ $specimen['comments'] }} </p>
                </td>

                <td>
                    <a class='specimen' href='/specimens/{{ $specimen->mineral->slug }}/edit'>
                        Edit
                    </a>
                </td>

                <td>
                    <a class='specimen' href='/specimens/{{ $specimen->slug }}/edit'>
                        Delete
                    </a>
                </td>

                </td>

                @endif
                @endforeach

    </table>
    </tbody>



</div>
@endif

@endsection
