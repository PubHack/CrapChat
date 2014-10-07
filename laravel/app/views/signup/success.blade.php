@extends('signup.layout')

@section('content')
    <h1>Success!</h1>

    <p>You've successfully signed up for Crapchat.</p>

    <p>Your pin code is: <strong>{{ $user->pin }}</strong>.</p>
@stop