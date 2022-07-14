<?php
$id='';
if(isset($_POST['id'])){
    $id = $_POST['id'];
}
if(isset($_POST['ngayBatDau'])){
    $ngayBatDau = $_POST['ngayBatDau'];
}
if(isset($_POST['ngayKetThuc'])){
    $ngayKetThuc = $_POST['ngayKetThuc'];
}
if(isset($_POST['luongCb'])){
    $luongCb = $_POST['luongCb'];
}
if(isset($_POST['idBaohiem'])){
    $idBaohiem = $_POST['idBaohiem'];
}
if(isset($_POST['idNhanVien'])){
    $idNhanVien = $_POST['idNhanVien'];
}
$search = $_GET['search'] ?? '';
$p2 = $_GET['p2'] ?? 1;
//Kết nối DB
include '../conn.php';
//sql
$sql = "UPDATE hopDong SET ngayBatDau = '$ngayBatDau', ngayKetThuc = '$ngayKetThuc',
luongCb = '$luongCb', idBaohiem = '$idBaohiem', idNhanVien = '$idNhanVien' 
WHERE id = $id";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/contract.php?search=$search&p2=$p2");