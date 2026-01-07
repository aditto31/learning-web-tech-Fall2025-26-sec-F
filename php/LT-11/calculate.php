<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['student_name']);
    $marks = $_POST['marks'];
    
    // 4. Add Validation
    if (empty($name) || count($marks) < 5) {
        die("Please fill all fields.");
    }

    $total = array_sum($marks);
    $average = $total / 5;

    // 3. c) Determine Grade
    if ($average >= 90) $grade = "A";
    elseif ($average >= 80) $grade = "B";
    elseif ($average >= 70) $grade = "C";
    elseif ($average >= 60) $grade = "D";
    else $grade = "F";

    // 5. a) Store result in session
    $student_result = [
        'name' => $name,
        'total' => $total,
        'average' => $average,
        'grade' => $grade
    ];

    if (!isset($_SESSION['all_results'])) {
        $_SESSION['all_results'] = [];
    }
    
    $_SESSION['all_results'][] = $student_result;

    // Display current result
    echo "<h2>Calculation Success</h2>";
    echo "Student: $name<br>Average: $average<br>Grade: <strong>$grade</strong><br><br>";
    echo "<a href='index.php'>Add Another</a> | <a href='results.php'>View Full Table</a>";
}
?>