<?php
session_start();

// Check if the user is already logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Not logged in, redirect to login page
    header("Location: html/login.html");
    exit;
}

// The rest of your homepage content goes here
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome to My Website</title>
    <!-- other head elements -->
</head>
<body>
<h1>Welcome, you are logged in!</h1>
<!-- Rest of your main page content -->
</body>
</html>
