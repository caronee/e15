@extends('layouts/main')

@section('title')
All repositories
@endsection

@section('head')
<link href='/css/repositories/index.css' rel='stylesheet'>
@endsection

@section('content')

<h1>Repository List</h1>

@if(count($repositories) == 0)
No repositories have been added yet...

@else
<div id='books'>
    <table class="table  table-bordered">

        <thead>
            <tr>
                <th scope="col">Full Name</th>
                <th scope="col">Display Name</th>
                <th scope="col">Country</th>

                <th scope="col">Edit</th>
                <th scope="col">Delete</th>


            </tr>
        </thead>
        <tbody>
            @foreach($repositories as $repository)

            <tr>

                <td>

                    <p> {{ $repository['slug'] }}

                    </p>
                </td>


                <td>

                    <a class='repository' href='/repositories/{{ $repository['display_name'] }}'>

                        <h3>{{ $repository['display_name'] }}</h3>

                    </a>
                </td>
                <td>
                    @if($repository->country_id)
                    <a class='repository' href='/repositories/{{ $repository->country->country_id }}'>

                        <h3> {{$repository->country->country }}

                        </h3>

                    </a>
                    @endif
                </td>

                <td>

                    <a class='repository' href='/repositories/{{ $repository->display_name }}/edit'>

                        Edit

                    </a>

                </td>

                <td>

                    <a class='repository' href='/repositories/{{ $repository->display_name }}'>

                        Delete

                    </a>

                </td>


                @endforeach

    </table>
    </tbody>



</div>
@endif

@endsection
