<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Database Output</title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<style>
			#delivered {
			position: relative; bottom: 35px;
			}
			#main_content {
			position: relative; top: 20px;
			}
			#section2 {
			position: relative; bottom: 20px;
			}
			#acquired {
			position: relative; bottom: 30px;
			}
			#profit {
			position: relative; bottom: 55px;
			}
			h2 {
			font-size: 48px;
			font-family: Bahnschrift Light ;
			}
			p {
			font-size: 36px;
			font-family: Bahnschrift Light ;
			}
			#view {
			position: relative; bottom: 70px;
			width: 100%; height: 2cm;
			font-size: 40px;
			background-color: #428442;
			letter-spacing: 1px; font-family: verdana;
			}
			#back {
			position: relative; bottom: 30px; left: 150px;
			width: 50%; height: 2cm;
			font-size: 40px;
			background-color: #ad2c27;
			letter-spacing: 1px; font-family: verdana;
			}
		</style>
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
