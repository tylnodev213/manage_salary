<?php
if(isset($_POST['money_gift'])){
    $money_gift = $_POST['money_gift'];
}
include '../conn.php';
$sql = "INSERT INTO thuong(tienThuong) 
VALUES ('$money_gift')";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/gift.php");