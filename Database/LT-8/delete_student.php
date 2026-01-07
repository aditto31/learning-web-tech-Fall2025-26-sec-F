<?php
include 'db.php';
$id = $_GET['id'];
if ($conn->query("DELETE FROM students WHERE id=$id")) {
    echo "<script>alert('Record Deleted!'); window.location='view_students.php';</script>";
}
?>