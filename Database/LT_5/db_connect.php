<?php
$servername = "localhost";
$username = "webtech_user";
$password = ""; 
$dbname = "aiub_webtech";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Database connected successfully.";

?>