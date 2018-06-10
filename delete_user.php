<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: New User </title>
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="icon" type="image/x-icon" href="data/favicon.ico">
</head>
<body>
	<?php
		include "connect.php";
		session_start();
		check();

		$conn = connect();
		$stmt = $conn->prepare("DELETE FROM users where id = ?");
		$stmt->bind_param("i", $_POST["delete"]);
		$stmt->execute();

		$stmt->close();
		$conn->close();
		header("Location: index.php");
	?>
</body>
</html>