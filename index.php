<!DOCTYPE html>
<html>

<head>
	<title>
		Print the content of a div
	</title>

	<!-- Script to print the content of a div -->
	<script>
		function printDiv() {
			var print_contents = document.getElementById("table_in_service").innerHTML;
			var a = window.open('', '', 'height=500, width=500');
			a.document.write('<html>');
			a.document.write('<body >');
			a.document.write(print_contents);
			a.document.write('</body></html>');
			a.document.close();
			a.print();
		}
	</script>
</head>

<body style="text-align:center;">

	<div id="GFG" style="background-color: green;">

		<h2>Geeksforgeeks</h2>

		<p>
			This is inside the div and will be printed
			on the screen after the click.
		</p>
	</div>

	<input type="button" value="click" onclick="printDiv()">
</body>

</html>
