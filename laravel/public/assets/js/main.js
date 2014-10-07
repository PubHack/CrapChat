
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

	$('#signup').click(function(e) {
		e.preventDefault();
		var username = $('#username').val();
		var password = $('#password').val();

		$.ajax('/signup', {
			data: {
				username: username,
				password: password
			},
			method: 'post',
			success: function(data) {
				$('.overlay__inputs').html('<p>You\'ve successfully signed up for CrapChat.</p><p>Your pin code is: ' + data.pin + '</p>');
			}
		});
	});

});