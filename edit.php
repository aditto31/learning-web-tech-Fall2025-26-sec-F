<?php 
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        die("Product not found!");
    }
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $bPrice = $_POST['bPrice'];
    $sPrice = $_POST['sPrice'];
    $display = isset($_POST['display']) ? 'Yes' : 'No';
    
    $updateSql = "UPDATE products SET 
                  name='$name', 
                  buying_price='$bPrice', 
                  selling_price='$sPrice', 
                  display='$display' 
                  WHERE id=$id";
                  
    if (mysqli_query($conn, $updateSql)) {
        header("Location: display.php");  
        exit();
    }
}
?>

<form method="POST">
    <fieldset style="width: 300px;">
        <legend>EDIT PRODUCT</legend>
        
        Name<br>
        <input type="text" name="name" value="<?php echo $data['name']; ?>"><br>
        
        Buying Price<br>
        <input type="text" name="bPrice" value="<?php echo $data['buying_price']; ?>"><br>
        
        Selling Price<br>
        <input type="text" name="sPrice" value="<?php echo $data['selling_price']; ?>"><hr>
        
        <input type="checkbox" name="display" <?php echo ($data['display'] == 'Yes') ? 'checked' : ''; ?>> 
        Display <hr>
        
        <button type="submit" name="update">SAVE</button>
    </fieldset>
</form>