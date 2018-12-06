<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Submit </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			include "header.html";
			include "utils.php";

			session_start();

			check_level(3);

			if(empty($_POST["name"])) {
				echo "<p class=\"h3 text-center\"> No name entered. </p>";
				try_again("submit.php");
			} elseif(empty($_POST["grade"])) {
				echo "<p class=\"h3 text-center\"> No grade entered. </p>";
				try_again("submit.php");
			} elseif(empty($_POST["section"])) {
				echo "<p class=\"h3 text-ceter\"> No section entered. </p>";
				try_again("submit.php");
			} elseif(empty($_POST["i"])) {
				echo "<p class=\"h3 text-center\"> Something's very wrong. Contact admin. </p>";
				try_again("submit.php");
			} elseif(!isset($_POST["same"])) {
				echo "<p class=\"h3 text-center\"> Something's very wrong. Contact admin. </p>";
				try_again("submit.php");
			}
			if(intval($_POST["i"]) > 0) {
				for($i = 0; $i++; $i < intval($_POST["i"])) {
					if(empty($_POST["item".(string)$i])) {
						echo "<p class=\"h3 text-center\"> You didn't enter all the items. </p>";
						try_again("submit.php");	
					}
				}
			}
			if($_POST["same"] == 0) {
				if(empty($_POST["r_grade"])) {
					echo "<p class=\"h3 text-center\"> You missed the recepient's grade. </p>";
					try_again("submit.php");
				} elseif(empty($_POST["r_name"])) {
					echo "<p class=\"h3 text-center\"> You missed the recepient's name. </p>";
					try_again("submit.php");
				} elseif(empty($_POST["r_section"])) {
					echo "<p class=\"h3 text-center\"> You missed the recepient's section. </p>";
					try_again("submit.php");
				}
			}
			if(empty($_POST["id"])) {
				echo "<p class=\"h3 text-center\"> Something's very wrong. Contact admin. </p>";
				try_again("submit.php");
			} else {
				$count = intval($_POST["i"]);
				$conn = db_connect();
				$stmt_string = "INSERT INTO table".$_POST["id"] . "(delivered, who, grade, section, name, email, ";
				if(intval($_POST["same"]) == 0) {
					$stmt_string .= "anonymous, r_grade, r_section, recepient, r_email, message, ";
				}
				for($i = 0; $i < $count; $i++) {
					$stmt_string .= "item".(string)$i;
					if($i < $count - 1) {
						$stmt_string .= " ,";
					}
				}
				$stmt_string .= ") VALUES (?, ?, ?, ?, ?, ?, ";
				if(intval($_POST["same"]) == 0) {
					$stmt_string .= "?, ?, ?, ?, ?, ?, ";
				}
				for($i = 0; $i < $count; $i++) {
					$stmt_string .= "?";
					if($i < $count - 1) {
						$stmt_string .= ", ";
					}
				}
				$stmt_string .= ")";
				$stmt = $conn->prepare($stmt_string);
				if(!$stmt) {
					goto wrong;
				}
				$param_array = array(((intval($_POST["same"]) == 0) ? "iiiissiiisss" : "iiiiss") . str_repeat("i", $count), 0, $_SESSION["id"], $_POST["grade"], $_POST["section"], $_POST["name"]);
				$to;
				if(empty($_POST["email"])) {
					$to = email_gen($_POST["name"], intval($_POST["grade"]));
					array_push($param_array, $to);
				} else {
					$to = $_POST["email"];
					array_push($param_array, $to);
				}
				if(intval($_POST["same"]) == 0) {
					array_push($param_array, intval(isset($_POST["anonymous"])));
					array_push($param_array, $_POST["r_grade"], $_POST["r_section"], $_POST["r_name"]);
					if(empty($_POST["r_email"])) {
						array_push($param_array, email_gen($_POST["r_name"], intval($_POST["r_grade"])));
					} else {
						array_push($param_array, $_POST["r_email"]);
					}
					array_push($param_array, $_POST["message"]);
				}
				for($i = 0; $i < $count; $i++) {
					array_push($param_array, $_POST["item".(string)$i]);
				}
				$stmt->bind_param(...$param_array);
				$stmt->execute();
				$stmt->close();
				
				$txt = "Hello, ${_POST["name"]}!\nThis is an email receipt from the student council, notifying you of your purchases. You bought:\n";
				$stmt = $conn->prepare("SELECT items from tables where id = ?");
				$stmt->bind_param("i", intval($_POST["id"]));
				$stmt->execute();
				$stmt->bind_result($item_names);
				$stmt->fetch();
				$item_array = explode(",", $item_names);
				$items = array();
				$stmt->close();
				for($i = 0; $i < $_POST["i"]; $i++) {
					$stmt = $conn->prepare("SELECT name, price FROM items where id = ?");
					$stmt->bind_param("i", $item_array[$i]);
					$stmt->execute();
					$stmt->bind_result($iname, $iprice);
					$stmt->fetch();
					$items[$i] = array($iname, $iprice);
					$stmt->close();
				}
				$total = 0;
				for($i = 0; $i < $_POST["i"]; $i++) {
					$txt .= $_POST["item".$i] . " x " . ($items[$i])[0] . " (" . ($items[$i])[1] . ") = " . ($_POST["item".$i] * ($items[$i])[1]) . "lv.\n";
					$total += intval($_POST["item".$i]) * ($items[$i])[1];
				}
				$stmt = $conn->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
				$stmt->bind_param("is", $total, $_SESSION["id"]);
				$stmt->execute();
				$txt .= "\nIf there's a problem with your order, show this receipt to a member of the student council.";
				send_email($to, "CouncilTrack - Email Receipt", $txt);
				
				$conn->close();
				header("Location: main.php");
				wrong:
				echo "<p class=\"h3 text-center\"> Something went wrong... </p>";
				try_again("submit.php");
			}
		?>
	</div>	
</body>
</html>