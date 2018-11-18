<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: View </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
	<link rel="stylesheet" type="text/css" href="style/view_event.css">
	<script type="text/javascript" src="js/view_event.js"></script>
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			include "header.html";
			include "back.html";
			include "utils.php";

			function wrong() {
				echo "<p class=\"h3 text-center\"> Something went wrong. </p>";
				try_again("view.php");
			}

			session_start();
			check_level(3);

			if(empty($_POST["id"])) {
				echo "<p class=\"h3 text-center\"> No event selected. </p>";
				try_again("view.php");
			} else {
				$conn = db_connect();
				$stmt = $conn->prepare("SELECT name, i, same, items FROM tables where id = ?");
				$stmt->bind_param("i", $_POST["id"]);
				$stmt->execute();
				$stmt->bind_result($event_name, $count, $same, $items);
				$stmt->fetch();
				echo "<div class=\"row\"> <div class=\"col mx-auto\"> <p class=\"h3 text-center pt-4\"> ${event_name} </p> </div> </div>";
				echo <<< EOF

<form class="form-ct" action="view_event.php" method="post" accept-charset="utf-8">
	<div class="row">
		<label for="query" class="col-sm-2"> Search: </label>
		<div class="col-sm-7">
			<input type="text" name="query" id="query" class="form-control">
		</div>
		<div class="col-sm-3">
			<input type="submit" name="submit" id="submit" class="btn btn-primary form-control" value="Search">
		</div>
		<input type="hidden" name="id" value="${_POST["id"]}">
	</div>
</form>
EOF;
				$raw_item_array = explode(",", $items);
				$item_array = array();
				$same = intval($same);
				$stmt->close();
				echo "<div class=\"table-responsive\"> <table class=\"table table-striped\" id=\"data\"> <thead class=\"thead-dark\">";
				echo "<tr> <th scope=\"col\"> # </th>";
				echo "<th scope=\"col\"> Buyer Name </th>";
				echo "<th scope=\"col\"> Buyer Section </th>";
				if($same == 0) {
					echo "<th scope=\"col\"> Recepient Name </th>";
					echo "<th scope=\"col\"> Recepient Section </th>";
				}
				for($i = 0; $i < $count; $i++) {
					$stmt = $conn->prepare("SELECT name, price FROM items WHERE id = ?");
					if(!$stmt) {
						wrong();
					}
					$stmt->bind_param("i", $raw_item_array[$i]);
					$stmt->execute();
					$stmt->bind_result($iname, $iprice);
					$stmt->fetch();
					$item_array[$i] = array($iname, $iprice);
					echo "<th scope=\"col\"> ${iname}, ${iprice}lv. </th>";
					$stmt->close();
				}
				echo "<th scope=\"col\"> Total </th>";
				echo "<th scope=\"col\"> Delivered </th>";
				echo "</tr> <tbody>";
				$stmt_string = "SELECT id, delivered, name, grade, section, ";
				if($same == 0) {
					$stmt_string .= "recepient, r_grade, r_section, ";
				}
				for($i = 0; $i < $count; $i++) {
					$stmt_string .= "item".(string)$i;
					if($i < $count - 1) {
						$stmt_string .= ", ";
					}
				}
				if(isset($_POST["query"])) {
					if(!intval($same)) {
						$stmt_string .= " FROM table${_POST["id"]} WHERE name LIKE LOWER(?) OR recepient LIKE LOWER(?) OR grade LIKE LOWER(?) OR r_grade LIKE LOWER(?) OR CONCAT(CONCAT(grade, \"/\"), section) LIKE LOWER(?) OR CONCAT(CONCAT(r_grade, \"/\"),  r_section) LIKE LOWER(?)";
					} else {
						$stmt_string .= " FROM table${_POST["id"]} WHERE name LIKE LOWER(?) OR grade LIKE LOWER(?) OR CONCAT(CONCAT(grade, \"/\"), section) LIKE LOWER(?)";
					}
					
				} else {
					$stmt_string .= " FROM table${_POST["id"]} where 1";
				}
				$stmt = $conn->prepare($stmt_string);
				if(!$stmt) {
					echo $stmt_string;
					wrong();
				}
				if(isset($_POST["query"])) {
					$query = "%" . $_POST["query"] . "%";
					if(!intval($same)) {
						$stmt->bind_param("ssssss", $query, $query, $query, $query, $query, $query);
					} else {
						$stmt->bind_param("sss", $query, $query, $query);
					}
				}
				$stmt->execute();
				$i = 1;
				$meta = $stmt->result_metadata();
				$names = array();
				while ($field = $meta->fetch_field()) {
					${$field->name} = 0;
					$names[] = $field->name;
				    $params[] = &${$field->name}; 
				}
				$result = array();
				call_user_func_array(array($stmt, 'bind_result'), $params);
				$i = 0;
				while ($stmt->fetch()) { 
						for($j = 0; $j < count($names); $j++) {
							$result[$i][$names[$j]] = $params[$j];
						}
						$i++;
				}
				$totals = array();
				for($i = 0; $i < $count; $i++) {
					$totals[$i] = array(0.0, 0);
				}
				$max_total = 0.0;
				if(!isset($result)) {
					$result = array();
				}

				for($i = 0; $i < count($result); $i++) {
					$total = 0.0;
					echo "<tr>";
					echo "<th scope=\"row\"> ${i} </th>";
					echo "<td> " . ($result[$i])["name"] ." </td>";
					echo "<td> " . ($result[$i])["grade"] . "/" . ($result[$i])["section"] . " </td>";
					if($same == 0) {
						echo "<td> " . ($result[$i])["recepient"] . " </td>";
						echo "<td> " . ($result[$i])["r_grade"] . "/" . ($result[$i])["r_section"] . " </td>";
					}
					for($j = 0; $j < $count; $j++) {
						($totals[$j])[0] += ($item_array[$j])[1] * ($result[$i])["item".(string)$j];
						($totals[$j])[1] += ($result[$i])["item".(string)$j];
						echo "<td> " . ($result[$i])["item".(string)$j] . " </td>";
						$total += ($item_array[$j])[1] * ($result[$i])["item".(string)$j]; 
					}
					$max_total += $total;
					echo "<td> ${total}lv. </td>";
					echo ((($result[$i])["delivered"]) ? "<td> Yes </td>" : "<td id=\"" . "delivery" . ($result[$i])["id"]. "\"> No <button class=\"btn btn-success\" onclick=\"deliver(" . ($result[$i])["id"] . "," . $_POST["id"] . ")\"> Deliver </button></td>");
					echo "</tr>";
				}
				echo "<tr> <td> </td> <td> </td> <td> </td>";
				if($same == 0) {
					echo "<td> </td> <td> </td>";
				}
				for($i = 0; $i < $count; $i++) {
					echo "<td> Total (" . ($item_array[$i])[0] . "): " . ($totals[$i])[1]. " / " . ($totals[$i])[0] . "lv. </td>";
				}
				echo "<td> Total: ${max_total}lv. </td> <td> </td> </tr>";
				echo "</tbody>";
				$stmt->close();
				$conn->close();
			}
			?>			
		</div>
	</div>	
</body>
</html>