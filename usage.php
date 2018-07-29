<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> Usage </title>

  <link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="styles/style.css">

  <!-- Temporary positioning until bootstrap !-->
  <!-- Needs code witch which you doesn't allow you to enter this webpage without permission !-->

  <style>

button {
  height: 6cm; width: 100%;
  border: none; color: #013220;
}

#input_button {
  position: relative; top: 100px; right: 350px;
  font-size: 36px; color: white; background-color: #013220; letter-spacing: 6px; font-family: verdana;
}

#input_button:active {
  background-color: #001F13;
}

#input_button:focus {
  background-color: #001F13;
}
#output_button {
  position: relative; bottom: 130px; left: 380px;
  font-size: 36px; color: white; background-color: #8b0000;
  letter-spacing: 6px; font-family: verdana;
}

#output_button:active {
  background-color: #580000;
}

#output_button:focus {
  background-color: #580000;
}

#back_button {
  font-size: 72px;
}

#back_button:active {
  background-color: lightgray;
}

h1 {
  text-align: center;
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

<div class = "interface">

<form method="POST">
<button id = "input_button" name = "input">  Input Information </button>
<button id = "output_button"  name="output"> Output Of Databases </button>
<button id = "back_button"  name="back"> Back</button>
</form>

</div>

<?php

if(isset($_POST['input'])) {
  header("Location:database_selector_input.php");
}

if(isset($_POST['output'])) {
  header("Location:database_selector_output.php");
}

if(isset($_POST['back'])) {
  header("Location:index.php");
}
 ?>

</body>

</html>
