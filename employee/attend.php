<?php
session_start();
$idNhanVien = $_SESSION['id_em'];
include '../admin/conn.php';
include '../setTimezone.php';
$ngayChamCong = date("Y-m-d");
$sql = "SELECT * FROM chamcong_chitiet WHERE idNhanVien = '$idNhanVien' AND ngayChamCong='$ngayChamCong'";
$result = mysqli_query($connect,$sql);
include '../admin/dis-conn.php';
if(mysqli_num_rows($result) > 0){
    header("location:index.php?check=dup");
}else{
    include '../admin/conn.php';
    $sql = "INSERT INTO chamcong_chitiet(idNhanVien,ngayChamCong) VALUES ('$idNhanVien','$ngayChamCong')";
    mysqli_query($connect,$sql);
    include '../admin/dis-conn.php';
    header("location:index.php?check=t");
}