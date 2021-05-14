@extends('layouts/main')

@section('content')

@if(Auth::user())
<h2>
    Hello {{ Auth::user()->name }}!
</h2>
@endif



<p>Search by terms, chemical formulas, countries, institutions, locations, type status and more.
</p>

<form method='GET' action='pages/search1'>
    <fieldset>
        <label for='searchTerms'>
            Search by Minerals Species:

            <label for='display_name'>* Institution Name</label>
            <select name='display_name' id='display_name'>
                <option value='' selected> Select an institution</option>

                @foreach ($repositories as $repository)
                @if($repository->id )

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
                @if($mineral->id)

                <option value='{{ $mineral->id }}' selected>
                    {{$mineral->slug}}
                </option>

                @endif
                @endforeach

            </select>



            <label for='locality'>

                Type Locality (the place the mineral was originally found from):


                <input type='text' id='searchTerms' name=' searchTerms' value='{{ old('searchTerms', 'afghanite') }}'>


            </label>
    </fieldset>

    <fieldset>


        <label for='element'>Contains Element: (case sensitive, one or two characters only)
            <input type='text' name='element' id='element' value=''>
        </label>

        <label for='country'>

            Country
            <select id='country' name='country'>

                <option value=''>All places</option>
                @foreach ($countries as $country)
                <option value='{{ $country->id }}'>
                    {{$country->country}}
                </option>
                @endforeach

            </select>
        </label>
    </fieldset>

    <input type='submit' class='btn btn-primary' value='Search'>

    @if(count($errors) > 0)
    <ul class='alert alert-danger'>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

</form>


@if(!is_null($searchResults))
@if(count($searchResults) == 0)
<div class='results alert alert-warning'>
    No results. Try switching from {{ (old('minRock') == 'rock') ? 'rock' : 'mineral'}} to {{ (old('minRock') == 'rock') ? 'mineral' : 'rock'}} if nothing shows up.
</div>
@else
<div class='results'>

    {{ count($searchResults) }}
    {{ Str::plural('Result', count($searchResults)) }}:

    <table class="table  table-bordered ">

        <thead>
            <tr>
                <th style="width: 25%" scope="col">Species</th>
                <th style="width: 35%" scope="col">Formula</th>
                <th style="width: 20%" scope="col">Type Locality</th>
                <th style="width: 20%" scope="col">Country</th>
            </tr>
        </thead>
        <tbody>
            @foreach($searchResults as $slug => $mineral)
            <tr>
                <th scope="row">{{ $mineral['Species'] }}</th>
                <td>
                    <p> {{ $mineral['Formula'] }}</p>
                </td>

                <td>
                    <p class='description'>{{ $mineral['TypeLocality']}}</p>
                </td>

                <td>
                    <p class='description'>
                        {{ $mineral['Valid'] ? 'Mineral' : 'Rock' }}
                    </p>
                </td>
                @endforeach
        </tbody>
    </table>

</div>
@endif
@endif

<hr />
@endsection
