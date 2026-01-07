<?php
session_start();
if (isset($_POST['place_order'])) {
    unset($_SESSION['cart']);
    echo "<h2>Thank you, " . htmlspecialchars($_POST['name']) . "! Your order has been placed.</h2>";
    echo "<a href='index.php'>Back to Home</a>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Checkout</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br><br>
        <input type="email" name="email" placeholder="Email" required><br><br>
        <button type="submit" name="place_order">Place Order</button>
    </form>
</body>
</html>