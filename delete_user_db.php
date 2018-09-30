<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Delete User </title>
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

			if(empty($_POST["id"])) {
				echo "<p class=\"h3 text-center\"> No username entered. </p>";
				try_again("delete_user.php");
			} else {
				$conn = db_connect();
				$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
				if(!stmt) {
					echo "<p class=\"h3 text-center\"> Something went wrong. </p>";
					try_again("delete_user.php");
				}
				$stmt->bind_param("i", $_POST["id"]);
				$stmt->execute();
				$stmt->close();
				$conn->close();

				header("Location: main.php");
			}
		?>
	</div>	
</body>
</html>