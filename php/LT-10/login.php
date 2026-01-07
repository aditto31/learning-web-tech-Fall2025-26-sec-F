<!DOCTYPE html>
<html>
<head>
    <title>Login System</title>
</head>
<body>
    <h2>User Login</h2>
    <form action="process_login.php" method="post">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <input type="checkbox" id="remember" name="remember">
        <label for="remember">Remember Me</label><br><br>
        
        <button type="submit" name="login">Login</button>
    </form>
</body>
</html>