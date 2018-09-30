<?php
	function db_connect() {
		$db_servername = "localhost";
		$db_username = "root";
		$db_password = "";
		$db_name = "counciltrack";
		$conn = new mysqli($db_servername, $db_username, $db_password, $db_name);
		if($conn->connect_error) {
			die("<p class=\"h3 text-center\"> Connection failed! </p>");
		}

		return $conn;
	}

	function try_again($where) {
		die("<button type=\"submit\" class=\"btn btn-lg btn-primary btn-block\" onclick=\"window.location='$where';\"> Try Again </button>");
	}

	function check_level($level) {
		if(empty($_SESSION['level']) || $_SESSION['level'] > $level) {
			echo "<p class=\"h3 text-center\"> You don't have the correct premission level or you are not logged in. </p>";
				try_again("index.php");
		}

	}
?>