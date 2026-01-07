<?php
 
$conn = new mysqli("localhost", "root", "", "bookstore_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

 
$cat_result = $conn->query("SELECT DISTINCT category FROM books ORDER BY category");

 
$keyword   = $_GET["keyword"]   ?? "";
$category  = $_GET["category"]  ?? "";
$min_price = $_GET["min_price"] ?? "";
$max_price = $_GET["max_price"] ?? "";

 
$sql = "SELECT title, author, price, category FROM books WHERE 1";
$params = [];
$types  = "";

 
if ($keyword != "") {
    $sql .= " AND (title LIKE ? OR author LIKE ?)";
    $like = "%" . $keyword . "%";
    $params[] = $like;
    $params[] = $like;
    $types .= "ss";
}

 
if ($category != "") {
    $sql .= " AND category = ?";
    $params[] = $category;
    $types .= "s";
}

 
if ($min_price !== "") {
    $sql .= " AND price >= ?";
    $params[] = $min_price;
    $types .= "d";
}
if ($max_price !== "") {
    $sql .= " AND price <= ?";
    $params[] = $max_price;
    $types .= "d";
}

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Search</title>
</head>
<body>
<h1>Search Books</h1>

<form method="get">
    Search (title or author):
    <input type="text" name="keyword" value="<?php echo htmlspecialchars($keyword); ?>"><br><br>

    Category:
    <select name="category">
        <option value="">All</option>
        <?php while ($c = $cat_result->fetch_assoc()): ?>
            <option value="<?php echo htmlspecialchars($c["category"]); ?>"
                <?php if ($category == $c["category"]) echo "selected"; ?>>
                <?php echo htmlspecialchars($c["category"]); ?>
            </option>
        <?php endwhile; ?>
    </select><br><br>

    Min price:
    <input type="number" step="0.01" name="min_price" value="<?php echo htmlspecialchars($min_price); ?>">
    Max price:
    <input type="number" step="0.01" name="max_price" value="<?php echo htmlspecialchars($max_price); ?>">
    <br><br>

    <button type="submit">Search</button>
</form>

<h2>Results</h2>
<?php while ($row = $result->fetch_assoc()): ?>
    <div>
        <?php echo htmlspecialchars($row["title"]); ?> -
        <?php echo htmlspecialchars($row["author"]); ?> -
        <?php echo htmlspecialchars($row["category"]); ?> -
        <?php echo htmlspecialchars($row["price"]); ?>
    </div>
<?php endwhile; ?>

<?php
$stmt->close();
$conn->close();
?>
</body>
</html>
