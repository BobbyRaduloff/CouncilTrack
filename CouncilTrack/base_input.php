<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CouncilTrack: Input</title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link rel="stylesheet" type="text/css" href="styles/base_input.css">
		<link rel="icon" type="image/x-icon" href="data/favicon.ico">
	</head>
	<body>
		<div id = "adjust_position">
			<?php
				include('default_header.html');
				include('connect.php');

				session_start();
				?>
			<h2 id = "instructions"><strong> Please enter the following information about the recepient: </strong></h2>
			<br>
			<div id = "main_content">
				<p>First Name:</p>
				<br class = "inter_form">
				<p>Surname:</p>
				<br class = "inter_form">
				<p>Section:</p>
				<br class = "inter_form">
				<p>Buyer's Name:</p>
				<br class = "inner_form">
				<form method = "POST">
					<input id = "name_first" type = "text" name = "first_name" placeholder="First Name">
					<input id = "name_last" type = "text" name = "surname" placeholder="Surname">
					<input class = "digit" id = "first_digits" type = "text" name = "section_num_one">
					<h2 id = "seperator">
					/
					<h2>
					<input class = "digit" id = "last_digits" type = "text" name = "section_num_one">
					<input id = "buyer" type = "text" name = "buyer" placeholder="Buyer's name">
					<br>
					<button id = "submit" class = "btn btn-primary" name = "submit"> Submit </button>
					<button id = "back" class = "btn btn-danger" name = "back"> Back </button>
				</form>
			</div>
		</div>
		<?php
			if(isset($_POST['back'])) {
			  header("Location: database_selector_input.php");
			}
			check_login();
			?>
	</body>
</html>
