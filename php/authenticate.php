<?php
// Start the session
session_start();
// Include database connection file (adjust the path as needed)
require_once "../php/db_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assign and escape user inputs to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the user exists
    $query = "SELECT id, username, password_hash FROM Users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if (password_verify($password, $user['password_hash'])) {
                // Password is correct, start a new session
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $user['username'];
                $_SESSION['id'] = $user['id'];

                // Redirect user to the main page
                header("Location: mainpage.php");
                exit;
            } else {
                // Password is not valid
                header("Location: login.php?error=InvalidPassword");
                exit;
            }
        } else {
            // Username doesn't exist
            header("Location: login.php?error=NoSuchUser");
            exit;
        }
    } else {
        // Database query failed
        header("Location: login.php?error=QueryFailed");
        exit;
    }
} else {
    // Redirect to login page if the form hasn't been submitted
    header("Location: login.php");
    exit;
}

