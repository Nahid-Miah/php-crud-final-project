<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "walton"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// echo "connection success";

?>