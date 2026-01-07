<?php 
include 'db.php'; 
if (isset($_POST['add'])) {
    $sql = "INSERT INTO students (name, email, registration_no, department) 
            VALUES ('".$_POST['name']."', '".$_POST['email']."', '".$_POST['reg_no']."', '".$_POST['dept']."')";
    if ($conn->query($sql)) {
        echo "<script>alert('Student Added Successfully!'); window.location='view_students.php';</script>";
    }
}
?>
<form method="POST" style="width:300px; margin:auto;">
    <h3>Add Student</h3>
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Reg No: <input type="text" name="reg_no" required><br><br>
    Dept: <input type="text" name="dept" required><br><br>
    <button type="submit" name="add">Submit</button>
</form>