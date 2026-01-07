<?php 
include 'db.php';
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM students WHERE id=$id");
$row = $res->fetch_assoc();

if (isset($_POST['update'])) {
    $sql = "UPDATE students SET name='".$_POST['name']."', email='".$_POST['email']."', 
            department='".$_POST['dept']."' WHERE id=$id";
    if ($conn->query($sql)) {
        echo "<script>alert('Update Successful!'); window.location='view_students.php';</script>";
    }
}
?>
<form method="POST" style="width:300px; margin:auto;">
    <h3>Edit Student</h3>
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br><br>
    Dept: <input type="text" name="dept" value="<?php echo $row['department']; ?>"><br><br>
    <button type="submit" name="update">Save Changes</button>
</form>