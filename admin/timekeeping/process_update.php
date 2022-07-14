<?php
$id='';
if(isset($_POST['id'])){
    $id = $_POST['id'];
}
$idNhanVien = $_POST['idNhanVien'] ?? '';
$idThuong = $_POST['idThuong'] ?? '';
$thang = $_POST['thang'] ?? '';
$nam = $_POST['nam'] ?? '';
$search = $_GET['search'] ?? '';
$search1 = $_GET['search1'] ?? '';
$p = $_GET['p'] ?? 1;
$p2 = $_GET['p2'] ?? 1;
//Kết nối DB
include '../conn.php';
//sql
$sql = "UPDATE chamCong SET idNhanVien = '$idNhanVien',
idThuong = '$idThuong',thang = '$thang',
nam = '$nam' WHERE id = $id";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/timekeeping.php?p=$p&p2=$p2&search=$search&search1=$search1");