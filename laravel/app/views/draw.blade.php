<?php $size = 20; ?>
<html>
<body>

<style>
	table {
		border-spacing: 1;
	}
	td.drawable {
		width: 20px;
		height: 20px;
		background: black;
	}
	input[type=radio] {
		display: none;
	}
	label {
		width: 40px;
		height: 15px;
		display: inline-block;
		border: 4px solid transparent;;
		box-shadow: 0 0 2px rgba(0,0,0,.3);
	}
	input:checked + label {
		border-color: rgb(184, 0, 255);
	}
	pre {
		word-wrap: break-word;
	}
</style>

<div id="colorshere">
	@foreach ($colors as $color => $colorCode)
		<input type="radio" name="color" value="{{ $color }}" id="color{{ $colorCode }}" @if ($colorCode === 0) checked @endif>
		<label for="color{{ $colorCode }}" style="background: {{ $color }};"></label>
	@endforeach
</div>

<table>
	<?php for ($i=0; $i < $size; $i++) : ?>
		<tr>
			<?php for ($j=0; $j < $size; $j++) : ?>
				<td class="drawable"></td>
			<?php endfor; ?>
			<td><button class="fill">Fill</button></td>
		</tr>
	<?php endfor; ?>
</table>

<button id="generate">Generate Code</button>
<pre id="output"></pre>

<script>
	var colorMap = (function() {
		var map = {{ json_encode($colors) }};
		return {
			fromColor: function(color) {
				return map[color ? color : 'rgb(0, 0, 0)'];
			},
			getAll: function() {
				return map;
			}
		}
	})();

	var getColor = function() { return document.querySelector('[name=color]:checked').value; }

	// nodelist to array
	var nl2ar = function(nl) { return Array.prototype.slice.call(nl); };
	// query selector string to array
	var qs2ar = function(selector) { return nl2ar(document.querySelectorAll(selector)); };

	var cells = qs2ar('td.drawable');

	var drawing = false;
	document.addEventListener('mousedown', function() { drawing = true; });
	document.addEventListener('mouseup', function() { drawing = false; });

	var fillCell = function(cell) { cell.style.background = getColor(); }

	cells.forEach(function(cell) {
		cell.addEventListener('mouseover', function() {
			if ( ! drawing) return;
			fillCell(cell);
		});
	});

	qs2ar('button.fill').forEach(function(btn) {
		btn.addEventListener('click', function() {
			nl2ar(btn.parentNode.parentNode.querySelectorAll('td.drawable')).forEach(function(cell) {
				fillCell(cell);
			});
		});
	});

	document.querySelector('#generate').addEventListener('click', function(btn) {
		var output = qs2ar('td.drawable').map(function(td) {
			return colorMap.fromColor(td.style.background);
		});
		document.querySelector('#output').textContent = output;
	});
</script>

</body>
</html>