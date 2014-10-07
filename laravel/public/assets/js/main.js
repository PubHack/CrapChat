
$(function() {
	$('.page__get-started').click(function(e) {
		e.preventDefault();
		console.log('clicked');		
		$('.overlay--signup').addClass('has-animated-in');
		setTimeout(function() {
			$('.content-blur').addClass('is-blurred');
		}, 100);
	});

	$('.is-blurred').click(function(e) {
		e.preventDefault();
		$('.is-blurred').removeClass('.is-blurred');
	});

});