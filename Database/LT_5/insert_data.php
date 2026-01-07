<?php
// 1. Include db_connect.php to establish database connection
include 'db_connect.php';

// 2. SQL queries to insert at least 3 student records
$sql1 = "INSERT INTO students (name, email, age, department) 
         VALUES ('Aditto', 'aditto@aiub.com', 20, 'CSE')";

$sql2 = "INSERT INTO students (name, email, age, department) 
         VALUES ('Muhtasim', 'muh@nsu.com', 21, 'EEE')";

$sql3 = "INSERT INTO students (name, email, age, department) 
         VALUES ('Mahdi', 'mah@brac.com', 22, 'BBA')";

// 3. Execute queries and display success/error messages for each
if (mysqli_query($conn, $sql1)) {
    echo "<br>Record 1 inserted successfully.";
} else {
    echo "<br>Error inserting record 1: " . mysqli_error($conn);
}

if (mysqli_query($conn, $sql2)) {
    echo "<br>Record 2 inserted successfully.";
} else {
    echo "<br>Error inserting record 2: " . mysqli_error($conn);
}

if (mysqli_query($conn, $sql3)) {
    echo "<br>Record 3 inserted successfully.";
} else {
    echo "<br>Error inserting record 3: " . mysqli_error($conn);
}

// 4. Close the database connection properly
mysqli_close($conn);
?>