<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack: Submit </title>
	<link rel="stylesheet" type="text/css" href="style/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/global.css">
	<script type="text/javascript" src="js/submit_event.js"></script>
</head>
<body class="mx-auto">
	<div class="container">
		<?php
			include "header.html";
			include "utils.php";

			session_start();
			check_level(1);
			if(empty($_POST["id"])) {
				echo "<p class=\"h3 text-center\"> Please, pick an event! </p>";
				try_again("submit.php");
			}

			$conn = db_connect();
			$stmt = $conn->prepare("SELECT same, name FROM tables WHERE id = ?");
			if(!$stmt) {
				wrong();
			}
			$stmt->bind_param("i", $_POST["id"]);
			$stmt->execute();
			$stmt->bind_result($GLOBALS["same"], $GLOBALS["name"]);
			$stmt->fetch();
		?>
		<form id="submit-event-form" class="form-ct" action="submit_event_db.php" method="post" accept-charset="utf-8">
			<p class="h2 text-center form-heading"> Submit: <?php echo $GLOBALS["name"]; ?> </p>
			<div class="form-group row">
				<label for="name" class="col-2 col-form-label"> Name: </label>
				<div class="col-10">
					<input type="text" name="name" class="form-control" placeholder="Name">
				</div>
			</div>
			<div class="form-group row">
				<label for="name" class="col-2 col-form-label"> Grade: </label>
				<div class="col-3">
					<input type="number" name="grade" class="form-control" placeholder="8" min="8" max="12" step="1">
				</div>
				<div class="col-1">
					<p class="h4 text-center"> / </p>
				</div>
				<div class="col-3">
					<input type="number" name="section" class="form-control" placeholder="1" min="1" max="10" step="1">
				</div>
			</div>
			<?php if($same == 0) : ?>
				<div class="form-group row">
				<label for="name" class="col-3 col-form-label"> Recepient Name: </label>
				<div class="col-9">
					<input type="text" name="r_name" class="form-control" placeholder="Name">
				</div>
			</div>
			<div class="form-group row">
				<label for="name" class="col-3 col-form-label"> Recepient Grade: </label>
				<div class="col-3">
					<input type="number" name="r_grade" class="form-control" placeholder="8" min="8" max="12" step="1">
				</div>
				<div class="col-1">
					<p class="h4 text-center"> / </p>
				</div>
				<div class="col-3">
					<input type="number" name="r_section" class="form-control" placeholder="1" min="1" max="10" step="1">
				</div>
			</div>
			<?php endif; ?>
			<?php
				function wrong() {
					echo "<p class=\"h3 text-center\"> Something went wrong. </p>";
					try_again("submit_event.php");
				}

				$conn = db_connect();
				$stmt = $conn->prepare("SELECT items from tables where id = ?");
				if(!$stmt) {
					wrong();
				}
				$stmt->bind_param("i", intval($_POST["id"]));
				$stmt->execute();
				$stmt->bind_result($items);
				$stmt->fetch();
				$item_array = explode(",", $items);
				$stmt->close();
				for($i = 0; $i < count($item_array); $i++) {
					$stmt = $conn->prepare("SELECT name, price FROM items where id = ?");
					if(!$stmt) {
						wrong();
					}
					$stmt->bind_param("i", intval($item_array[$i]));
					$stmt->execute();
					$stmt->bind_result($name, $price);
					$stmt->fetch();
					echo "<div class=\"form-group row\">";
					echo "<label for=\"item${i}\" class=\"col-4 col-form-label\"> ${name} </label>";
					echo "<div class=\"col-3\">";
					echo "<input type=\"number\" id=\"item${i}\" name=\"item${i}\" class=\"form-control\" placeholder=\"0\" step=\"1\" min=\"0\" onchange=\"calculatePrice('item${i}', ${price})\" onload=\"calculatePrice('item${i}', ${price})\">";
					echo "</div>";
					echo "<div class=\"col-3\">";
					echo "<p class=\"text-center\"> x ${price}lv. = </p>";
					echo "</div>";
					echo "<div class=\"col-2\">";
					echo "<p class=\"text-center\" id=\"item${i}f\">  </p>";
					echo "</div>";
					echo "</div>";
					$stmt->close();
				}
			?>

			<button class="btn btn-lg btn-primary btn-block btn-final" type="submit"> Next </button>
			<input id="i" type="hidden" name="i" value="<?php echo count($item_array) ?>">
			<input id="same" type="hidden" name="same" value="<?php echo $GLOBALS["same"] ?>">
			<input id="id" type="hidden" name="id" value="<?php echo $_POST["id"] ?>">
		</form>
		<?php include "back.html"; ?>
	</div>	
</body>
</html>