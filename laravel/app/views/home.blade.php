@extends('layout')

@section('content')
<div class="content-blur">
	<h1 class="page__title">Crap<span>Chat</span></h1>
	<h2 class="page__subtitle">SnapChat for Phone Boxes</h2>

	<div class="copy">
		This is some copy text explaining exactly how CrapChat works
	</div>

	<a href="#" class="button page__get-started">Let's Get Started!</a>

	
	<footer class="footer">
		<p class="footer__ddd">Another <a href="http://devsdodesign.com">#DevsDoDesign</a> Production</p>
	</footer>
	
</div>

	<div class="overlay__wrapper">
		<div class="overlay--signup">
			<form action="/" method="post">
				<div class="overlay__title">
					<img src="/assets/img/snapchat.jpg" alt="">
				</div>
				<div class="overlay__inputs">
					<input type="text" name="username" id="username" placeholder="Username...">
					<input type="password" name="password" id="password" placeholder="Password...">
				</div>
				<a class="button overlay__signin" href="#" id="signup">Sign In With Snapchat</a>
			</form>
		</div>
		<div class="overlay--success"></div>
	</div>
@stop