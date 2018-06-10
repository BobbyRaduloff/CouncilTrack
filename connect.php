<?php 
	$db_servername = "localhost";
	$db_username = "root";
	$db_password = "password";
	$db_name = "counciltrack";

	function connect() {
		$conn = new mysqli("localhost", "root", "password", "counciltrack");
		if($conn->connect_error) {
			die("<h3> Connection failed! </h3>");
		}

		return $conn;
	}
?>