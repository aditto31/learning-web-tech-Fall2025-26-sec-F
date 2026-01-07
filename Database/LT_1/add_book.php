<?php
// add_book.php (very simple)

// Connect to database
$conn = new mysqli("localhost", "root", "", "bookstore_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title  = $_POST["title"];
    $author = $_POST["author"];
    $isbn   = $_POST["isbn"];
    $price  = $_POST["price"];
    $cat    = $_POST["category"];
    $stock  = $_POST["stock_quantity"];
    $year   = $_POST["publication_year"];

    // price must be positive
    if ($price <= 0) {
        $msg = "Price must be positive.";
    } else {
        // check duplicate ISBN
        $check = $conn->prepare("SELECT book_id FROM books WHERE isbn = ?");
        $check->bind_param("s", $isbn);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $msg = "ISBN already exists.";
        } else {
            // insert book
            $stmt = $conn->prepare(
                "INSERT INTO books (title, author, isbn, price, category, stock_quantity, publication_year)
                 VALUES (?, ?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("sssdsii", $title, $author, $isbn, $price, $cat, $stock, $year);

            if ($stmt->execute()) {
                $msg = "Book added.";
            } else {
                $msg = "Error adding book.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Add Book</title>
</head>
<body>
<h1>Add Book</h1>
<p style="color:blue;"><?php echo $msg; ?></p>

<form method="post">
    Title: <input type="text" name="title" required><br><br>
    Author: <input type="text" name="author" required><br><br>
    ISBN: <input type="text" name="isbn" required><br><br>
    Price: <input type="number" step="0.01" name="price" required><br><br>
    Category: <input type="text" name="category" required><br><br>
    Stock quantity: <input type="number" name="stock_quantity" required><br><br>
    Publication year: <input type="number" name="publication_year" required><br><br>
    <button type="submit">Add Book</button>
</form>
</body>
</html>
