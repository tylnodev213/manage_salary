<?php
if(isset($_POST['name_department'])){
    $name_department = $_POST['name_department'];
}
include '../conn.php';
$sql = "INSERT INTO phongBan(tenPhong) 
VALUES ('$name_department')";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/department.php");