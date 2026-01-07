<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "student_records";

// 1. Connect PHP to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Fetch all records using SELECT *
$sql = "SELECT * FROM students";
$result = $conn->query($sql);

echo "<h2>Student Records</h2>";

// 3. Check if records exist and display them
if ($result->num_rows > 0) {
    // 4. Display records in an HTML table
    echo "<table border='1' cellpadding='10'>";
    echo "<tr><th>ID</th><th>Name</th><th>Registration No</th><th>Program</th></tr>";
    
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["registration_no"] . "</td>";
        echo "<td>" . $row["program"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // 5. Show message if no records exist
    echo "No records found.";
}

$conn->close();
?>