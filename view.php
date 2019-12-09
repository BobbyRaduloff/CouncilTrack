<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: View </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
	<script type="text/javascript" src="js/view.js"></script>
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			session_start();
			include "header.html";
			include "utils.php";

			check_level(3);
			$conn = db_connect();
			$GLOBALS["has"] = check_empty($conn, "tables");
			if(!$GLOBALS["has"]) {
				echo "<p class=\"h3 text-center\"> There are no events. </p>";
			}
			$conn->close();
		?>
		<?php if($GLOBALS["has"]) : ?>
		<form id="view-event-form" class="form-ct" action="view_event.php" method="post" accept-charset="utf-8">
			<p class="h2 text-center form-heading"> View Event </p>
			<label for="id"> Event: </label>
			<select class="selector" name="id" form="view-event-form">
				<?php 
					$conn = db_connect();
					$stmt = $conn->prepare("SELECT name, id FROM tables WHERE 1");
					if(!$stmt) {
						echo "<p class=\"h3 text-center\"> Something went wrong. </p>";
						try_again("view.php");
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
			<button class="btn btn-lg btn-primary btn-block btn-final" type="submit"> Output </button>
		</form>
		<?php endif; ?>
		<?php if($_SESSION["level"] < 3) : ?>
				<form id="view-money-form" class="form-ct" action="money.php" method="post" accept-charset="utf-8">
				<hr>
				<p class="h2 text-center form-heading" style="margin: 20px;"> View Money </p>
				<label for="id"> Event: </label>
				<select class="selector" name="id" form="view-money-form">
					<?php 
						$conn = db_connect();
						$stmt = $conn->prepare("SELECT name, id FROM tables WHERE 1");
						if(!$stmt) {
							echo "<p class=\"h3 text-center\"> Something went wrong. </p>";
							try_again("view.php");
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
				<button class="btn btn-lg btn-primary btn-block btn-final" value="money" name="what"> Money </button>
				</form>
		<?php endif; ?>
		<?php include "back.html"; ?>
		<?php include "footer.html"; ?>
	</div>
</body>
</html>