<?php
// Database connection details
$servername = "localhost";  // MySQL server name or IP address
$username = "root";         // MySQL username
$password = "";             // MySQL password
$database = "listview";     // Name of the database to connect to

// Attempt to establish a connection to the MySQL database
$conn = mysqli_connect($servername, $username, $password, $database);

// Check if the connection was successful
if (!$conn) {
    // If the connection fails, print an error message and terminate the script
    die("Connection failed: " . mysqli_connect_error());
}

// If the connection is successful, the $conn variable now holds the connection object
// and can be used to interact with the MySQL database.
?>
