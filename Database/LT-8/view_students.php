<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>View Student Records</title>
    <style>
        table { width: 90%; border-collapse: collapse; margin: 20px auto; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f4f4f4; }
        .btn-edit { color: blue; margin-right: 10px; }
        .btn-delete { color: red; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Student Management System</h2>
    <div style="text-align: center;"><a href="add_student.php">+ Add New Student</a></div>

    <?php
    $result = $conn->query("SELECT * FROM students");

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Name</th><th>Email</th><th>Reg No</th><th>Department</th><th>Actions</th></tr>";
        
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["registration_no"] . "</td>";
            echo "<td>" . $row["department"] . "</td>";
            echo "<td>
                    <a class='btn-edit' href='edit_student.php?id=" . $row["id"] . "'>Edit</a>
                    <a class='btn-delete' href='delete_student.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='text-align:center;'>No records found.</p>";
    }
    ?>
</body>
</html>