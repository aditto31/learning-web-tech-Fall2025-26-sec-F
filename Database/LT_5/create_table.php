<?php
 
include 'db_connect.php'; 

 
$sql = "CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    age INT NOT NULL,
    department VARCHAR(50) NOT NULL
)";

 
if (mysqli_query($conn, $sql)) {
   
    echo "<br>Table created successfully.";
} else {
    
    echo "<br>Error creating table: " . mysqli_error($conn);
}


mysqli_close($conn);
?>