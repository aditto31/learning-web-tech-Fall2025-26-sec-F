<?php
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = "";     // Default XAMPP password
$dbname = "university_db";

// 1. Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Check if form is submitted
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $dept = $_POST['department'];

    // 3. Insert data into table
    $sql = "INSERT INTO students (name, email, age, department) 
            VALUES ('$name', '$email', '$age', '$dept')";

    if ($conn->query($sql) === TRUE) {
        echo "<h1>Registration Successful</h1>";
        echo "<a href='index.php'>Go Back</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>