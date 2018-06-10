<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack </title>
	<link rel="stylesheet" type="text/css" href="style.css">
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
				<label for="new_username"> Username: </label>
				<input type="text" name="new_username" maxlength="128">
				<br>
				<label for="new_password"> Password:&nbsp; </label>
				<input type="password" name="new_password" maxlength="128">
				<br>
				Admin: <input type="checkbox" name="new_admin" value="yes">
				<br>
				<input type="submit" name="new_submit" value="Create">
			</form>
		<?php endif; ?>
		<hr>
			<form action="logout.php" method="post" accept-charset="utf-8">
			<input type="submit" name="logout" value="Log Out">
		</form>
	<?php else : ?>
		<h4> Login </h4>
		<form action="login.php" method="post" accept-charset="utf-8">
			<label for="username"> Username: </label>
			<input type="text" name="username" maxlenght="128">
			<br>
			<label for="password"> Password:&nbsp; </label>
			<input type="password" name="password" maxlength="128">
			<br>
			<input type="submit" name="submit" value="Log in">
		</form>
	<?php endif; ?>
</body>
</html>