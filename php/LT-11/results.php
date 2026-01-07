<?php
session_start();

 
if (isset($_GET['clear'])) {
    unset($_SESSION['all_results']);
    header("Location: results.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Student Results</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .nav { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="index.php">Add Marks</a> | <a href="results.php">Refresh Table</a>
    </div>

    <h2>All Student Grades</h2>

    <?php if (isset($_SESSION['all_results']) && count($_SESSION['all_results']) > 0): ?>
        <table>
            <tr>
                <th>Student Name</th>
                <th>Total Marks</th>
                <th>Average</th>
                <th>Grade</th>
            </tr>
            <?php foreach ($_SESSION['all_results'] as $res): ?>
                <tr>
                    <td><?php echo $res['name']; ?></td>
                    <td><?php echo $res['total']; ?></td>
                    <td><?php echo $res['average']; ?></td>
                    <td><strong><?php echo $res['grade']; ?></strong></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <br>
        <a href="results.php?clear=1" onclick="return confirm('Clear all data?')">Clear All Results</a>
    <?php else: ?>
        <p>No results found. <a href="index.php">Click here to add one.</a></p>
    <?php endif; ?>
</body>
</html>