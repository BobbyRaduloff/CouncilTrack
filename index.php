<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Login </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			session_start();
			if(!empty($_SESSION["level"])) {
				header("Location: main.php");
			}
			include "header.html";
		?>
		<form class="form-ct" action="login.php" method="post" accept-charset="utf-8">
			<p class="h2 text-center form-heading"> Please sign in </p>
			<label for="username" class="sr-only"> Username </label>
			<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
			<label for="password" class="sr-only"> Password </label>
			<input type="password" name="password" class="form-control" placeholder="Password" required>
			<button class="btn btn-lg btn-primary btn-block btn-final" type="submit"> Sign in</button>
		</form>
	</div>	
</body>
</html>