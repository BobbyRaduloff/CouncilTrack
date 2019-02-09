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
			check_level(3);
			if(isset($_POST["id"]) && isset($_POST["event"])) {
				$conn = db_connect();
				$stmt = $conn->prepare("UPDATE table${_POST["event"]} SET delivered = 1 WHERE id = ?");
				$stmt->bind_param("i", intval($_POST["id"]));
				$stmt->execute();
				$stmt = $conn->prepare("SELECT recepient, r_email, name, anonymous, message FROM table${_POST["event"]} WHERE id = ?");
				$stmt->bind_param("i", intval($_POST["id"]));
				$stmt->execute();
				$stmt->bind_result($r_name, $r_email, $name, $anon, $message);
				$stmt->fetch();
				$stmt->close();
				$stmt = $conn->prepare("SELECT items FROM tables WHERE id = ?");
				$stmt->bind_param("i", intval($_POST["event"]));
				$stmt->execute();
				$stmt->bind_result($item_list);
				$stmt->fetch();
				$stmt->close();
				$item_array = explode(",", $item_list);
				$items = array();
				for($i = 0; $i < count($item_array); $i++) {
					$stmt = $conn->prepare("SELECT name FROM items WHERE id = ?");
					$stmt->bind_param("i", $item_array[$i]);
					$stmt->execute();
					$stmt->bind_result($iname);
					$stmt->fetch();
					$items[$i] = $iname;
					$stmt->close();
				}
				$txt = "Dear ${r_name},\nYou have recieved the following from Student Council:\n";
				for($i = 0; $i < count($item_array); $i++) {
					$stmt = $conn->prepare("SELECT item" . $i . " FROM table" . $_POST["event"] . " WHERE id = ?");
					$stmt->bind_param("i", $_POST["id"]);
					$stmt->execute();
					$stmt->bind_result($sale);
					$stmt->fetch();
					if($sale) {
						$txt .= $iname . " x " . strval($sale) . "\n";
					}
					$stmt->close();
				}
				$txt .= "\nHere's the note attached:\n";
				$txt .= $message;
				if(intval($anon)) {
					$txt .= "\nby Anonymous";
				} else {
					$txt .= "\nby ${name}";
				}
				$txt .= "\n\nIf this receipt is innacurate in regards to what you physically recieved, show it to a member of the Student Council.";
				$conn->close();
				send_email($r_email, "Council Track - Delviery", $txt);
			} else {
				echo "What are you doing???";
			}
			include "footer.html"; ?>
	</div>
</body>
</html>