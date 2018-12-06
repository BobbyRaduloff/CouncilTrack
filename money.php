<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Money </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
	<link rel="stylesheet" type="text/css" href="style/view_event.css">
	<script type="text/javascript" src="js/money.js"></script>
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			include "header.html";
			include "back.html";
			include "utils.php";

			function wrong() {
				echo "<p class=\"h3 text-center\"> Something went wrong. </p>";
				try_again("money.php");
			}

			session_start();
			check_level(2);
		?>
		<div class="row">
			<div class="col mx-auto">
				<p class="h3 text-center pt-4"> Balance Tables </p>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-striped">
				<thead class="thead-dark">
					<tr>
						<th scope="col"> # </th>
						<th scope="col"> Name </th>
						<th scope="col"> Balance </th>
						<th scope="col"> Delivered </th>
					</tr>
				</thead>
				<tbody>
					<?php
						$conn = db_connect();
						$stmt = $conn->prepare("SELECT id, name, balance FROM users WHERE 1");
						if(!$stmt) {
							wrong();
						}
						$stmt->execute();
						$stmt->bind_result($id, $name, $balance);
						$i = 0;
						while($stmt->fetch()) {
							echo "<tr>";
							echo "<th scope=\"row\"> ${i} </th>";
							echo "<td> ${name} </td>";
							echo "<td> ${balance} </td>";
							if($balance > 0) {
								echo "<td id=\"delivery" . $id . "\">";
								echo "<button class=\"btn btn-success\" onclick=\"deliver(${id})\"> Deliver </button>";
								echo "</td>"; 
							} else {
								echo "<td> Nothing owed! </td>";
							}
							echo "</tr>";
							$i++;
						}
					?>
				</tbody>
			</table>			
		</div>
	</div>	
</body>
</html>