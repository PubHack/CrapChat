@extends('signup.layout')

@section('content')
	<h1>Sign up</h1>
	<form action="/signup" method="post">
		<input type="text" name="username" placeholder="username">
		<input type="password" name="password" placeholder="pasword">
		<button type="submit">Submit</button>
	</form>
@stop
