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

			check_level(2);

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
				$stmt_string = "INSERT INTO table".$_POST["id"] . "(grade, section, name, ";
				if(intval($_POST["same"]) == 0) {
					$stmt_string .= "r_grade, r_section, recepient, ";
				}
				for($i = 0; $i < $count; $i++) {
					$stmt_string .= "item".(string)$i;
					if($i < $count - 1) {
						$stmt_string .= " ,";
					}
				}
				$stmt_string .= ") VALUES (?, ?, ?, ";
				if(intval($_POST["same"]) == 0) {
					$stmt_string .= "?, ?, ?, ";
				}
				for($i = 0; $i < $count; $i++) {
					$stmt_string .= "?";
					if($i < $count - 1) {
						$stmt_string .= " ,";
					}
				}
				$stmt_string .= ")";
				echo $stmt_string;
				$stmt = $conn->prepare($stmt_string);
				if(!$stmt) {
					goto wrong;
				}
				$param_array = array(((intval($_POST["same"]) == 0) ? "iisiis" : "iis") . str_repeat("i", $count), $_POST["grade"], $_POST["section"], $_POST["name"]);
				if(intval($_POST["same"]) == 0) {
					array_push($param_array, $_POST["r_grade"], $_POST["r_section"], $_POST["r_name"]);
				}
				for($i = 0; $i < $count; $i++) {
					array_push($param_array, $_POST["item".(string)$i]);
				}
				call_user_func_array(array($stmt, "bind_param"), $param_array);
				$stmt->execute();
				$stmt->close();
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