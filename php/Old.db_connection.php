<?php
// Database configuration settings
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');

// Create a new database connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Optionally, you can set the charset
mysqli_set_charset($conn, "utf8");

// Rest of your database connection code
