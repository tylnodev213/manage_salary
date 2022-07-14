<?php
$id='';
if(isset($_POST['id'])){
    $id = $_POST['id'];
}
$idNhanVien ='';
if(isset($_POST['idNhanVien'])){
    $idNhanVien = $_POST['idNhanVien'];
}
$ngayChamCong = '';
if(isset($_POST['ngayChamCong'])){
    $ngayChamCong = $_POST['ngayChamCong'];
}
$search = $_GET['search'] ?? '';
$p = $_GET['p'] ?? 1;
$thang = $_GET['thang'] ?? date("m");
$nam = $_GET['nam'] ?? date("Y");
//Kết nối DB
include '../conn.php';
//sql
$sql = "UPDATE chamcong_chitiet SET ngayChamCong = '$ngayChamCong' WHERE id = $id";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/timekeeping_detail.php?p=$p&search=$search&thang=$thang&nam=$nam");