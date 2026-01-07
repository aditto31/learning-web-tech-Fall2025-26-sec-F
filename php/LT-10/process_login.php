<?php
session_start(); // Start a PHP session

// Hardcoded values for demonstration
$valid_user = "admin";
$valid_pass = "password123";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === $valid_user && $password === $valid_pass) {
        // Successful login: store in session
        $_SESSION['user'] = $username;

        // If "Remember Me" is checked, store in cookie for 1 hour
        if (isset($_POST['remember'])) {
            setcookie("user_cookie", $username, time() + 3600, "/");
        }

        header("Location: dashboard.php"); // Redirect to dashboard
        exit;
    } else {
        // Login failed: display error and provide back link
        echo "<p style='color:red;'>Invalid credentials!</p>";
        echo "<a href='login.php'>Try Again</a>";
    }
}
?>