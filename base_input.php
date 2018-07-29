<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Input Into Database</title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<style type="text/css">
			.inter_form {
			line-height: 400%;
			}
			br {
			line-height: 150%;
			}
			input {
			width: 100%; height: 2cm;
			}
			#first_digits {
			width: 30%; height: 1.5cm;
			}
			#last_digits{
			width: 30%; height: 1.5cm;
			}
			#instructions{
			text-align: center;
			font-size: 36px;
			}
			p {
			font-size: 36px;
			}
			input[type = "text"] {
			font-size:32px;
			}
			h1 {
			text-align: center;
			}
			#name_first {
			position: relative; bottom: 470px;
			}
			#name_last {
			position: relative; bottom: 400px;
			}
			.digit {
			text-align: center;
			}
			#first_digits {
			position: relative; bottom: 330px;
			}
			#seperator {
			font-size: 45px;
			position: relative; bottom: 387.5px; left: 210px;
			}
			#last_digits {
			position: relative; bottom: 448px; left: 250px;
			}
			#buyer {
			position: relative; bottom: 360px;
			}
			#main_content {
			position: relative; bottom: 20px;
			}
			#adjust_position {
			position: relative; bottom: 10px;
			}
			#submit {
			position: relative; bottom: 320px; left: 70px;
			height: 1.8cm; width: 30%;
			font-size: 36px; font-family: verdana; letter-spacing: 1px;
			}
			#back {
			position: relative; bottom: 320px; left: 170px;
			height: 1.8cm; width: 30%;
			font-size: 36px; font-family: verdana; letter-spacing: 1px;
			}
		</style>
	</head>
	<body>
		<div id = "adjust_position">
			<?php
				include('default_header.html');
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
			?>
	</body>
</html>
