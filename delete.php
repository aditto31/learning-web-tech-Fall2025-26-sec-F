<?php 
include 'db.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$id"));

if(isset($_POST['confirm_delete'])){
    mysqli_query($conn, "DELETE FROM products WHERE id=$id");
    header("Location: display.php");
}
?>
<fieldset style="width: 300px;">
    <legend>DELETE PRODUCT</legend>
    <p>Name: <?php echo $data['name']; ?></p>
    <p>Buying Price: <?php echo $data['buying_price']; ?></p>
    <p>Selling Price: <?php echo $data['selling_price']; ?></p>
    <p>Displayable: <?php echo $data['display']; ?></p>
    <hr>
    <form method="POST"><button type="submit" name="confirm_delete">Delete</button></form>
</fieldset>