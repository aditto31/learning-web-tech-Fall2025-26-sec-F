<?php
session_start();
 
if (isset($_POST['update'])) {
    foreach ($_POST['qty'] as $id => $q) {
        if ($q <= 0) unset($_SESSION['cart'][$id]);
        else $_SESSION['cart'][$id] = $q;
    }
}
if (isset($_GET['remove'])) {
    unset($_SESSION['cart'][$_GET['remove']]);
}

 
$products = [1 => ['name'=>'Laptop','price'=>800], 2 => ['name'=>'Phone','price'=>500], 3 => ['name'=>'Headphones','price'=>100], 4 => ['name'=>'Monitor','price'=>200], 5 => ['name'=>'Keyboard','price'=>50]];
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Your Shopping Cart</h2>
    <form method="POST">
    <table border="1" width="500">
        <tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th><th>Action</th></tr>
        <?php 
        $grand_total = 0;
        if (!empty($_SESSION['cart'])):
            foreach ($_SESSION['cart'] as $id => $qty): 
                $subtotal = $products[$id]['price'] * $qty;
                $grand_total += $subtotal;
        ?>
            <tr>
                <td><?php echo $products[$id]['name']; ?></td>
                <td><input type="number" name="qty[<?php echo $id; ?>]" value="<?php echo $qty; ?>" style="width:40px;"></td>
                <td>$<?php echo $products[$id]['price']; ?></td>
                <td>$<?php echo $subtotal; ?></td>
                <td><a href="cart.php?remove=<?php echo $id; ?>">Remove</a></td>
            </tr>
        <?php endforeach; endif; ?>
        <tr><td colspan="3"><strong>Grand Total</strong></td><td colspan="2"><strong>$<?php echo $grand_total; ?></strong></td></tr>
    </table>
    <br>
    <button type="submit" name="update">Update Cart</button>
    <a href="index.php">Continue Shopping</a> | <a href="checkout.php">Checkout</a>
    </form>
</body>
</html>