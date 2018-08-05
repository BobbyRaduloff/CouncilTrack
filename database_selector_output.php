<DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Event Selector  </title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<!-- Temporary positioning until bootstrap !-->
		<!-- Needs code witch which you doesn't allow you to enter this webpage without permission !-->
		<link rel="stylesheet" type="text/css" href="styles/database_selector_style.css">
	</head>
	<body>
		<?php
			include('default_header.html');
			include('connect.php');

			connect();
			session_start();
			?>
		<div id = "content">
			<h2>Select an event:</h2>
			<form method = "POST">
				<select name = "events">
					<option value = "none"> </value>
						<?php
							include('database_selector.php');
							?>
				</select>
				<button class = "btn btn-primary" id = "action_button" name = "view_event"> View Event </button>
			</form>
			<br>
			<p class = "message"> Note: The correct way to adress events is "EventName_Year". </p>
		</div>
		<?php
			$selected_event;

			if(isset($_POST['view_event']) && $_POST['events'] != "none") {
			  $selected_event = $_POST['events'];
			  header("Location: base_output.php");
			}
			 ?>
	</body>
</html>
