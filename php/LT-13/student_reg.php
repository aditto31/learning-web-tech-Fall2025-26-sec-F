<?php
 
$errors = [];
$success_message = "";

 
if (isset($_POST['register'])) {
    
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $course = $_POST['course'] ?? '';
    $terms = isset($_POST['terms']);


    if (empty($full_name) || empty($email) || empty($username) || empty($password) || empty($age) || empty($gender) || empty($course)) {
        $errors[] = "All fields are required.";
    }

     
    if (!empty($full_name) && !preg_match("/^[a-zA-Z ]*$/", $full_name)) {
        $errors[] = "Full Name must contain only letters and spaces.";
    }

    
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email must be a valid email format.";
    }

     
    if (!empty($username) && strlen($username) < 5) {
        $errors[] = "Username must be at least 5 characters long.";
    }

     
    if (!empty($password) && strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

     
    if ($password !== $confirm_password) {
        $errors[] = "Password and Confirm Password must match.";
    }

     
    if (!empty($age) && intval($age) < 18) {
        $errors[] = "Age must be 18 or above.";
    }

     
    if (!$terms) {
        $errors[] = "Terms & Conditions checkbox must be checked.";
    }

    
    if (empty($errors)) {
        $success_message = "Registration Successful!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <style>
        .error { color: red; margin-bottom: 5px; }
        .success { color: green; font-weight: bold; border: 1px solid green; padding: 10px; }
        .details { background: #f4f4f4; padding: 10px; margin-top: 10px; }
    </style>
</head>
<body>

    <h2>Student Registration Form</h2>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <strong>Please fix the following:</strong>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($success_message): ?>
        <div class="success"><?php echo $success_message; ?></div>
        <div class="details">
            <strong>Submitted Details:</strong><br>
            Name: <?php echo htmlspecialchars($full_name); ?><br>
            Email: <?php echo htmlspecialchars($email); ?><br>
            Username: <?php echo htmlspecialchars($username); ?><br>
            Age: <?php echo htmlspecialchars($age); ?><br>
            Gender: <?php echo htmlspecialchars($gender); ?><br>
            Course: <?php echo htmlspecialchars($course); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="">
        <p>Full Name: <input type="text" name="full_name" value="<?php echo htmlspecialchars($full_name ?? ''); ?>"></p>
        
        <p>Email Address: <input type="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>"></p>
        
        <p>Username: <input type="text" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>"></p>
        
        <p>Password: <input type="password" name="password"></p>
        
        <p>Confirm Password: <input type="password" name="confirm_password"></p>
        
        <p>Age: <input type="number" name="age" value="<?php echo htmlspecialchars($age ?? ''); ?>"></p>
        
        <p>Gender: 
            <input type="radio" name="gender" value="Male" <?php if(($gender ?? '') == 'Male') echo 'checked'; ?>> Male
            <input type="radio" name="gender" value="Female" <?php if(($gender ?? '') == 'Female') echo 'checked'; ?>> Female
        </p>
        
        <p>Course Selection: 
            <select name="course">
                <option value="">--Select Course--</option>
                <option value="Computer Science" <?php if(($course ?? '') == 'Computer Science') echo 'selected'; ?>>Computer Science</option>
                <option value="Engineering" <?php if(($course ?? '') == 'Engineering') echo 'selected'; ?>>Engineering</option>
                <option value="Business" <?php if(($course ?? '') == 'Business') echo 'selected'; ?>>Business</option>
            </select>
        </p>
        
        <p><input type="checkbox" name="terms" <?php if(isset($terms) && $terms) echo 'checked'; ?>> I agree to Terms & Conditions</p>
        
        <button type="submit" name="register">Register</button>
    </form>

</body>
</html>