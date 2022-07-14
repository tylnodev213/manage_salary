<?php
if(isset($_POST['name_insurance'])){
    $name_insurance = $_POST['name_insurance'];
}
if(isset($_POST['money_insurance'])){
    $money_insurance = $_POST['money_insurance'];
}
include '../conn.php';
$sql = "INSERT INTO baoHiem(loaiBaohiem,tienBaohiem) 
VALUES ('$name_insurance','$money_insurance')";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/insurance.php");