<?php
if(isset($_POST['name_position'])){
    $name_position = $_POST['name_position'];
}
include '../conn.php';
$sql = "INSERT INTO chucVu(chucVu) 
VALUES ('$name_position')";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/position.php");