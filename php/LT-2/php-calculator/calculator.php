<?php
$result = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operation = $_POST['operation'];

    if (is_numeric($num1) && is_numeric($num2)) {
        if ($operation == "+") $result = $num1 + $num2;
        if ($operation == "-") $result = $num1 - $num2;
        if ($operation == "*") $result = $num1 * $num2;
        if ($operation == "/") {
            if ($num2 == 0) {
                $error = "Error: Cannot divide by zero.";
            } else {
                $result = $num1 / $num2;
            }
        }
    } else {
        $error = "Please enter valid numeric values.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Simple Calculator</title>
    <style>
        body { font-family: sans-serif; display: flex; flex-direction: column; align-items: center; margin-top: 50px; }
        .calc-container { border: 1px solid #000; padding: 20px; background: #eee; width: 220px; }
        input, select, button { width: 100%; margin: 5px 0; padding: 8px; }
        .display { background: white; border: 1px solid #ccc; padding: 10px; margin-top: 10px; text-align: center; }
    </style>
</head>
<body>

<div class="calc-container">
    <h3>Calculator</h3>
    
    <form method="POST" action="">
        <input type="number" name="num1" step="any" placeholder="First Number" required>
        
        <select name="operation">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">×</option>
            <option value="/">÷</option>
        </select>
        
        <input type="number" name="num2" step="any" placeholder="Second Number" required>
        
        <button type="submit">Calculate</button>
    </form>

    <?php if ($result !== ""): ?>
        <div class="display">Result: <?php echo $result; ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="display" style="color: red;"><?php echo $error; ?></div>
    <?php endif; ?>
</div>

</body>
</html>