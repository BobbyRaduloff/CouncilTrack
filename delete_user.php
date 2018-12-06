<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Delete User </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			session_start();
			include "header.html";
			include "utils.php";

			check_level(1);
			$conn = db_connect();
			$GLOBALS["has"] = check_empty($conn, "users") - 1;
			if($GLOBALS["has"] < 2) {
				echo "<p class=\"h3 text-center\"> There are no users. </p>";
			}
			$conn->close();
		?>
		<?php if($GLOBALS["has"] >= 1) : ?>
		<form id="delete-user-form" class="form-ct" action="delete_user_db.php" method="post" accept-charset="utf-8">
			<p class="h2 text-center form-heading"> Delete user </p>
			<label for="id"> Username: </label>
			<select class="selector" name="id" form="delete-user-form">
				<?php 
					$conn = db_connect();
					$stmt = $conn->prepare("SELECT username, id FROM users WHERE 1");
					if(!$stmt) {
						echo "<p class=\"h3 text-center\"> Something went wrong. </p>";
						try_again("delete_user.php");
					}
					$stmt->execute();
					$stmt->bind_result($username, $id);
					
					while($stmt->fetch()) {
						if($username != $_SESSION["username"]) {
							echo "<option value=\"$id\"> $username </option>";
						}
					}

					$stmt->close();
					$conn->close();
				?>
			</select>
			<button class="btn btn-lg btn-danger btn-block btn-final" type="submit"> Finalize </button>
		</form>
		<?php endif; ?>
		<?php include "back.html"; ?>
		<?php include "footer.html"; ?>
	</div>	
</body>
</html>