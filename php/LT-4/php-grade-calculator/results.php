<?php
session_start();

if (isset($_GET['clear'])) {
    unset($_SESSION['grades']);
    header("Location: results.php");
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>All Student Grades</h2>
    <table border="1" width="400">
        <tr>
            <th>Name</th><th>Total</th><th>Average</th><th>Grade</th>
        </tr>
        <?php
        if (!empty($_SESSION['grades'])) {
            foreach ($_SESSION['grades'] as $s) {
                echo "<tr>
                        <td>{$s['name']}</td>
                        <td>{$s['total']}</td>
                        <td>{$s['avg']}</td>
                        <td>{$s['grade']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No records found.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="index.php">Add More Marks</a> | 
    <a href="results.php?clear=1" style="color:red;">Clear History</a>
</body>
</html>