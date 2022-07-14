<?php
$id='';
if(isset($_POST['id'])){
    $id = $_POST['id'];
}
if(isset($_POST['name_department'])){
    $name_department = $_POST['name_department'];
}

$search = $_GET['search'] ?? '';
$p = $_GET['p'] ?? '';
//Kết nối DB
include '../conn.php';
//sql
$sql = "UPDATE phongBan SET tenPhong = '$name_department' WHERE id = $id";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/department.php?search=$search&p=$p");