<?php
$host = "localhost";
$user = "root"; // default for XAMPP/WAMP
$pass = "";     // default no password
$db   = "student_db"; // create this database first

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
