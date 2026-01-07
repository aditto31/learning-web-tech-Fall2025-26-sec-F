<?php
// Initialize variables
$errors = [];
$success_msg = "";
$submitted_data = [];

if (isset($_POST['submit'])) {
    // 1. Sanitize all inputs
    $name    = htmlspecialchars(trim($_POST['name']));
    $email   = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars(trim($_POST['message']));

    // 2. Validate all required fields
    if (empty($name) || empty($email) || empty($message)) {
        $errors[] = "Please fill in all required fields.";
    }

    // 3. Check email format with filter_var()
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // 4. Message length check (min 10 characters)
    if (strlen($message) < 10) {
        $errors[] = "Message must be at least 10 characters long.";
    }

    // 5. Validate file attachment if uploaded
    if (!empty($_FILES['attachment']['name'])) {
        $file_size = $_FILES['attachment']['size'];
        $file_type = $_FILES['attachment']['type'];
        $allowed_types = ['image/jpeg', 'image/png', 'application/pdf'];

        // Limit size to 2MB (example) and check type
        if (!in_array($file_type, $allowed_types)) {
            $errors[] = "Only JPG, PNG, and PDF files are allowed.";
        }
        if ($file_size > 2097152) {
            $errors[] = "File must be smaller than 2MB.";
        }
    }

    // 6. If no errors, show data and simulate email
    if (empty($errors)) {
        $success_msg = "Email sent successfully!"; // Simulated
        $submitted_data = [
            'Name' => $name,
            'Email' => $email,
            'Subject' => $subject,
            'Message' => $message,
            'File' => !empty($_FILES['attachment']['name']) ? $_FILES['attachment']['name'] : "None"
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Form</title>
    <style>
        body { font-family: sans-serif; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
    </style>
</head>
<body>

    <h2>Contact Us</h2>
    <form action="contact.php" method="POST" enctype="multipart/form-data">
        
        <div class="form-group">
            <label>Name (required):</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-group">
            <label>Email (required):</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Subject:</label>
            <select name="subject">
                <option value="General">General</option>
                <option value="Support">Support</option>
                <option value="Feedback">Feedback</option>
            </select>
        </div>

        <div class="form-group">
            <label>Message (min 10 characters):</label>
            <textarea name="message" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label>Attachment (optional):</label>
            <input type="file" name="attachment">
        </div>

        <button type="submit" name="submit">Send Message</button>
    </form>

</body>
</html>