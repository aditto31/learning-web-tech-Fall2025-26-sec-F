<?php
$errors = [];
$success_data = [];

// 1. Check if fields are set using isset()
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Retrieve data using $_POST
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $skills = $_POST['skills'] ?? [];
    $country = $_POST['country'] ?? '';

    // 2. Server-Side Validation
    if (empty($name) || empty($email)) {
        $errors[] = "Name and Email must not be empty.";
    }
    
    if (!empty($age) && ($age <= 0)) {
        $errors[] = "Age must be a positive number.";
    } elseif (empty($age)) {
        $errors[] = "Age is required.";
    }

    if (empty($gender)) {
        $errors[] = "Gender must be selected.";
    }

    if (count($skills) < 1) {
        $errors[] = "At least one skill must be selected.";
    }

    // 3. Display Results
    echo "<h2>Processing Result</h2>";
    
    if (!empty($errors)) {
        // Display appropriate error messages if validation fails
        echo "<div style='color: red;'>";
        foreach ($errors as $error) {
            echo "<p>• $error</p>";
        }
        echo "</div>";
        echo "<p><a href='form.php'>Go back to fix errors</a></p>";
    } else {
        // Display success message and submitted data if validation passes
        echo "<div style='color: green; border: 1px solid green; padding: 10px;'>";
        echo "<h3>Success! Information Submitted.</h3>";
        echo "<strong>Name:</strong> $name <br>";
        echo "<strong>Email:</strong> $email <br>";
        echo "<strong>Age:</strong> $age <br>";
        echo "<strong>Gender:</strong> $gender <br>";
        echo "<strong>Skills:</strong> " . implode(", ", $skills) . "<br>";
        echo "<strong>Country:</strong> $country <br>";
        echo "</div>";
    }

    echo "<hr>";
    // 4. Demonstrate $_SERVER Superglobal
    echo "<h3>System Metadata (Superglobals)</h3>";
    echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>"; //
    echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "<br>"; //
}
?>