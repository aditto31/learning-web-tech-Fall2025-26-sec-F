<?php
session_start();

// 2. Destroy the session properly
session_unset();
session_destroy();

// 3. Remove the cookie by setting expiration to the past
if (isset($_COOKIE['user_cookie'])) {
    setcookie("user_cookie", "", time() - 3600, "/");
}

// 4. Display logout message and provide link back
echo "<h3>You have been logged out successfully.</h3>";
echo "<a href='login.php'>Return to Login Page</a>";
?>