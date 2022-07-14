<?php
$id='';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$search = $_GET['search'] ?? '';
$p = $_GET['p'] ?? 1;
include '../conn.php';
$sql = "DELETE FROM baoHiem WHERE id = '$id'";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/insurance.php?search=$search&p=$p");
