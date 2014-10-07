<h3>All Craps</h3>

<div class="feed__wrapper">

	@foreach ($craps as $crap)
		
			<div class="feed__single">
				<img src="/crap/classy/{{ $crap->key }}" alt="">
				<div class="feed__foot">
					<h1 class="sender-name">
						<span class="feed-left">Sender</span>
						<span class="feed-right">{{ $crap->from }}</span>
					</h1>
					<h2 class="rec-name">
						<span class="feed-left">Reciever</span>
						<span class="feed-right">{{ $crap->to }}</span>
					</h2>
					<p class="send-time">
						<span class="feed-left">Date</span>
						<span class="feed-right">{{ $crap->date->format('jS F, Y') }}</span>
					</p>
					<p class="send-code">
						<span class="feed-left">Code</span>
						<span class="feed-right">{{ $crap->key }}</span>
					</p>
				</div>
			</div>


	@endforeach

</div>

<script type="text/foo" id="footemplate">
	<div>
	<div>
		Sent by <span class="x-from"></span> to <span class="x-to"></span> at <span class="x-date"></span>.
	</div>
	<div>
		<img class="x-img">
	</div>
	<div><code class="x-key"></code></div>
	</div>
</script>

<script src="/assets/js/jquery.js"></script>
<script src="//js.pusher.com/2.2/pusher.min.js"></script>
<script>
	var pusher = new Pusher('ca9d97aac5dd27d76180');
	var channel = pusher.subscribe('crap');
	channel.bind('new-crap', function(data) {
		var templ = $($('#footemplate').text());
		templ.find('.x-from').text(data.from);
		templ.find('.x-to').text(data.to);
		templ.find('.x-date').text(data.date);
		templ.find('.x-key').text(data.key);
		templ.find('.x-img').get(0).src = '/crap/classy/'+data.key;
		$('.craps-list').prepend(templ);
	});
</script>