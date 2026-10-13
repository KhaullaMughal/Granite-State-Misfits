<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ride_db";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Set character set to utf8mb4
if (!$conn->set_charset("utf8mb4")) {
    die("Error loading character set utf8mb4: " . $conn->error);
}
// Set collation to utf8mb4_general_ci
if (!$conn->query("SET collation_connection = 'utf8mb4_general_ci'")) {
    die("Error setting collation: " . $conn->error);
}
// Set timezone
date_default_timezone_set('Asia/Kolkata');
// Start session


?>