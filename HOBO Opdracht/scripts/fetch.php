<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "HOBO";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT serietitel FROM serie";
$result = $conn->query($sql);



$conn->close();
?>
