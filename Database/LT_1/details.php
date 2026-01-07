<?php
// details.php

// connect
$conn = new mysqli("localhost", "root", "", "bookstore_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// book id from URL
$id = $_GET["id"] ?? 0;

// get selected book
$stmt = $conn->prepare(
    "SELECT book_id, title, author, isbn, price, category, stock_quantity, publication_year
     FROM books
     WHERE book_id = ?"
);
$stmt->bind_param("i", $id);
$stmt->execute();
$book_result = $stmt->get_result();
$book = $book_result->fetch_assoc();
$stmt->close();

// if book found, get related books (same category, different id)
$related = null;
if ($book) {
    $cat = $book["category"];
    $stmt2 = $conn->prepare(
        "SELECT book_id, title, author
         FROM books
         WHERE category = ? AND book_id <> ?"
    );
    $stmt2->bind_param("si", $cat, $id);
    $stmt2->execute();
    $related = $stmt2->get_result();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book Details</title>
</head>
<body>
<h1>Book Details</h1>

<?php if (!$book): ?>
    <p>Book not found.</p>
<?php else: ?>
    <p>Title: <?php echo htmlspecialchars($book["title"]); ?></p>
    <p>Author: <?php echo htmlspecialchars($book["author"]); ?></p>
    <p>ISBN: <?php echo htmlspecialchars($book["isbn"]); ?></p>
    <p>Price: <?php echo htmlspecialchars($book["price"]); ?></p>
    <p>Category: <?php echo htmlspecialchars($book["category"]); ?></p>
    <p>Stock: <?php echo htmlspecialchars($book["stock_quantity"]); ?></p>
    <p>Publication year: <?php echo htmlspecialchars($book["publication_year"]); ?></p>

    <h2>Related books (same category)</h2>
    <?php if ($related && $related->num_rows > 0): ?>
        <?php while ($r = $related->fetch_assoc()): ?>
            <div>
                <?php echo htmlspecialchars($r["title"]); ?> -
                <?php echo htmlspecialchars($r["author"]); ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No related books.</p>
    <?php endif; ?>
<?php endif; ?>

<?php
if (isset($stmt2)) $stmt2->close();
$conn->close();
?>
</body>
</html>
