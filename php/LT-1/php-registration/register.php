<?php
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $pass = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if (empty($name) || empty($email) || empty($pass) || empty($confirm)) {
        $errors[] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } elseif ($pass !== $confirm) {
        $errors[] = "Passwords do not match.";
    }

    if (empty($errors)) {
        $success = "Registration Successful!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <style>
        body { font-family: sans-serif; margin: 20px; line-height: 1.6; }
        .error { color: red; }
        .success { color: green; font-weight: bold; }
        .box { border: 1px solid #ccc; padding: 15px; width: 300px; }
        input { display: block; width: 100%; margin-bottom: 10px; }
    </style>
</head>
<body>

<div class="box">
    <h3>Register</h3>

    <?php foreach ($errors as $error) echo "<p class='error'>$error</p>"; ?>

    <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
        <p><strong>Name:</strong> <?php echo $name; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="text" name="name" placeholder="Name">
        <input type="text" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="confirm_password" placeholder="Confirm Password">
        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>