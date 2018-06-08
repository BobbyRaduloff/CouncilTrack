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
			<?php if(isset($_SESSION['level'])) {
				switch ($_SESSION['level']) {
					case 0:
						header('Location: admin.php');
						break;
					
					default:
						header('use.php');
						break;
				}
			}
		?>
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