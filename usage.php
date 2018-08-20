<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Usage </title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<link rel="stylesheet" type="text/css" href="styles/usage.css">
	</head>
	<body>
		<?php
			include('default_header.html');
			include('connect.php');
			session_start();
			check(2);
		?>
		<div>
			<button class="btn btn-success btn-xlg" name="input" onclick="location.href = 'database_selector_input.php';"> Input </button>
			<button class="btn btn-danger btn-xlg"  name="output" onclick="location.href = 'database_selector_output.php';"> Output </button>
			<button class="btn btn-secondary btn-xlg" name="back" onclick="location.href = 'index.php';"> Back </button>
		</div>
	</body>
</html>
