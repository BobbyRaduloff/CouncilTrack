<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Add User </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			session_start();
			include "header.html";
			include "utils.php";

			check_level(1);
		?>
		<form id="add-user-form" class="form-ct" action="add_user_db.php" method="post" accept-charset="utf-8">
			<p class="h2 text-center form-heading"> Add user </p>
			<label for="username" class="sr-only"> Username </label>
			<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
			<label for="password" class="sr-only"> Password </label>
			<input type="password" name="password" class="form-control" placeholder="Password" required>
			<label for="level"> Privilige Level: </label>
			<select class="selector" name="level" form="add-user-form">
				<option value="3"> Junior User </option>
				<option value="2"> Senior User </option>
				<option value="1"> Administrator </option>		
			</select>
			<button class="btn btn-lg btn-primary btn-block btn-final" type="submit"> Next </button>
		</form>
		<?php include "back.html"; ?>
		<?php include "footer.html"; ?>
	</div>	
</body>
</html>