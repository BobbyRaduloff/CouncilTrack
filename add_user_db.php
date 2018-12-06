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
			include "header.html";
			include "utils.php";

			session_start();

			check_level(1);

			if(empty($_POST["username"])) {
				echo "<p class=\"h3 text-center\"> No username entered. </p>";
				try_again("add_user.php");
			} elseif(empty($_POST["password"])) {
				echo "<p class=\"h3 text-center\"> No password entered. </p>";
				try_again("add_user.php");
			} elseif(empty($_POST["level"])) {
				echo "<p class=\"h3 text-center\"> No password entered. </p>";
				try_again("add_user.php");
			} elseif(empty($_POST["name"])) {
				echo "<p class=\"h3 text-center\"> No full name entered. </p>";
				try_again("add_user.php");
			} else {
				$conn = db_connect();
				$stmt = $conn->prepare("INSERT INTO users (username, name, password, level) VALUES (?, ?, ?, ?)");
				if(!$stmt) {
					echo "<p class=\"h3 text-center\"> Something went wrong... <\p>";
					try_again("add_user.php");
				}
				$hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
				$level = intval($_POST["level"]);
				$stmt->bind_param("sssi", $_POST["username"], $_POST["name"], $hashed_password, $level);
				$stmt->execute();

				$stmt->close();
				$conn->close();

				header("Location: main.php");
			}
		?>
	</div>	
</body>
</html>