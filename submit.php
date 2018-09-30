<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Submit </title>
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

			check_level(1);
		?>
		<form id="submit-event-form" class="form-ct" action="submit_event.php" method="post" accept-charset="utf-8">
			<p class="h2 text-center form-heading"> Submit Event </p>
			<label for="id"> Event: </label>
			<select class="selector" name="id" form="submit-event-form">
				<?php 
					$conn = db_connect();
					$stmt = $conn->prepare("SELECT same, name, id FROM tables WHERE 1");
					if(!$stmt) {
						echo "<p class=\"h3 text-center\"> Something went wrong. </p>";
						try_again("submit.php");
					}
					$stmt->execute();
					$stmt->bind_result($same, $name, $id);
					
					while($stmt->fetch()) {
						echo "<option value=\"$id\"> $name </option>";
					}

					$stmt->close();
					$conn->close();
				?>
			</select>
			<button class="btn btn-lg btn-primary btn-block btn-final" type="submit"> Next </button>
		</form>
		<?php include "back.html"; ?>
		<?php include "footer.html"; ?>
	</div>	
</body>
</html>