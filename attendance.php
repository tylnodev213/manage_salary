<?php
session_start();
$username = '';
if(isset($_POST['username'])){
    $username = $_POST['username'];
}
$password = '';
if(isset($_POST['password'])){
    $password = $_POST['password'];
}
include 'admin/conn.php';
if($username == 'admin'){
    $sql = "SELECT * FROM admin WHERE username ='$username' AND password = '$password'";
}else{
    $sql = "SELECT * FROM nhanVien WHERE username ='$username' AND password = '$password'"; 
}
$result = mysqli_query($connect,$sql);
include 'admin/dis-conn.php';
if(mysqli_num_rows($result) > 0){
    foreach( $result as $each){
        if($username == 'admin' && $password == $each['password']){
            $_SESSION['id'] = $each['id'];
            header("location:admin/index.php");
        }else if($username == $each['username'] && $password == $each['password']){
            $_SESSION['id_em'] = $each['id'];  
            include 'admin/conn.php';
            $idNhanVien = $each['id'];
            include 'setTimezone.php';
            $ngayChamCong = date("Y-m-d");
            $sql = "SELECT * FROM chamcong_chitiet WHERE idNhanVien = '$idNhanVien' AND ngayChamCong='$ngayChamCong'";
            $result = mysqli_query($connect,$sql);
            include 'admin/dis-conn.php';
            if(mysqli_num_rows($result) > 0){
                header("location:employee/index.php");
            }else{
                include 'admin/conn.php';
                $sql = "INSERT INTO chamcong_chitiet(idNhanVien,ngayChamCong) VALUES ('$idNhanVien','$ngayChamCong')";
                mysqli_query($connect,$sql);
                include 'admin/dis-conn.php';
                header("location:employee/index.php");
            }

        }
    }
}else {
    header("location:index.php?action=f");
}