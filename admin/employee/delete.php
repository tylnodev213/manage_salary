<?php
$id = $_GET['id'] ?? '';
$search = $_GET['search'] ?? '';
$p = $_GET['p'] ?? 1;
include '../conn.php';
$sql = "DELETE FROM chamCong WHERE idNhanVien = $id";
mysqli_query($connect, $sql);
$sql = "DELETE FROM hopDong WHERE idNhanVien = $id";
mysqli_query($connect, $sql);
$sql = "DELETE FROM chamcong_chitiet WHERE idNhanVien = $id";
mysqli_query($connect, $sql);
$sql = "DELETE FROM nhanVien WHERE id = $id";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("Location: http://localhost/quanliluong/admin/employee.php?search=$search&p=$p");