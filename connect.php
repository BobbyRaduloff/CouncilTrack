<?php 
	function connect() {
		$db_servername = "localhost";
		$db_username = "root";
		$db_password = "";
		$db_name = "counciltrack";
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
		if($conn->connect_error) {
			die("<h3> Connection failed! </h3>");
		}

		return $conn;
	}

	function check($level) {
		if($_SESSION['level'] > $level) {
			die("<h3> You don't have the correct permissions! </h3>");
		}
	}

	function again() {
		die("<input type=\"submit\" class=\"btn btn-primary\" value=\"Try Again\" onclick=\"window.location='index.php';\">");
	}
?>