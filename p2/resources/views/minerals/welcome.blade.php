@extends('layouts/main')

@section('content')

<h2>
    search to find mineral or rock by specific categories!
</h2>



<p>
    Have you ever wondered the difference between a mineral and a rock? Graphite and granite?
</p>
<p> Well now you can look up specimens quickly!
    Or for advanced rock collectors (or very curious people), you can search by type localities and elements! </p>
<p>Note: Rocks do not have type localities or formulas by definition.
</p>

<form method='GET' action='/search'>




    <fieldset>
        <label for='searchTerms'>
            Name of a rock or mineral:

            <input type='text' name='searchTerms' value='{{old('searchTerms')}}'>

        </label>

    </fieldset>

    <fieldset>
        <label>

        </label>


        <label for='minrock'>Search by Minerals or Rocks:





            <input type='radio' name='minRock' id='minRock' value=0 {{ (old('minRock') == 0) ? 'checked' : ''}}> Rock
            <input type='radio' name='minRock' id='minRock' value=1 {{ (old('minRock') == 1 OR is_null(old('minRock'))) ? 'checked' : ''}}> Mineral






        </label>



        <label for='meteorite'>

            <!--input type='checkbox' name='meteorite' id='meteorite' value='meteorite'> Mineral from a Meteorite?-->

        </label>


        <label for='element'>Contains Element: (case sensitive, one or two characters only)
            <input type='text' name='element' id='element' value='{{old('element')}}'>

        </label>



        <label for='Locality'>

            Type Locality (the place the mineral was originally found from):

            <select id='ddl' name='Locality1' value='Locality1'>

                <option name='Locality' value=''>All places</option>

                @foreach($countries as $slug => $country)




                <option name='Locality' value='{{ $country['Country'] }}'>{{ $country['Country'] }}</option>









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
    @foreach($searchResults as $slug => $mineral) {{ $mineral['Species'] }} was neither a rock nor a mineral.


    @endforeach

    No results. Try switching from {{ (old('minRock') == 1) ? 'mineral' : 'rock'}} to {{ (old('minRock') == 1) ? 'rock' : 'mineral'}} if nothing shows up.






</div>
@else
<div class='results  '>


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

                    <p> {{ $mineral['Formula'] }}

                    </p>
                </td>

                <td>

                    <p class='description'>

                        {{ $mineral['TypeLocality']}}</p>

                </td>

                <td>
                    <p class='description'>
                        @if( $mineral['Valid'] )
                        Mineral
                        @else Rock
                        @endif


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
