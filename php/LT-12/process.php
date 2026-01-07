<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['employee_name']);
    $dept = htmlspecialchars($_POST['department']);
    $days = intval($_POST['leave_days']);

    echo "<h2>Leave Request Summary</h2>";
    echo "<strong>Employee Name:</strong> " . $name . "<br>";
    echo "<strong>Department:</strong> " . $dept . "<br>";
    echo "<strong>Days Requested:</strong> " . $days . "<br>";

     
    echo "<h3>Status: ";
    if ($days <= 5) {
        echo "<span style='color: green;'>Leave Approved</span>";
    } else {
        echo "<span style='color: orange;'>Pending Approval</span>";
    }
    echo "</h3>";

    echo "<a href='index.html'>Back to Form</a>";
} else {
    echo "Invalid Request.";
}
?>