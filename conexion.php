<?php
$host = "localhost";
$username = "root";
$password = "";
$db = "foro";

$con = mysqli_connect($host, $username, $password) or die(mysqli_error());
mysqli_select_db($con, $db);
?>