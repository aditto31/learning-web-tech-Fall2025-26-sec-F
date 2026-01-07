<!DOCTYPE html>
<html>
<head>
    <title>Grade Calculator - Entry</title>
    <style>
        body { font-family: sans-serif; margin: 20px; line-height: 1.5; }
        .nav { margin-bottom: 20px; }
        .form-group { margin-bottom: 10px; }
        label { display: inline-block; width: 150px; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="index.php">Add Marks</a> | <a href="results.php">View All Results</a>
    </div>

    <h2>Student Grade Entry</h2>
    <form action="calculate.php" method="post">
        <div class="form-group">
            <label>Student Name:</label>
            <input type="text" name="student_name" required>
        </div>
        
        <p>Enter Marks (0-100):</p>
        <?php for($i = 1; $i <= 5; $i++): ?>
            <div class="form-group">
                <label>Subject <?php echo $i; ?>:</label>
                <input type="number" name="marks[]" min="0" max="100" required>
            </div>
        <?php endfor; ?>

        <button type="submit">Calculate Grade</button>
    </form>
</body>
</html>