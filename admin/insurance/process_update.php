<?php
$id='';
if(isset($_POST['id'])){
    $id = $_POST['id'];
}
if(isset($_POST['name_insurance'])){
    $name_insurance = $_POST['name_insurance'];
}
if(isset($_POST['money_insurance'])){
    $money_insurance = $_POST['money_insurance'];
}
$search = $_GET['search'] ?? '';
$p = $_GET['p'] ?? 1;
//Kết nối DB
include '../conn.php';
//sql
$sql = "UPDATE baoHiem SET loaiBaohiem = '$name_insurance', tienBaohiem = '$money_insurance' WHERE id = '$id'";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/insurance.php?search=$search&p=$p");