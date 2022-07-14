<?php
$id='';
if(isset($_POST['id'])){
    $id = $_POST['id'];
}
if(isset($_POST['money_gift'])){
    $money_gift = $_POST['money_gift'];
}
$search=$_get['search'] ?? '';
$p=$_GET['p'] ?? 1;
//Kết nối DB
include '../conn.php';
//sql
$sql = "UPDATE thuong SET tienThuong = '$money_gift' WHERE id = $id";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/gift.php?search=$search&p=$p");