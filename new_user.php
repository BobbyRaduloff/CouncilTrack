<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: New User </title>
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
</head>
<body>
	<?php
		include "connect.php";

		session_start();
		if($_SESSION['level'] != 0) {
			die("<h3> You don't have the correct permissions! </h3>");
		}

		if(empty($_POST["new_username"])) {
			die("<h3> You forgot the username... </h3>");
		} elseif (empty($_POST["new_password"])) {
			die("<h3> You forgot the password... </h3>");
		} else {
			$conn = connect();
			$stmt = $conn->prepare("INSERT INTO users (username, password, level) VALUES (?, ?, ?)");
			$hashed_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);
			$level = $_POST["new_admin"] == "yes" ? 1 : 2;
			$stmt->bind_param("ssi", $_POST["new_username"], $hashed_password, $level);
			$stmt->execute();

			$stmt->close();
			$conn->close();

			header("Location: index.php");
		}
	?>
</body>
</html>