@extends('layouts/main')

@section('content')
<h1>What do types mean?</h1>
<br>
<p><a href="mailto: {{ config('mail.supportEmail')}}">Email</a></p>

A type sample has to be not only from the place where it was originally described, but also the complete (or a portion of) the piece that was actually studied for either the original description or a later redefinition.
</p>
<p>


    IF there was one parent sample and one locality, it’s a holotype – sometimes the holotype gets split up into pieces for different parts of the analysis and so you often get some who reference those as Part of the Holotype. (HT)
</p>
<p>

    Sometimes, the data for a new mineral is put together from more than one specimen, perhaps because there was not physically enough sample on just one piece, these get called cotypes. (CT)
</p>
<p>

    Even less occasionally, a new mineral is described based of two or more samples, like above BUT they are from different localities, that then also makes them cotypes and the localities are called co-type localities.
</p>
<p>

    If a mineral get redefined from a sample that is not the cotype or the holotype, perhaps because they were lost, destroyed or never preserved – these are Neotypes (NT)
</p>
<p>

    And finally, although we’ve not yet published it, there is also the very rare situation where sometimes, not all the data can be acquired from the natural material and so a synthetic counterpart is created, which is shown to be the same material and from that more data is obtained – this specimen is called an Anthropotype (AT)

</p>





@endsection
