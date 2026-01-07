<?php
session_start();

 
session_unset();
session_destroy();

 
if (isset($_COOKIE['user_cookie'])) {
    setcookie("user_cookie", "", time() - 3600, "/");
}

 
echo "<h3>You have been logged out successfully.</h3>";
echo "<a href='login.php'>Return to Login Page</a>";
?>