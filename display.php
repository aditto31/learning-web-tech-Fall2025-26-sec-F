<?php include 'db.php'; ?>
<h2>DISPLAY</h2>
<table border="1">
    <tr><th>NAME</th><th>PROFIT</th><th colspan="2"></th></tr>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM products WHERE display='Yes'");
    while($row = mysqli_fetch_assoc($result)){
    $profit = $row['selling_price'] - $row['buying_price'];
    echo "<tr>
            <td>{$row['name']}</td>
            <td>$profit</td>
            <td><a href='edit.php?id=" . $row['id'] . "'>edit</a></td> 
            <td><a href='delete.php?id=" . $row['id'] . "'>delete</a></td>
          </tr>";
}
    ?>
</table>