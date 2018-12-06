<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Add Event </title>
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

			check_level(2);
		?>
		<form id="add-event-form" class="form-ct" action="add_event_db.php" method="post" accept-charset="utf-8">
			<p class="h2 text-center form-heading"> Add event </p>
			<div class="form-group row">
				<label for="name" class="col-sm-2 col-form-label"> Name: </label>
				<div class="col-sm-10">
					<input type="text" name="name" class="form-control" placeholder="Name">
				</div>
			</div>
			<div id="add-here"></div>
			<div class="form-group row">
				<label for="add" class="col col-form-label"> Add an item: </label>
				<div class="col">
					<button type="button" class="btn btn-success" onclick="add_item();"> + </button>
				</div>
			</div>
			<div class="form-group row">
				<div class="col">
					<div class="form-check">
						<input type="checkbox" name="same" class="form-check-input" id="same" value="Yes">
						<label class="form-check-label" for="same"> The buyer is also the recepient </label>
					</div>
				</div>
			</div>
			<button class="btn btn-lg btn-primary btn-block btn-final" type="submit"> Finalize </button>
			<input id="i" type="hidden" name="i">
		</form>
		<?php include "back.html"; ?>
		<?php include "footer.html"; ?>
	</div>
</body>
</html>