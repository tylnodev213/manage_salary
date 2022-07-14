<?php
if(isset($_POST['idNhanVien'])){
    $idNhanVien = $_POST['idNhanVien'];
}
if(isset($_POST['ngayChamCong'])){
    $ngayChamCong = $_POST['ngayChamCong'];
}
$return = $_GET['return'] ?? "";
include '../conn.php';
$sql = "SELECT * FROM chamcong_chitiet
WHERE idNhanVien = '$idNhanVien' AND ngayChamCong = '$ngayChamCong'";
$result=mysqli_query($connect, $sql);
include '../dis-conn.php';
if(mysqli_num_rows($result)<=0){
    include '../conn.php';
    $sql = "INSERT INTO chamcong_chitiet(idNhanVien,ngayChamCong) 
    VALUES ('$idNhanVien','$ngayChamCong')";
    mysqli_query($connect, $sql);
    include '../dis-conn.php';
    if($return == 'y'){
        header("location:http://localhost/quanliluong/admin/timekeeping_detail/create.php?id=$idNhanVien");
    }else{
        header("location:http://localhost/quanliluong/admin/timekeeping_detail.php");
    }
}else{
    header("location:http://localhost/quanliluong/admin/timekeeping_detail/create.php?action=dup&id=$idNhanVien");
}