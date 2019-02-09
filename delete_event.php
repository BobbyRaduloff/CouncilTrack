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
			$conn = db_connect();
			$GLOBALS["has"] = check_empty($conn, "tables");
			if(!$GLOBALS["has"]) {
				echo("<p class=\"h3 text-center\"> There are no events. </p>");
				include "back.html";
				die();
			}
			$stmt = $conn->prepare("SELECT * FROM tables WHERE locked = 1");
			$stmt->execute();
			$stmt->store_result();
			$GLOBALS["locked"] = ($stmt->num_rows > 0);
			$stmt->close();
			$stmt = $conn->prepare("SELECT * FROM tables WHERE locked = 0");
			$stmt->execute();
			$stmt->store_result();
			$GLOBALS["unlocked"] = ($stmt->num_rows > 0);
			$stmt->close();
			$conn->close();
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
			<button class="btn btn-lg btn-danger btn-block btn-final" type="submit"> Delete </button>
		</form>
		<?php if($GLOBALS["unlocked"]): ?>
			<hr>
			<form id="lock-event-form" class="form-ct" action="lock_event.php" method="post" accept-charset="utf-8">
				<p class="h2 text-center form-heading"> Lock Event </p>
				<label for="id"> Event: </label>
				<select class="selector" name="id" form="lock-event-form">
					<?php 
						$conn = db_connect();
						$stmt = $conn->prepare("SELECT name, id FROM tables WHERE locked = 0");
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
				<button class="btn btn-lg btn-danger btn-block btn-final" type="submit"> Lock </button>
			</form>
		<?php endif; ?>
		<?php if($GLOBALS["locked"]): ?>
			<hr>
			<form id="unlock-event-form" class="form-ct" action="unlock_event.php" method="post" accept-charset="utf-8">
				<p class="h2 text-center form-heading"> Unlock Event </p>
				<label for="id"> Event: </label>
				<select class="selector" name="id" form="unlock-event-form">
					<?php 
						$conn = db_connect();
						$stmt = $conn->prepare("SELECT name, id FROM tables WHERE locked = 1");
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
				<button class="btn btn-lg btn-success btn-block btn-final" type="submit"> Unlock </button>
			</form>
		<?php endif; ?>
		<?php include "back.html"; ?>
		<?php include "footer.html"; ?>
	</div>	
</body>
</html>