<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Database Output</title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link rel="stylesheet" type="text/css" href="styles/base_output.css">
	</head>
	<body>
		<?php
			include('default_header.html');

			echo
			"<h2><strong>Event statistics:</strong></h2>

			<div id = 'main_content'>

			<p>Item One Sold:</p>
			<br id = 'same_type_br'>

			<p id = 'delivered'>Items Delivered:</p>
			<br>

			<div id = 'section2'>

			<p> Money Needed: </p>
			<br>

			<p id = 'acquired'> Money Acquired: </p>
			<br>

			<p id = 'profit'> Profit: </p>
			<br>
			</div>

			<form method = 'POST'>
			<button id = 'view' class =  'btn btn-success' name = 'view_database'> View Table </button>
			<br>
			<button id = 'back' class = 'btn btn-danger' name = 'back'> Back </button>
			</form>
			</div>
			";

			if(isset($_POST['back'])) {
			  header("Location: database_selector_output.php");
			}
			?>
	</body>
</html>
