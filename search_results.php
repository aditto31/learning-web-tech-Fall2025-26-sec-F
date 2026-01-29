<?php
include 'db.php';

$q = $_GET['q'];

$sql = "SELECT * FROM products WHERE name LIKE '$q%'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' width='100%' style='border-collapse: collapse;'>
            <tr>
                <th>NAME</th>
                <th>PROFIT</th>
                <th></th>
            </tr>";

    while($row = mysqli_fetch_assoc($result)) {
        $profit = $row['selling_price'] - $row['buying_price'];
        
        echo "<tr>
                <td>{$row['name']}</td>
                <td>$profit</td>
                <td>
                    <a href='edit.php?id={$row['id']}'>edit</a> 
                    <a href='delete.php?id={$row['id']}'>delete</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No results found.";
}
?>