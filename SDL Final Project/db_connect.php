<?php
$servername = "localhost"; // Replace with your server name or IP address
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "zion_db"; // Replace with your database name

// Create connection
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>
