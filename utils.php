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

	function check_empty($conn, $table) {
		$stmt = $conn->prepare("SELECT * FROM " . $table . " WHERE 1");
		if(!$stmt) {
			echo("<p class=\"h3 text-center\"> Something went very wrong. </p>");
		}
		$stmt->execute();
		$stmt->store_result();
		$ret = $stmt->num_rows();
		$stmt->free_result();
		$stmt->close();
		return $ret;
	}

	function try_again($where) {
		die("<button type=\"submit\" class=\"btn btn-lg btn-primary btn-block\" onclick=\"window.location='$where';\"> Try Again </button>");
	}

	function check_level($level) {
		if(!isset($_SESSION['level']) || $_SESSION['level'] > $level) {
			echo "<p class=\"h3 text-center\"> You don't have the correct premission level or you are not logged in. </p>";
				try_again("index.php");
		}

	}

	function email_gen($name, $grade) {	
		$names = explode(" ", strtolower($name));
		$semester = (intval(date("m")) < 9) ? 1 : 0;
		$year = intval(date("y")) + 5 - (intval($grade) - 8 + $semester);
		$to = ($names[0])[0] . "." . $names[1] . $year . "@acsbg.org";
		return $to;
	}
?>