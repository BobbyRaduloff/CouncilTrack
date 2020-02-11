<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Add Event </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			include "header.html";
			include "utils.php";

			session_start();

			check_level(2);

			if(empty($_POST["name"])) {
				echo "<p class=\"h3 text-center\"> No name entered. </p>";
				try_again("add_event.php");
			} elseif(empty($_POST["i"])) {
				echo "<p class=\"h3 text-center\"> No item entered. </p>";
				try_again("add_event.php");
			} else {
				$conn = db_connect();
				$count = intval($_POST["i"]);
				$items = "";
				$same = (isset($_POST["same"]) ? 1 : 0);
				for($i = 0; $i < $count; $i++) {
					$stmt = $conn->prepare("INSERT INTO items (name, price) VALUES (?, ?) ");
					if(!$stmt) {
						goto wrong;
					}
					$stmt->bind_param("sd", $_POST["item".(string)$i], floatval($_POST["price".(string)$i]));
					$stmt->execute();
					$id = $conn->insert_id;
					$items .=  (string)$id;
					if($i < $count - 1) {
						$items .= ",";
					}
					$stmt->close();
				}

				$stmt = $conn->prepare("INSERT INTO tables (name, i, same, items, locked) VALUES (?, ?, ?, ?, ?)");
				if(!$stmt) {
					goto wrong;
				}
				$z = 0;
				$stmt->bind_param("siisi", $_POST["name"], $count, $same, $items, $z);
				$stmt->execute();
				$id = $conn->insert_id;
				$stmt->close();

				$params = array();
				$tablename = "table" . (string)$id;
				$query = "CREATE TABLE ${tablename} (id int NOT NULL AUTO_INCREMENT UNIQUE, delivered int, who int, ";
				for($i = 0; $i < $count; $i++) {
					if(empty($_POST["item".(string)$i])) {
						echo "<p class=\"h3 text-center\"> Fill all the fields. </p>";
						try_again("add_event.php");
					} else {
						$params["item".(string)$i] = $_POST["item".(string)$i];
					}
					$query .= "item${i} BOOLEAN,";
				}
				if($same) {
					$query .= "grade int, section int, name varchar(512), email varchar(512)";
				} else {
					$query .= "grade int, section int, name varchar(512), email varchar(512), recepient varchar(512), r_grade int, r_section int, r_email varchar(512), anonymous int(1), message varchar(2048)";
				}
				$query .= ", ts TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";
				$stmt = $conn->prepare($query);
				if(!$stmt) {
					goto wrong;
				}
				$stmt->execute();
				$stmt->close();

				$moneytable = $tablename . "m";
				$query = "CREATE TABLE ${moneytable} (id int NOT NULL UNIQUE, balance double NOT NULL)";
				$stmt = $conn->prepare($query);
				$stmt->execute();
				$stmt->close();

				$conn->close();
				header("Location: main.php");
				wrong:
				echo "<p class=\"h3 text-center\"> Something went wrong... </p>";
				try_again("add_event.php");
			}
		?>
	</div>	
</body>
</html>