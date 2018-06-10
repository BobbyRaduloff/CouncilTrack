<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack </title>
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
	<h3> Council Track </h3>
	<hr>
	<?php if(isset($_SESSION['username'])) : ?>
		<?php if($_SESSION['level'] <= 2) : ?>

		<?php endif; ?>
		<?php if($_SESSION['level'] <= 1) : ?>

		<?php endif; ?>
		<?php if($_SESSION['level'] == 0) : ?>
			<h4> Create New User: </h4>
			<form action="new_user.php" method="post" accept-charset="utf-8">
				<div class="form-group">
					<label for="new_username"> Username: </label>
					<input type="text" class="form-control" name="new_username" maxlength="128">
				</div>
				<div class="form-group">
					<label for="new_password"> Password: &nbsp; </label>
					<input type="password" class="form-control" name="new_password" maxlength="128">
				</div>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" name="new_admin" value="yes">
					<label class="form-check-label" for="new_admin"> Admin </label>
				</div>
				<br>
				<button type="submit" class="btn btn-primary"> Create </button>
			</form>
		<?php endif; ?>
		<hr>
			<form action="logout.php" method="post" accept-charset="utf-8">
			<button type="submit" class="btn btn-danger"> Log Out </button>
		</form>
	<?php else : ?>
		<h4> Login </h4>
		<form action="login.php" method="post" accept-charset="utf-8">
			<div class="form-group">
				<label for="username"> Username: </label>
				<input type="text" class="form-control" name="username" maxlenght="128">
			</div>
			<div class="form-group">
				<label for="password"> Password:&nbsp; </label>
				<input type="password" class="form-control" name="password" maxlength="128">
			</div>
			<br>
			<button type="submit" class="btn btn-primary"> Log In </button>
		</form>
	<?php endif; ?>
</body>
</html>