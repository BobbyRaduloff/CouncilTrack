<!DOCTYPE html>
<!-- Temporary positioning until bootstrap !-->
<!-- Needs code witch which you doesn't allow you to enter this webpage without permission !-->
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Usage </title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link rel="stylesheet" type="text/css" href="styles\usage_style.css">
	</head>
	<body>
		<?php
			include('default_header.html');
			include('connect.php');

			session_start();
			?>
		<div class = "interface">
			<form method="POST">
				<button id = "input_button" name = "input">  Input Information </button>
				<button id = "output_button"  name="output"> Output Of Databases </button>
				<button id = "back_button"  name="back"> Back</button>
			</form>
		</div>
		<?php
			if(isset($_POST['input'])) {
			  header("Location:database_selector_input.php");
			}

			if(isset($_POST['output'])) {
			  header("Location:database_selector_output.php");
			}

			if(isset($_POST['back'])) {
			  header("Location:index.php");
			}
			?>
	</body>
</html>
