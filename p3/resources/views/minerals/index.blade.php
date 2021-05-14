@extends('layouts/main')

@section('title')
All minerals
@endsection

@section('head')
<link href='/css/minerals/index.css' rel='stylesheet'>
@endsection

@section('content')

<h1>All minerals</h1>

@if(count($minerals) == 0)
No minerals have been added yet...

@else
<div id='books'>

    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th scope="col">Minerals</th>
                <th scope="col">Formula</th>
                <th scope="col">Type Locality</th>
                <th scope="col">Country</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>


            </tr>
        </thead>
        <tbody>



            @foreach($minerals as $slug => $mineral)
            <tr>
                <td>
                    {{ $mineral->slug }}
                </td>
                <td> {{ $mineral['formula'] }}
                </td>
                <td>
                    {{ $mineral->locality }}
                </td>
                <td>
                    @foreach ($countries as $country)
                    @if($country->id== $mineral->country_id )

                    {{$country->country}}

                    @endif
                    @endforeach
                </td>

                <td>

                    <a class='mineral' href='/minerals/{{ $mineral->slug }}/edit'>

                        Edit

                    </a>
                </td>
                <td>

                    <a class='mineral' href='/minerals/{{ $mineral->slug }}/delete'>

                        Delete

                    </a>
                </td>


            </tr>

            @endforeach

        </tbody>
    </table>

</div>
@endif

@endsection
