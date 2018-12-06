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
			<div class="form-group row">
				<div class="col mx-auto">
				<label for="username" class="sr-only"> Username </label>
				<input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
				</div>
			</div>
			<div class="form-group row">
				<div class="col mx-auto">
					<label for="username" class="sr-only"> Name </label>
					<input type="text" name="name" class="form-control" placeholder="Full Name" required>
				</div>
			</div>
			<div class="form-group row">
				<div class="col mx-auto">
					<label for="password" class="sr-only"> Password </label>
					<input type="password" name="password" class="form-control" placeholder="Password" required>
				</div>
			</div>
			<div class="form-group row">
				<div class="col mx-auto">
					<label for="level"> Privilige Level: </label>
					<select class="selector" name="level" form="add-user-form">
						<option value="3"> Junior User </option>
						<option value="2"> Senior User </option>
						<option value="1"> Administrator </option>		
					</select>
				</div>
			</div>
			<div class="form-group row">
				<div class="col mx-auto">
					<button class="btn btn-lg btn-primary btn-block btn-final" type="submit"> Finalize </button>
				</div>
			</div>
		</form>
		<?php include "back.html"; ?>
		<?php include "footer.html"; ?>
	</div>	
</body>
</html>