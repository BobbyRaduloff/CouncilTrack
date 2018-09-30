<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Delete Event </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			session_start();
			include "header.html";
			include "utils.php";

			check_level(2);
		?>
		<form id="delete-event-form" class="form-ct" action="delete_event_db.php" method="post" accept-charset="utf-8">
			<p class="h2 text-center form-heading"> Delete Event </p>
			<label for="id"> Event: </label>
			<select class="selector" name="id" form="delete-event-form">
				<?php 
					$conn = db_connect();
					$stmt = $conn->prepare("SELECT name, id FROM tables WHERE 1");
					if(!$stmt) {
						echo "<p class=\"h3 text-center\"> Something went wrong. </p>";
						try_again("delete_event.php");
					}
					$stmt->execute();
					$stmt->bind_result($name, $id);
					
					while($stmt->fetch()) {
						echo "<option value=\"$id\"> $name </option>";
					}

					$stmt->close();
					$conn->close();
				?>
			</select>
			<button class="btn btn-lg btn-danger btn-block btn-final" type="submit"> Next </button>
		</form>
		<?php include "back.html"; ?>
		<?php include "footer.html"; ?>
	</div>	
</body>
</html>