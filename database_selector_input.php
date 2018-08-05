<DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> Event Selector  </title>
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="styles/style.css">
		<style type = "text/css">
			#input_button {
			height: 2cm; width: 70%;
			font-size: 24px;
			position: relative; top: 50px; left: 70px;
			}
			.message {
			position: relative; top: 100px;
			font-size: 22px;
			}
			#content {
			position: relative; top: 20px;
			}
			p {
			font-size: 24px;
			}
			h2 {
			text-align: center;
			}
			select {
			width: 100%; height: 1cm;
			}
			#selector{
			height: 40px;
			font-size:24px;
			}
		</style>
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
				<button id = "input_button" name = "input_event"> Input In Event </button>
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
