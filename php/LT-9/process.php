<?php
$errors = [];
$success_data = [];

 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
   
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $age = $_POST['age'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $skills = $_POST['skills'] ?? [];
    $country = $_POST['country'] ?? '';

   
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

   
    echo "<h2>Processing Result</h2>";
    
    if (!empty($errors)) {
         
        echo "<div style='color: red;'>";
        foreach ($errors as $error) {
            echo "<p>• $error</p>";
        }
        echo "</div>";
        echo "<p><a href='form.php'>Go back to fix errors</a></p>";
    } else {
        
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
   
    echo "<h3>System Metadata (Superglobals)</h3>";
    echo "Request Method: " . $_SERVER['REQUEST_METHOD'] . "<br>"; //
    echo "Script Name: " . $_SERVER['SCRIPT_NAME'] . "<br>"; //
}
?>