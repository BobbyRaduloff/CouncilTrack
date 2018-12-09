<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
	<link rel="stylesheet" type="text/css" href="style/main.css">
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			session_start();
			include "header.html";
			include "utils.php";

			check_level(3);
		?>
		<div class="row">
			<div class="col mx-auto btn-ui">
				<button class="btn btn-lg btn-primary btn-block" onclick="location.href='submit.php';"> Submit </button>
			</div>
			<div class="col mx-auto btn-ui">
				<button class="btn btn-lg btn-primary btn-block" onclick="location.href='view.php';"> View </button>
			</div>
		</div>
		<?php if($_SESSION['level'] < 3) : ?>
			<div class="row">
				<div class="col mx-auto btn-ui">
					<button class="btn btn-lg btn-success btn-block" onclick="location.href='add_event.php';"> Add Event </button>
				</div>
				<div class="col mx-auto btn-ui">
					<button class="btn btn-lg btn-danger btn-block" onclick="location.href='delete_event.php';"> Delete/(Un)Lock Event </button>
				</div>
			</div>
		<?php endif; ?>
		<?php if($_SESSION['level'] < 2) : ?>
			<div class="row">
				<div class="col mx-auto btn-ui">
					<button class="btn btn-lg btn-success btn-block" onclick="location.href='add_user.php';"> Add User </button>
				</div>
				<div class="col mx-auto btn-ui">
					<button class="btn btn-lg btn-danger btn-block" onclick="location.href='delete_user.php';"> Delete User </button>
				</div>
			</div>
		<?php endif; ?>
		<div class="row">
			<div class="col mx-auto btn-ui">
				<button class="btn btn-lg btn-warning btn-block" onclick="location.href='logout.php';"> Log Out </button>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<p class="h4 text-right">
					Balance: 
					<?php
						$conn = db_connect();
						$stmt = $conn->prepare("SELECT balance FROM users WHERE id = ?");
						$stmt->bind_param("i", $_SESSION["id"]);
						$stmt->execute();
						$stmt->bind_result($balance);
						$stmt->fetch();
						echo $balance;
						echo " BGN.";
					?>
				</p>
			</div>
		</div>
		<?php include "footer.html"; ?>
	</div>
</body>
</html>
