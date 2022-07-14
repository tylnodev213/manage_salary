<?php
session_start();
$id = $_POST['id'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$name = $_POST['name'] ?? '';
$dob = $_POST['dob'] ?? '';
$gt = $_POST['gt'] ?? '';
$phone = $_POST['phone'] ?? '';
$address = $_POST['address'] ?? '';
$id_department = $_POST['id_department'] ?? '';
$id_position = $_POST['id_position'] ?? '';
$trangThai = $_POST['trangThai'] ?? '';
$search = $_GET['search'] ?? '';
$p = $_GET['p'] ?? 1;
include '../conn.php';
$sql = "UPDATE nhanVien SET hoTen = '$name', ngaySinh = '$dob',gioiTinh = '$gt', SDT = '$phone', diachi = '$address'
, idPhongBan = '$id_department', idChucVu = '$id_position', username = '$username', password = '$password',
trangThai = '$trangThai' WHERE id = '$id'";
mysqli_query($connect, $sql);
include '../dis-conn.php';
if(!isset($_SESSION['id_em'])){
    header("Location: http://localhost/quanliluong/admin/employee.php?search=$search&p=$p");
}else{
    header("Location: http://localhost/quanliluong/employee/index.php?action=info.php");
}
