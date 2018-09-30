<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Login </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
</head>
<body class="mx-auto">
	<div class="container">
		<?php include "header.html"; ?>
		<?php
			include "utils.php";

			session_start();

			if(!empty($_SESSION["level"])) {
				header("Location: main.php");
			}

			if(empty($_POST["username"])) {
				echo "<p class=\"h3 text-center\"> No username entered. </p>";
				try_again("index.php");
			} elseif(empty($_POST["password"])) {
				echo "<p class=\"h3 text-center\"> No password entered. </p>";
				try_again("index.php");
			} else {
				$conn = db_connect();
				$stmt = $conn->prepare("SELECT password, level FROM users where username = ?");
				if(!$stmt) {
					goto wrong;
				}
				$stmt->bind_param("s", $_POST["username"]);
				$stmt->execute();
				$stmt->bind_result($real_pass, $level);
				$stmt->fetch();

				if(password_verify($_POST["password"], $real_pass)){
					$_SESSION["username"] = $_POST["username"];
					$_SESSION["level"] = $level;
					header("Location: main.php");
				} else {
					wrong:
					echo "<p class=\"h3 text-center\"> Wrong username or password. </p>";
					try_again("index.php");
				}

				$stmt->close();
				$conn->close();
			}
		?>
	</div>	
</body>
</html>