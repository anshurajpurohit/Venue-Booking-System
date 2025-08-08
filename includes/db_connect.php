<?php
// Database connection parameters
$servername = "localhost";  // Your MySQL host (localhost if running on the same server)
$username = "root";         // Your MySQL username (default is "root" for local WAMP)
$password = "";             // Your MySQL password (leave empty if there's no password for local setup)
$dbname = "venue_booking_system";  // Name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
