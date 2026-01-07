<?php
// 1. Include db_connect.php to establish database connection
include 'db_connect.php'; 

// 2. Write SQL query to create the 'students' table
$sql = "CREATE TABLE students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    age INT NOT NULL,
    department VARCHAR(50) NOT NULL
)";

// 3. Execute the query using mysqli_query()
// Note: We use the $conn variable defined in db_connect.php
if (mysqli_query($conn, $sql)) {
    // 4. Display success message
    echo "<br>Table created successfully.";
} else {
    // Display error message if it fails
    echo "<br>Error creating table: " . mysqli_error($conn);
}

// Close the connection (as required by Part B)
mysqli_close($conn);
?>