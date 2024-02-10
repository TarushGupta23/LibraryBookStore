<?php
$servername = "localhost";
$username = "root";
$pwd = "";
$dbname = "nitjLibrary";

$conn = new mysqli($servername, $username, $pwd, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>