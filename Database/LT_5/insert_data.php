<?php
 
include 'db_connect.php';

 
$sql1 = "INSERT INTO students (name, email, age, department) 
         VALUES ('Aditto', 'aditto@aiub.com', 20, 'CSE')";

$sql2 = "INSERT INTO students (name, email, age, department) 
         VALUES ('Muhtasim', 'muh@nsu.com', 21, 'EEE')";

$sql3 = "INSERT INTO students (name, email, age, department) 
         VALUES ('Mahdi', 'mah@brac.com', 22, 'BBA')";

 
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

 
mysqli_close($conn);
?>