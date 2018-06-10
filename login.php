<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Login </title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
	include "connect.php";

	if(empty($_POST["username"])) {
		die("<h3> You forgot the username... </h3>");
	} elseif (empty($_POST["password"])) {
		die("<h3> You forgot the password... </h3>");
	} else {
		$conn = connect();
		$stmt = $conn->prepare("SELECT password, level FROM users WHERE username = ?");
		if(!$stmt) {
			goto wrong;
		}
		$stmt->bind_param("s", $_POST["username"]);
		$stmt->execute();
		$stmt->bind_result($real_pass, $level);
		$stmt->fetch();
		
		if(password_verify($_POST["password"], $real_pass)){ 
			echo "<h3> Success! </h3>";
			session_start();
			$_SESSION["username"] = $_POST["username"];
			$_SESSION["level"] = $level;
			header("Location: index.php");
		} else {
			wrong:
			echo "<img src=\"data\\wrong.webp\">";
		}

		$stmt->close();
		$conn->close();
	}
?>
</body>
</html>