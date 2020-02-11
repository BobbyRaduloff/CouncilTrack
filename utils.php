<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer/Exception.php';
	require 'PHPMailer/PHPMailer.php';
	require 'PHPMailer/SMTP.php';

	function db_connect() {
		$ini = parse_ini_file("config.ini");
		$db_servername = $ini["location"];
		$db_username = $ini["user"];
		$db_password = $ini["pass"];
		$db_name = $ini["database"];
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

	function staff_email_gen($name) {	
		$names = explode(" ", strtolower($name));
		$to = ($names[0])[0] . "." . $names[1] . "@acsbg.org";
		return $to;
	}

	function send_email($email, $subject, $txt) {
		$ini = parse_ini_file("config.ini");
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->SMTPSecure = "tls";
		$mail->SMTPAuth = true;
		$mail->Username = $ini["email"];
		$mail->Password = $ini["epassword"];
		$mail->setFrom($ini["email"], "CouncilTrack");
		$mail->addAddress($email, "");
		$mail->Subject = $subject;
		$mail->Body = $txt;
		var_dump($mail->send());
	}
?>