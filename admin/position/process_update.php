<?php
$id='';
if(isset($_POST['id'])){
    $id = $_POST['id'];
}
if(isset($_POST['name_position'])){
    $name_position = $_POST['name_position'];
}
$search = $_GET['search'] ?? '';
$p = $_GET['p'] ?? 1;
//Kết nối DB
include '../conn.php';
//sql
$sql = "UPDATE chucVu SET chucVu = '$name_position' WHERE id = '$id'";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location: http://localhost/quanliluong/admin/position.php?search=$search&p=$p");