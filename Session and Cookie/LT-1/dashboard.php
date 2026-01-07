<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
    <p>Login Time: <?php echo $_SESSION['login_time']; ?></p>
    <nav>
        <a href="profile.php">View Profile</a> | 
        <a href="logout.php">Logout</a>
    </nav>
</body>
</html>