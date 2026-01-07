<?php
 
function getDiscountedPrice($price, $category, $discounts) {
    if (isset($discounts[$category])) {
        $reduction = $price * ($discounts[$category] / 100);
        return $price - $reduction;
    }
    return $price;
}

  
function findMostExpensive($inventory) {
    $expensive = $inventory[0];
    foreach ($inventory as $product) {
        if ($product['price'] > $expensive['price']) {
            $expensive = $product;
        }
    }
    return $expensive;
}

 
$inventory = [
    ["name" => "Laptop", "price" => 1000, "quantity" => 5, "category" => "Electronics"],
    ["name" => "Smartphone", "price" => 700, "quantity" => 10, "category" => "Electronics"],
    ["name" => "Office Chair", "price" => 150, "quantity" => 20, "category" => "Furniture"],
    ["name" => "Desk Lamp", "price" => 45, "quantity" => 15, "category" => "Decor"],
    ["name" => "Gaming Mouse", "price" => 80, "quantity" => 12, "category" => "Electronics"]
];

 
$discounts = [
    "Electronics" => 10,  
    "Furniture" => 15,    
    "Decor" => 5         
];

 

$totalInventoryValue = 0;
foreach ($inventory as $item) {
   
    $totalInventoryValue += ($item['price'] * $item['quantity']);
}

$mostExpensiveProduct = findMostExpensive($inventory);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Product Inventory System</title>
    <style>
        body { font-family: sans-serif; margin: 30px; line-height: 1.6; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .summary-box { background: #f9f9f9; padding: 15px; border: 1px solid #ddd; margin-top: 20px; width: fit-content; }
        .total { color: #2c3e50; font-weight: bold; font-size: 1.2em; }
    </style>
</head>
<body>

    <h2>Inventory Management Report</h2>

    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Original Price</th>
                <th>Discounted Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventory as $product): ?>
            <tr>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo $product['category']; ?></td>
                <td><?php echo $product['quantity']; ?></td>
                <td>$<?php echo number_format($product['price'], 2); ?></td>
                <td>
                    $<?php echo number_format(getDiscountedPrice($product['price'], $product['category'], $discounts), 2); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="summary-box">
        <p><strong>Most Expensive Product:</strong> <?php echo $mostExpensiveProduct['name']; ?> ($<?php echo $mostExpensiveProduct['price']; ?>)</p>
        <p class="total">Total Inventory Value: $<?php echo number_format($totalInventoryValue, 2); ?></p>
    </div>

</body>
</html>