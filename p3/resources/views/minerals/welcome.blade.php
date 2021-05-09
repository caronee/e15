@extends('layouts/main')

@section('content')
<h1>International Mineralogical Association</h1>

<h2>
    CATALOGUE OF TYPE MINERAL SPECIMENS (CTMS)

</h2>

<p>
    The CTMS is updated every month with NEW data directly from the IMA's Commission of New Minerals, Nomenclature and Classification.

</p>
<p> Additionally, data will be progressively audited and developed by the members of the IMA-CMs CTMS working-group alongside submissions from museum curators across the globe.
    Please get in touch with errors and corrections. </p>

<p>Search by terms, chemical forumlas, countries, institutions, locations, type status and more.
</p>

<form method='GET' action='/search'>
    <fieldset>
        <label for='searchTerms'>
            Search by Minerals Species:

            <input type='text' id='searchTerms' name=' searchTerms' value='{{ old('searchTerms', 'afghanite') }}'>


        </label>
    </fieldset>

    <fieldset>
        <label for='minRock'>Search by Minerals Species:
            <input type='radio' name='minRock' id='minRock' value='mineral' {{ (old('minRock') == 'mineral' OR is_null(old('minRock'))) ? 'checked' : ''}}> Mineral
            <input type='radio' name='minRock' id='minRock' value='rock' {{ (old('minRock') == 'rock') ? 'checked' : ''}}> Rock
        </label>

        <label for='element'>Contains Element: (case sensitive, one or two characters only)
            <input type='text' name='element' id='element' value='{{ old('element', 'Na') }}'>
        </label>

        <label for='locality'>

            Type Locality (the place the mineral was originally found from):

            <select id='locality' name='locality'>

                <option value=''>All places</option>
                @foreach($countries as $slug => $country)
                <option name='locality' value='{{ $country['Country'] }}'>{{ $country['Country'] }}</option>
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
                <th style="width: 20%" scope="col">Rock/ Mineral</th>
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
