<?php
 
$conn = new mysqli("localhost", "root", "", "company_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emp_id    = $_POST["emp_id"];
    $date      = $_POST["date"];
    $check_in  = $_POST["check_in_time"];
    $check_out = $_POST["check_out_time"];
    $status    = $_POST["status"];

  
    $check = $conn->prepare(
        "SELECT attendance_id FROM attendance WHERE emp_id = ? AND date = ?"
    );
    $check->bind_param("is", $emp_id, $date);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $msg = "Already marked for this employee on this date.";
    } else {
       
        $stmt = $conn->prepare(
            "INSERT INTO attendance (emp_id, date, check_in_time, check_out_time, status)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("issss", $emp_id, $date, $check_in, $check_out, $status);

        if ($stmt->execute()) {
            $msg = "Attendance saved.";
        } else {
            $msg = "Error saving attendance.";
        }

        $stmt->close();
    }

    $check->close();
}

 
$emp_list = $conn->query(
    "SELECT emp_id, first_name, last_name FROM employees ORDER BY first_name"
);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mark Attendance</title>
</head>
<body>
<h1>Mark Attendance</h1>

<p style="color:blue;"><?php echo $msg; ?></p>

<form method="post">

    Employee:
    <select name="emp_id" required>
        <option value="">Select employee</option>
        <?php while ($e = $emp_list->fetch_assoc()): ?>
            <option value="<?php echo $e["emp_id"]; ?>">
                <?php echo htmlspecialchars($e["first_name"] . " " . $e["last_name"]); ?>
            </option>
        <?php endwhile; ?>
    </select>
    <br><br>

    Date:
    <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
    <br><br>

    Check‑in time:
    <input type="time" name="check_in_time" required>
    <br><br>

    Check‑out time:
    <input type="time" name="check_out_time" required>
    <br><br>

    Status:
    <select name="status" required>
        <option value="Present">Present</option>
        <option value="Absent">Absent</option>
        <option value="Late">Late</option>
        <option value="Half-Day">Half‑Day</option>
    </select>
    <br><br>

    <button type="submit">Save</button>
</form>

<?php $conn->close(); ?>
</body>
</html>
