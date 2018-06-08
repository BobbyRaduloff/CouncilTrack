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
	$db_servername = "localhost";
	$db_username = "root";
	$db_password = "password";
	$db_name	= "counciltrack";

	if(empty($_POST["username"])) {
		echo "<h3> You forgot the username... </h3>";
	} elseif (empty($_POST["password"])) {
		echo "<h3> You forgot the password... </h3>";
	} else {
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
		if($conn->connect_error) {
			die("Connection failed!");
		}

		$stmt = $conn->prepare("SELECT password, level FROM users WHERE username = ?");
		if(!$stmt) {
			die("Failed to communicate with database!");
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
			echo "<img src=\"data\\wrong.webp\">";
		}

		$stmt->close();
		$conn->close();
	}
?>
</body>
</html>