<?php
$id='';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$thang = $_GET['thang'] ?? '';
$nam = $_GET['nam'] ?? '';
$search = $_GET['search'] ?? '';
include '../conn.php';
$sql = "DELETE FROM chamcong_chitiet WHERE id = $id";
mysqli_query($connect, $sql);
include '../dis-conn.php';
header("location:http://localhost/quanliluong/admin/timekeeping_detail.php?search=$search&thang=$thang&nam=$nam");