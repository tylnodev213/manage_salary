<?php
$idNhanVien = $_POST['idNhanVien'] ?? '';
$idThuong = $_POST['idThuong'] ?? '';
$thang = $_POST['thang'] ?? '';
$nam = $_POST['nam'] ?? '';
include '../conn.php';
$sql = "INSERT INTO chamCong(idNhanVien,idThuong,thang,nam) 
VALUES ('$idNhanVien','$idThuong','$thang','$nam')";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/timekeeping.php");