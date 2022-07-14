<?php
$id='';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$search = $_GET['search'] ?? '';
$search1 = $_GET['search1'] ?? '';
$p = $_GET['p'] ?? 1;
$p2 = $_GET['p2'] ?? 1;
include '../conn.php';
$sql = "DELETE FROM luong WHERE idChamCong= $id";
mysqli_query($connect, $sql);
$sql = "DELETE FROM chamCong WHERE id = $id";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/timekeeping.php?p=$p&p2=$p2&search=$search&search1=$search1");
