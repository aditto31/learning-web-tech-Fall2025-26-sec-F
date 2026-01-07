<?php
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "university_db";

 
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $dept = $_POST['department'];

     
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