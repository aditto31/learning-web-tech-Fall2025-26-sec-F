<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Employee Leave Request</title>
</head>
<body>
    <h2>Leave Request Form</h2>
    <form action="process.php" method="POST">
        <label for="name">Employee Name:</label><br>
        <input type="text" id="name" name="employee_name" required><br><br>

        <label for="dept">Department:</label><br>
        <input type="text" id="dept" name="department" required><br><br>

        <label for="days">Number of Leave Days:</label><br>
        <input type="number" id="days" name="leave_days" min="1" required><br><br>

        <button type="submit">Submit Request</button>
    </form>
</body>
</html>