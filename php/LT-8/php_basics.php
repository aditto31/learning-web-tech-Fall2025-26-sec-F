
<?php
/**
 * PART A: PHP Variables and Output
 */
$name = "ADitto";
$studentID = "12345";
$department = "Computer Science";

echo "<h2>Part A: Student Information</h2>";
echo "Name: " . $name . "<br>";
echo "ID: " . $studentID . "<br>";
echo "Department: " . $department . "<hr>";

/**
 * PART B: Arithmetic and Type Casting
 */
$num1 = 15;
$num2 = 4;

echo "<h2>Part B: Arithmetic Operations</h2>";
echo "Addition: " . ($num1 + $num2) . "<br>";
echo "Subtraction: " . ($num1 - $num2) . "<br>";
echo "Multiplication: " . ($num1 * $num2) . "<br>";
echo "Division: " . ($num1 / $num2) . "<br>";

// Type Casting
$stringNumeric = "100";
$floatNum = 45.75;

echo "<br>Type Casting:<br>";
echo "String to Integer: " . (int)$stringNumeric . "<br>";
echo "Float to Integer: " . (int)$floatNum . "<hr>";

/**
 * PART C: Control Flow
 */
$marks = 72;

echo "<h2>Part C: Control Flow (Grade)</h2>";
if ($marks >= 80) {
    echo "Grade: A";
} elseif ($marks >= 65) {
    echo "Grade: B";
} elseif ($marks >= 50) {
    echo "Grade: C";
} else {
    echo "Grade: Fail";
}
echo "<hr>";

/**
 * PART D: Loops
 */
echo "<h2>Part D: Loops</h2>";
echo "For Loop (1 to 10): ";
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}

echo "<br>While Loop (Even numbers 1-20): ";
$j = 1;
while ($j <= 20) {
    if ($j % 2 == 0) {
        echo $j . " ";
    }
    $j++;
}
echo "<hr>";

/**
 * PART E: Arrays
 */
echo "<h2>Part E: Arrays</h2>";

// Indexed Array
$languages = ["PHP", "JavaScript", "Python", "Java", "C++"];
echo "Favorite Programming Languages: ";
foreach ($languages as $lang) {
    echo $lang . " ";
}

// Associative Array
$user = [
    "Name" => "ADitto Mirza",
    "Email" => "aditto@aiub.com",
    "City" => "Dhaka"
];

echo "<br><br>User Details:<br>";
foreach ($user as $key => $value) {
    echo $key . ": " . $value . "<br>";
}
echo "<hr>";

/**
 * PART F: User-Defined Function
 */
function calculateSquare($number) {
    return $number * $number;
}

$inputNum = 8;
echo "<h2>Part F: Functions</h2>";
echo "The square of $inputNum is: " . calculateSquare($inputNum);
?>