<?php
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
include '../conn.php';
$sql = "INSERT INTO hopDong(ngayBatDau,ngayKetThuc,luongCb,idBaohiem,idNhanVien) 
VALUES ('$ngayBatDau','$ngayKetThuc','$luongCb','$idBaohiem','$idNhanVien')";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/contract.php");