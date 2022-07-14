<?php

// Include Database connection
include("conn.php");
// Include SimpleXLSXGen library
include("../SimpleXLSXGen.php");
$salary = [
  ['STT', 'Tên nhân viên', 'SĐT', 'Phòng ban', 'Chức vụ', 'Lương', 'Bảo hiểm', 'Thưởng', 'Thực lương']
];
$thang = date("n", strtotime("first day of previous month"));
$nam = date("Y", strtotime("first day of previous month"));
$sql = "SELECT luong.*,nhanVien.hoTen,nhanVien.id as idNhanVien,
nhanVien.SDT, phongBan.tenPhong, 
chucVu.chucVu, baoHiem.tienBaohiem, thuong.tienThuong  FROM nhanVien 
INNER JOIN chamCong
ON nhanVien.id=chamCong.idNhanVien
INNER JOIN thuong
ON thuong.id=chamCong.idThuong
INNER JOIN phongBan
ON nhanVien.idPhongBan=phongBan.id
INNER JOIN chucVu
ON nhanVien.idChucVu=chucVu.id
INNER JOIN hopDong
ON hopDong.idNhanVien=nhanVien.id
INNER JOIN baoHiem
ON hopDong.idBaohiem=baoHiem.id
INNER JOIN luong
ON luong.idChamCong=chamCong.id
WHERE chamCong.thang='$thang' AND
chamCong.nam ='$nam'";
$res = mysqli_query($connect, $sql);
if (mysqli_num_rows($res) > 0) {
  foreach ($res as $value => $each) {
    include "conn.php";
            $sql = "SELECT luongCb FROM hopdong where idNhanVien = '".$each['idNhanVien']."'";
            $result = mysqli_query($connect,$sql);
            include 'dis-conn.php';
            foreach($result as $row){
                $luongCb = $row['luongCb'];
            }
            include 'conn.php';
            $first_day = date("Y-n-j", strtotime("first day of previous month"));
            $last_day = date("Y-n-j", strtotime("last day of previous month"));
            $sql = "SELECT COUNT(ngayChamCong) as total_date FROM chamcong_chitiet where ngayChamCong between '$first_day' and '$last_day'
            AND chamcong_chitiet.idNhanVien = '".$each['idNhanVien']."'";
            $result = mysqli_query($connect,$sql);
            include 'dis-conn.php';
            foreach($result as $row){
                $total_date = $row['total_date'];
            }
            include "conn.php";
            $sql = "SELECT baoHiem.tienBaohiem FROM hopdong
            INNER JOIN nhanVien
            ON nhanVien.id=hopDong.idNhanVien
            INNER JOIN baoHiem
            ON baoHiem.id = hopDong.idBaohiem where hopDong.idNhanVien = '".$each['idNhanVien']."'";
            $result = mysqli_query($connect,$sql);
            include 'dis-conn.php';
            foreach($result as $row){
                $tienBaohiem = $row['tienBaohiem'];
            }
            include "conn.php";
            $sql = "SELECT thuong.tienThuong FROM chamCong
            INNER JOIN thuong
            ON thuong.id=chamCong.idThuong
            where chamCong.idNhanVien = ".$each['idNhanVien']." AND thang= ".date("n", strtotime("first day of previous month"))." AND nam = ".date("Y", strtotime("first day of previous month"))."";
            $result = mysqli_query($connect,$sql);
            include 'dis-conn.php';
            foreach($result as $row){
                $tienThuong = $row['tienThuong'];
            }
            $luong = $luongCb*$total_date;
            $baoHiem=$luongCb*$total_date*$tienBaohiem/100;
    $salary = array_merge($salary, array(array(++$value, $each['hoTen'], $each['SDT'], $each['tenPhong']
    , $each['chucVu'],$luong,$baoHiem, $each['tienThuong'], $each['thucLuong'])));
  }
}
$fileName = "Bảng lương tháng ".date("n/Y", strtotime("first day of previous month"))." oceancompany";

$xlsx = SimpleXLSXGen::fromArray($salary);
$xlsx->downloadAs($fileName.'.xlsx'); // This will download the file to your local system

// $xlsx->saveAs('salary.xlsx'); // This will save the file to your server

echo "<pre>";
print_r($salary);