@extends('layouts/main')

@section('content')
<h1>Register</h1>

Already have an account? <a href='/login'>Login here...</a>

<form method='POST' action='/register'>
    {{ csrf_field() }}

    <label for='name'>Name</label>
    <input id='name' type='text' name='name' value='{{ old('name') }}' autofocus>
    @include('includes.error-field', ['fieldName' => 'name'])

    <label for='email'>E-Mail Address</label>
    <input id='email' type='email' name='email' value='{{ old('email') }}'>
    @include('includes.error-field', ['fieldName' => 'email'])

    <label for='password'>Password (min: 8)</label>
    <input id='password' type='password' name='password'>
    @include('includes.error-field', ['fieldName' => 'password'])

    <label for='password-confirm'>Confirm Password</label>
    <input id='password-confirm' type='password' name='password_confirmation'>

    <button type='submit' class='btn btn-primary'>Register</button>
</form>
@endsection
