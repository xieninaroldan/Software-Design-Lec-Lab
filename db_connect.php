<?php
$username = "root";
$password = "";
$server   = "localhost";
$dbasename = "zion_db";

$connection = mysqli_connect($server, $username, $password);
mysqli_select_db($connection, $dbasename);
?>