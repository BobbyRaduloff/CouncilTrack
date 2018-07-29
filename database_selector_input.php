<DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Event Selector  </title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
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
				<select id = "selector" name = "events">
					<option value = "none"> </value>
						<?php
							include('database_selector.php');
							?>
				</select>
				<button id = "action_button" name = "input_event"> Input In Event </button>
			</form>
			<br>
			<p class = "message"> Note: The correct way to adress events is "EventName_Year". </p>
		</div>
		<?php
			$selected_event;

			if(isset($_POST['input_event']) && $_POST['events'] != "none") {
			  $selected_event = $_POST['events'];
			  header("Location: base_input.php");
			}
			 ?>
	</body>
</html>
