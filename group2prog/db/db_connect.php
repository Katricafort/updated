<?php
$servername = "localhost";
$username = "root";     // Default XAMPP username
$password = "";         // Leave blank if no password
$database = "users";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>