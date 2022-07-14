<?php
$id='';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$search = $_GET['search'] ?? '';
$p2 = $_GET['p2'] ?? 1;
include '../conn.php';
$sql = "DELETE FROM hopDong WHERE id = $id";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/contract.php?search=$search&p2=$p2");
