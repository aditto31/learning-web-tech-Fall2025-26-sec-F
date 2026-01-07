<?php
session_start(); 

 
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Dashboard</h2>
    <p>Welcome, <strong><?php echo $_SESSION['user']; ?></strong>!</p>
    <p>Information retrieved from session.</p>

    <?php if (isset($_COOKIE['user_cookie'])): ?>
        <p style="color:blue;">The "Remember Me" cookie is set.</p>
        <p>Cookie Value: <?php echo $_COOKIE['user_cookie']; ?></p>
    <?php else: ?>
        <p>No cookie is currently available.</p>
    <?php endif; ?>

    <p>Session ID: <?php echo session_id(); ?></p>
    <hr>
    <a href="logout.php">Logout</a>
</body>
</html>