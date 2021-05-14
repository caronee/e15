@extends('layouts/main')

@section('content')

@if(Auth::user())
<h2>
    Hello {{ Auth::user()->name }}!
</h2>
@endif


<p dusk='welcome'>
    The CTMS is updated every month with NEW data directly from the IMA's Commission of New Minerals, Nomenclature and Classification.

</p>
<p> Additionally, data will be progressively audited and developed by the members of the IMA-CMs CTMS working-group alongside submissions from museum curators across the globe.
    Please get in touch with errors and corrections. </p>

<p>Search by terms, chemical formulas, countries, institutions, locations, type status and more.
</p>


<hr />
@endsection
