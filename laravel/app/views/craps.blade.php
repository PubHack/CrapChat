<h3>All Craps</h3>

<div class="craps-list">

	@foreach ($craps as $crap)

		<div>
			Sent by <span>{{ $crap->from }}</span> to {{ $crap->to }} at {{ $crap->date->format('jS F, Y') }}.
		</div>
		<div>
			<img src="/crap/classy/{{ $crap->key }}">
		</div>
		<div><code>{{ $crap->key }}</code></div>

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