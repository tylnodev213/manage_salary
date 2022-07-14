<?php
    $username ='';
    if(isset($_POST['username'])){
        $username =$_POST['username'];
    }
    $password ='';
    if(isset($_POST['password'])){
        $password =$_POST['password'];
    }
    $gioiTinh = $_POST['gt'] ?? '0';
    $name =''; 
    if(isset($_POST['name'])){
        $name =$_POST['name'];
    }
    $dob ='';
    if(isset($_POST['dob'])){
        $dob =$_POST['dob'];
    }
    $phone ='';
    if(isset($_POST['phone'])){
        $phone =$_POST['phone'];
    }
    $address ='';
    if(isset($_POST['address'])){
        $address =$_POST['address'];
    }
    $id_department ='';
    if(isset($_POST['id_department'])){
        $id_department =$_POST['id_department'];
    }
    $id_position ='';
    if(isset($_POST['id_position'])){
        $id_position =$_POST['id_position'];
    }
    include '../conn.php';
    $sql = "SELECT * FROM nhanVien 
    INNER JOIN phongBan
    ON phongBan.id= nhanVien.idPhongBan
    INNER JOIN chucVu
    ON chucVu.id= nhanVien.idChucVu
    WHERE (phongBan.id ='$id_department' AND chucVu.chucVu='Trưởng phòng') OR nhanVien.username='$username'";
    $result = mysqli_query($connect,$sql);
    include '../dis-conn.php';
    if(mysqli_num_rows($result)>0){
        foreach($result as $row){
            if($row['chucVu']!='Trưởng phòng'){
                header("location:http://localhost/quanliluong/admin/employee/create.php?error=dup");
            }else{
                include '../conn.php';
        $sql = "INSERT INTO nhanVien(hoTen, ngaySinh, SDT, diachi, idPhongBan, idChucVu, username, password,trangThai,gioiTinh)
                VALUES ('$name', '$dob', '$phone', '$address', '$id_department', '$id_position', '$username', '$password','1','$gioiTinh')";
        mysqli_query($connect, $sql);
        include '../dis-conn.php';
        header("location:http://localhost/quanliluong/admin/employee.php");
            }
        }
    }else{
        include '../conn.php';
        $sql = "INSERT INTO nhanVien(hoTen, ngaySinh, SDT, diachi, idPhongBan, idChucVu, username, password,trangThai,gioiTinh)
                VALUES ('$name', '$dob', '$phone', '$address', '$id_department', '$id_position', '$username', '$password','1','$gioiTinh')";
        mysqli_query($connect, $sql);
        include '../dis-conn.php';
        header("location:http://localhost/quanliluong/admin/employee.php");
    }