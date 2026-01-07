<?php
$conn = new mysqli("localhost", "root", "", "company_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
$emp_list = $conn->query(
    "SELECT emp_id, first_name, last_name FROM employees ORDER BY first_name"
);

 
$emp_id    = $_GET["emp_id"]    ?? "";
$from_date = $_GET["from_date"] ?? "";
$to_date   = $_GET["to_date"]   ?? "";

if ($from_date == "") $from_date = date("Y-m-01"); 
if ($to_date == "")   $to_date   = date("Y-m-d");

$sql = "SELECT a.date, a.check_in_time, a.check_out_time, a.status,
               e.first_name, e.last_name
        FROM attendance a
        JOIN employees e ON a.emp_id = e.emp_id
        WHERE a.date BETWEEN ? AND ?";

$params = [];
$types  = "ss";
$params[] = $from_date;
$params[] = $to_date;

if ($emp_id != "") {
    $sql .= " AND a.emp_id = ?";
    $types .= "i";
    $params[] = $emp_id;
}

$sql .= " ORDER BY a.date";

$stmt = $conn->prepare($sql);
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();

 
$total = 0;
$present = 0;
$absent = 0;
$late = 0;
$half = 0;

 
$rows = [];
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
    $total++;

    if ($row["status"] == "Present")   $present++;
    if ($row["status"] == "Absent")    $absent++;
    if ($row["status"] == "Late")      $late++;
    if ($row["status"] == "Half-Day")  $half++;
}

$percentage = 0;
if ($total > 0) {
    $percentage = ($present / $total) * 100;
}

$stmt->close();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Attendance Report</title>
</head>
<body>
<h1>Attendance Report</h1>

<form method="get">
    Employee:
    <select name="emp_id">
        <option value="">All</option>
        <?php while ($e = $emp_list->fetch_assoc()): ?>
            <option value="<?php echo $e["emp_id"]; ?>"
                <?php if ($emp_id == $e["emp_id"]) echo "selected"; ?>>
                <?php echo htmlspecialchars($e["first_name"] . " " . $e["last_name"]); ?>
            </option>
        <?php endwhile; ?>
    </select>
    <br><br>

    From:
    <input type="date" name="from_date" value="<?php echo $from_date; ?>">
    To:
    <input type="date" name="to_date" value="<?php echo $to_date; ?>">
    <br><br>

    <button type="submit">View Report</button>
</form>

<h2>Records</h2>

<?php if ($total == 0): ?>
    <p>No attendance records found.</p>
<?php else: ?>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Date</th>
        <th>Employee</th>
        <th>Check‑in</th>
        <th>Check‑out</th>
        <th>Status</th>
    </tr>
    <?php foreach ($rows as $r): ?>
        <tr>
            <td><?php echo htmlspecialchars($r["date"]); ?></td>
            <td><?php echo htmlspecialchars($r["first_name"] . " " . $r["last_name"]); ?></td>
            <td><?php echo htmlspecialchars($r["check_in_time"]); ?></td>
            <td><?php echo htmlspecialchars($r["check_out_time"]); ?></td>
            <td><?php echo htmlspecialchars($r["status"]); ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>Statistics</h2>
<p>Total records: <?php echo $total; ?></p>
<p>Present: <?php echo $present; ?></p>
<p>Absent: <?php echo $absent; ?></p>
<p>Late: <?php echo $late; ?></p>
<p>Half‑Day: <?php echo $half; ?></p>
<p>Attendance percentage: <?php echo number_format($percentage, 2); ?>%</p>
<?php endif; ?>

<?php $conn->close(); ?>
</body>
</html>
