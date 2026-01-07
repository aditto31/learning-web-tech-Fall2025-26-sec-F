<?php
session_start();
$result_output = "";

if (isset($_POST['calculate'])) {
    $name = htmlspecialchars($_POST['student_name']);
    $marks = $_POST['marks'];
    $total = 0;
    $valid = true;

    // Validation: Check all fields filled and marks between 0-100
    foreach ($marks as $mark) {
        if ($mark === "" || $mark < 0 || $mark > 100) {
            $valid = false;
            break;
        }
        $total += (float)$mark;
    }

    if ($valid && !empty($name)) {
        $average = $total / 5;
        
        // Determine Grade (A: 90+, B: 80-89, etc.)
        if ($average >= 90) $grade = "A";
        elseif ($average >= 80) $grade = "B";
        elseif ($average >= 70) $grade = "C";
        elseif ($average >= 60) $grade = "D";
        else $grade = "F";

        // Store result in session
        $_SESSION['grades'][] = ['name' => $name, 'total' => $total, 'avg' => $average, 'grade' => $grade];

        $result_output = "<h3>Result for $name</h3>
                          <table border='1'>
                            <tr><th>Total</th><th>Average</th><th>Grade</th></tr>
                            <tr><td>$total</td><td>$average</td><td>$grade</td></tr>
                          </table>";
    } else {
        $result_output = "<p style='color:red;'>Please fill all fields with marks between 0-100.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Student Grade Calculator</h2>
    <form method="POST">
        Name: <input type="text" name="student_name" required><br><br>
        Marks for 5 Subjects:<br>
        <input type="number" name="marks[]" placeholder="Sub 1" required>
        <input type="number" name="marks[]" placeholder="Sub 2" required>
        <input type="number" name="marks[]" placeholder="Sub 3" required>
        <input type="number" name="marks[]" placeholder="Sub 4" required>
        <input type="number" name="marks[]" placeholder="Sub 5" required><br><br>
        <button type="submit" name="calculate">Calculate</button>
    </form>

    <?php echo $result_output; ?>
    <br>
    <a href="results.php">View All Saved Grades</a>
</body>
</html>