<?php
// Database connection for EcoBank feedback system
$servername = "localhost";
$username = "root";
$password = ""; // Update with your MySQL root password if set
$dbname = "bankdemo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");

echo "<!-- Database connected successfully to bankdemo -->";
?>
