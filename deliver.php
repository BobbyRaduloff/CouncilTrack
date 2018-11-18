<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Deliver </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
	<script type="text/javascript" src="js/add_event.js"></script>
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			session_start();
			include "header.html";
			include "utils.php";
			//check_level(3);
			if(isset($_POST["id"]) && isset($_POST["event"])) {
				$conn = db_connect();
				$stmt = $conn->prepare("UPDATE table${_POST["event"]} SET delivered = 1 WHERE id = ?");
				$stmt->bind_param("i", intval($_POST["id"]));
				$stmt->execute();
			} else {
				echo "AAAAAAA";
			}
			include "footer.html"; ?>
	</div>
</body>
</html>