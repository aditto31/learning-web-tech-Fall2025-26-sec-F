<?php
$conn = new mysqli("localhost", "root", "", "company_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $emp_id    = $_POST["emp_id"] ?? "";    
    $first     = $_POST["first_name"];
    $last      = $_POST["last_name"];
    $email     = $_POST["email"];
    $dept      = $_POST["department"];
    $join_date = $_POST["join_date"];

     
    if ($emp_id == "") {
        $stmt = $conn->prepare(
            "INSERT INTO employees (first_name, last_name, email, department, join_date)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $first, $last, $email, $dept, $join_date);
        if ($stmt->execute()) {
            $msg = "Employee added.";
        } else {
            $msg = "Error adding employee (email must be unique).";
        }
        $stmt->close();
    } else {  
        $stmt = $conn->prepare(
            "UPDATE employees
             SET first_name = ?, last_name = ?, email = ?, department = ?, join_date = ?
             WHERE emp_id = ?"
        );
        $stmt->bind_param("sssssi", $first, $last, $email, $dept, $join_date, $emp_id);
        if ($stmt->execute()) {
            $msg = "Employee updated.";
        } else {
            $msg = "Error updating employee.";
        }
        $stmt->close();
    }
}

 
$edit_emp = null;
if (isset($_GET["edit_id"])) {
    $edit_id = (int)$_GET["edit_id"];
    $stmt = $conn->prepare(
        "SELECT emp_id, first_name, last_name, email, department, join_date
         FROM employees
         WHERE emp_id = ?"
    );
    $stmt->bind_param("i", $edit_id);
    $stmt->execute();
    $edit_emp = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

 
$list = $conn->query(
    "SELECT emp_id, first_name, last_name, email, department, join_date
     FROM employees
     ORDER BY first_name"
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Manage Employees</title>
</head>
<body>
<h1>Manage Employees</h1>

<p style="color:blue;"><?php echo $msg; ?></p>

<h2><?php echo $edit_emp ? "Update Employee" : "Add Employee"; ?></h2>

<form method="post">
     
    <input type="hidden" name="emp_id"
           value="<?php echo $edit_emp['emp_id'] ?? ''; ?>">

    First name:
    <input type="text" name="first_name" required
           value="<?php echo htmlspecialchars($edit_emp['first_name'] ?? ''); ?>">
    <br><br>

    Last name:
    <input type="text" name="last_name" required
           value="<?php echo htmlspecialchars($edit_emp['last_name'] ?? ''); ?>">
    <br><br>

    Email:
    <input type="email" name="email" required
           value="<?php echo htmlspecialchars($edit_emp['email'] ?? ''); ?>">
    <br><br>

    Department:
    <input type="text" name="department" required
           value="<?php echo htmlspecialchars($edit_emp['department'] ?? ''); ?>">
    <br><br>

    Join date:
    <input type="date" name="join_date" required
           value="<?php echo htmlspecialchars($edit_emp['join_date'] ?? date('Y-m-d')); ?>">
    <br><br>

    <button type="submit">
        <?php echo $edit_emp ? "Update" : "Add"; ?>
    </button>
</form>

<h2>All Employees</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Join date</th>
        <th>Action</th>
    </tr>
    <?php while ($e = $list->fetch_assoc()): ?>
        <tr>
            <td><?php echo $e["emp_id"]; ?></td>
            <td><?php echo htmlspecialchars($e["first_name"] . " " . $e["last_name"]); ?></td>
            <td><?php echo htmlspecialchars($e["email"]); ?></td>
            <td><?php echo htmlspecialchars($e["department"]); ?></td>
            <td><?php echo htmlspecialchars($e["join_date"]); ?></td>
            <td>
                <a href="?edit_id=<?php echo $e["emp_id"]; ?>">Edit</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php $conn->close(); ?>
</body>
</html>
