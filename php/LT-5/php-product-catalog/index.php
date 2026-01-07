<?php
session_start();

 
$products = [
    ['id' => 1, 'name' => 'Laptop', 'price' => 800, 'image' => 'laptop.jpg'],
    ['id' => 2, 'name' => 'Phone', 'price' => 500, 'image' => 'phone.jpg'],
    ['id' => 3, 'name' => 'Headphones', 'price' => 100, 'image' => 'audio.jpg'],
    ['id' => 4, 'name' => 'Monitor', 'price' => 200, 'image' => 'screen.jpg'],
    ['id' => 5, 'name' => 'Keyboard', 'price' => 50, 'image' => 'keys.jpg']
];

 
if (isset($_POST['add_to_cart'])) {
    $id = $_POST['product_id'];
     
    $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    echo "<script>alert('Product added!');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Catalog</title>
    <style>
        .product { border: 1px solid #ccc; padding: 10px; margin: 10px; display: inline-block; width: 200px; text-align: center; }
    </style>
</head>
<body>
    <h2>Product Catalog</h2>
    <a href="cart.php">View Cart (<?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>)</a>
    <hr>
    <?php foreach ($products as $p): ?>
        <div class="product">
            <h4><?php echo $p['name']; ?></h4>
            <p>$<?php echo $p['price']; ?></p>
            <form method="POST">
                <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
                <button type="submit" name="add_to_cart">Add to Cart</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>