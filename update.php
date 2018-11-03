<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Update </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			session_start();
			include "header.html";
			include "utils.php";
			check_level(0);
			$output = array();
			$code = 0;
			exec("git pull 2>&1", $output, $code);
			if($code == 0) {
				echo "<p class=\"h3 text-center\"> Update successful. </p>";
			} else {
				echo "<p class=\"h3 text-center\"> Error (${code}): </p>";
				for($i = 0; $i < count($output); $i++) {
					echo "<p class=\"text-center\"> ${output[$i]} </p>";
				}
			}
			include "back.html";
			include "footer.html";
		?>
	</div>
</body>
</html>