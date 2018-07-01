<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> CouncilTrack </title>
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="icon" type="image/x-icon" href="data/favicon.ico">
	<script type="text/javascript">
		function change_items() {
			document.getElementById('items').innerHTML = '';
			for (var i = 0; i < document.getElementById('t_num').value; i++) {
				tname = 'template_item' + i;
				tprice = 'template_price' + i;
				document.getElementById('items').innerHTML += '<tr> <td> <input type\'text\' class=\'form-control\' name=\'' + tname + '\' maxlength=\'128\'> </td> <td> <input type=\'number\' class=\'form-control\' name=\'' + tprice + '\' min=\'1\' max=\'100\'> </td> </tr>'
			}
		}
	</script>
</head>
<body>
	<h1> Council Track </h1>
	<hr style="height: 5px; background-color: #333;">
	<?php if(isset($_SESSION['username'])) : ?>
		<?php if($_SESSION['level'] <= 2) : ?>
			<h2> Make a Transaction </h2>
		<?php endif; ?>
		<?php if($_SESSION['level'] <= 1) : ?>
			<hr style="height: 2px; background-color: #333;">
			<h2> Sales and Information</h2>
			<hr style="height: 2px; background-color: #333;">
			<h4> Create a New Template: </h4>
			<form action="new_template.php" method="post" accept-charset="utf-8">
				<div class="form-group">
					<label for="template_name"> Name: </label>
					<input type="text" class="form-control" name="template_name" maxlength="128">
				</div>
				<div class="form-group">
					<label for="template_num"> Number of Items: </label>
					<input id="t_num" type="number" class="form-control" name="template_num" min="1" max="20" oninput="change_items()">
				</div>
				<table class="table table-hover">
					<thead>
						<tr>
							<th> Item Name </th>
							<th> Price (Leva) </th>
							<th> </th>
						</tr>
					</thead>
					<tbody id="items">
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary"> Create </button>
			</form>
			<hr>
			<h4> View Data </h4>
		<?php endif; ?>
		<?php if($_SESSION['level'] == 0) : ?>
			<hr style="height: 2px; background-color: #333;">
			<h2> User Management </h2>
			<hr style="height: 2px; background-color: #333;">
			<h4> Create a New User: </h4>
			<form action="new_user.php" method="post" accept-charset="utf-8">
				<div class="form-group">
					<label for="new_username"> Username: </label>
					<input type="text" class="form-control" name="new_username" maxlength="128">
				</div>
				<div class="form-group">
					<label for="new_password"> Password: &nbsp; </label>
					<input type="password" class="form-control" name="new_password" maxlength="128">
				</div>
				<div class="form-check">
					<input type="checkbox" class="form-check-input" name="new_admin" value="yes">
					<label class="form-check-label" for="new_admin"> Admin </label>
				</div>
				<br>
				<button type="submit" class="btn btn-primary"> Create </button>
			</form>
			<hr>
			<h4> Delete a Existing User: </h4>
			<table class="table table-hover">
				<thead>
					<tr>
						<th> Username </th>
						<th> Admin </th>
						<th> </th>
					</tr>
				</thead>
				<tbody>
					<?php
						include "connect.php";

						$conn = connect();
						$stmt = $conn->prepare("SELECT id, username, level from users WHERE level > 0");
						$stmt->execute();
						$stmt->bind_result($id, $username, $level);
						while($stmt->fetch()) {
							$admin = ($level < 2) ? "Yes" : "No";
							$delete = "<button name=\"delete\" class=\"btn btn-danger\" onclick=\"if(confirm('Really?')) { var http = new XMLHttpRequest(); http.open('POST', 'delete_user.php', true); http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); http.send('delete=$id'); location.reload();} \"> Delete </button>";
							echo "<tr> <td> $username </td> <td> $admin </td> <td> $delete </td> </tr>";
						}
					?>
				</tbody>
			</table>
		<?php endif; ?>
		<hr>
			<form action="logout.php" method="post" accept-charset="utf-8">
			<button type="submit" class="btn btn-warning"> Log Out </button>
		</form>
	<?php else : ?>
		<h4> Login </h4>
		<form action="login.php" method="post" accept-charset="utf-8">
			<div class="form-group">
				<label for="username"> Username: </label>
				<input type="text" class="form-control" name="username" maxlenght="128">
			</div>
			<div class="form-group">
				<label for="password"> Password:&nbsp; </label>
				<input type="password" class="form-control" name="password" maxlength="128">
			</div>
			<button type="submit" class="btn btn-primary"> Log In </button>
		</form>
	<?php endif; ?>
</body>
</html>