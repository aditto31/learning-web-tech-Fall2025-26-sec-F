<?php
 
$conn = new mysqli("localhost", "root", "", "bookstore_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
$books_per_page = 10;
$page = isset($_GET["page"]) ? (int) $_GET["page"] : 1;
if ($page < 1) { $page = 1; }
$offset = ($page - 1) * $books_per_page;

 
$count_sql = "SELECT COUNT(*) FROM books";
$count_stmt = $conn->prepare($count_sql);
$count_stmt->execute();
$count_stmt->bind_result($total_books);
$count_stmt->fetch();
$count_stmt->close();

$total_pages = ceil($total_books / $books_per_page);

 
$sql = "SELECT book_id, title, author, price, stock_quantity FROM books
        ORDER BY title
        LIMIT ? OFFSET ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $books_per_page, $offset);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Book Catalog</title>
    <style>
        .book { border:1px solid #ccc; padding:10px; margin:10px 0; display:flex; }
        .book img { width:80px; height:100px; margin-right:10px; background:#eee; }
    </style>
</head>
<body>
<h1>Book Catalog</h1>

<?php while ($row = $result->fetch_assoc()): ?>
    <div class="book">
         
        <img src="https://via.placeholder.com/80x100?text=Book" alt="Book image">
        <div>
            <strong><?php echo htmlspecialchars($row["title"]); ?></strong><br>
            Author: <?php echo htmlspecialchars($row["author"]); ?><br>
            Price: <?php echo htmlspecialchars($row["price"]); ?><br>
            Stock:
            <?php
                if ($row["stock_quantity"] > 0) {
                    echo "In stock (" . htmlspecialchars($row["stock_quantity"]) . ")";
                } else {
                    echo "Out of stock";
                }
            ?>
        </div>
    </div>
<?php endwhile; ?>

<?php $stmt->close(); $conn->close(); ?>

 
<div>
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>">Previous</a>
    <?php endif; ?>

    Page <?php echo $page; ?> of <?php echo $total_pages; ?>

    <?php if ($page < $total_pages): ?>
        <a href="?page=<?php echo $page + 1; ?>">Next</a>
    <?php endif; ?>
</div>
</body>
</html>
