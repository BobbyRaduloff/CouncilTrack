<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Login </title>
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="icon" type="image/x-icon" href="data/favicon.ico">
</head>
<body>
	<?php
		include "default_header.html";
	?>
	<h4> Login </h4>
	<form action="login.php" method="post" accept-charset="utf-8">
		<div class="form-group">
			<label for="username"> Username: </label>
			<input type="text" class="form-control" name="username" maxlenght="128">
		</div>
		<div class="form-group">
			<label for="password"> Password: </label>
			<input type="password" class="form-control" name="password" maxlength="128">
		</div>
		<button type="submit" class="btn btn-primary"> Log In </button>
	</form>
</body>
</html>