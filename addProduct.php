<?php include 'db.php'; ?>
<form method="POST">
    <fieldset style="width: 300px;">
        <legend>ADD PRODUCT</legend>
        Name<br><input type="text" name="name"><br>
        Buying Price<br><input type="text" name="buying_price"><br>
        Selling Price<br><input type="text" name="selling_price"><hr>
        <input type="checkbox" name="display" value="Yes"> Display <hr>
        <button type="submit" name="save">SAVE</button>
    </fieldset>
</form>

<?php
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $bPrice = $_POST['buying_price'];
    $sPrice = $_POST['selling_price'];
    $display = isset($_POST['display']) ? 'Yes' : 'No';
    
    $sql = "INSERT INTO products (name, buying_price, selling_price, display) 
            VALUES ('$name', '$bPrice', '$sPrice', '$display')";
    mysqli_query($conn, $sql);
}
?>