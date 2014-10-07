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
</style>

<input type="color" id="color" value="#ff0000">

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

<script>
	var getColor = function() { return document.querySelector('#color').value; }

	var nl2ar = function(nl) { return Array.prototype.slice.call(nl); };

	var cells = nl2ar(document.querySelectorAll('td.drawable'));

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

	nl2ar(document.querySelectorAll('button.fill')).forEach(function(btn) {
		btn.addEventListener('click', function() {
			nl2ar(btn.parentNode.parentNode.querySelectorAll('td.drawable')).forEach(function(cell) {
				fillCell(cell);
			});
		});
	});
</script>

</body>
</html>