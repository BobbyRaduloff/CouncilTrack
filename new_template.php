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

		if(empty($_POST["template_name"])) {
			die("<h3> You forgot the name... </h3>");
			again();
		} elseif (empty($_POST["template_num"])) {
			die("<h3> You forgot the amount of items... </h3>");
			again();
		} else {
			$conn = connect();

			$stmt = $conn->prepare("INSERT INTO templates (name, num, items, prices) VALUES (?, ?, ?, ?)");
			
			$items = "";
			$prices = "";
			$seperator = "\x00";
			for($i = 0; $i < $_POST["template_num"]; $i++) {
				$ii = $_POST["template_item" . $i];
				$ip = $_POST["template_price" . $i];
				$items .= $ii . $seperator;
				$prices .= $ip . $seperator;
			}

			$stmt->bind_param("siss", $_POST["template_name"], $_POST["template_num"], $items, $prices);
			$stmt->execute();

			$stmt->close();
			$conn->close();

			header("Location: index.php");
		}
	?>
</body>
</html>