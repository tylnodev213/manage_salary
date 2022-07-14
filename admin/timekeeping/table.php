<h5 class="title">CHẤM CÔNG THÁNG <?php echo date("n", strtotime("first day of previous month"));?> NĂM <?php echo date("Y", strtotime("first day of previous month")); ?></h5>
<div class="header_table">
<div class="search_box">
<form action="" method="get" class="input-group">
    <?php 
        $search ="";
        if(isset($_GET["search"])){
            $search=$_GET["search"];
        }
        $search1 ="";
        if(isset($_GET["search1"])){
            $search1=$_GET["search1"];
        }
    ?>
    <input type="hidden" name="search1" value="<?php echo $search1; ?>">
    <input type="search" id="form1" class="form-control" name="search" value="<?php echo $search;?>" placeholder="Tìm nhân viên">
    <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
</form>
</div>
</div>
<table width="100%" class="table table-bordered">
<thead class="thead-dark">
    <tr>
        <th>STT</th>
        <th>Họ tên</th>
        <th>Ngày sinh</th>
        <th>Sđt</th>
        <th>Phòng ban</th>
        <th>Chức vụ</th>
        <th></th>
    </tr>
</thead>
    <?php
        include '../setTimezone.php';
        $thang =  date("n", strtotime("first day of previous month"));
        $nam = date("Y", strtotime("first day of previous month"));
        include "conn.php";
        $so_ban_ghi_1_trang = 4;
        if(isset($_GET['p'])){
            $p = $_GET['p'];
        }
        else {
            $p = 1;
        }
        $start = ($p - 1) * $so_ban_ghi_1_trang;
        $sql_tong_ban_ghi = "SELECT COUNT(nhanVien.id)
                AS tong_so_ban_ghi
                FROM nhanVien 
                INNER JOIN phongBan
                ON nhanVien.idPhongBan = phongBan.id
                INNER JOIN chucVu
                ON nhanVien.idChucVu = chucVu.id
                WHERE NOT EXISTS (SELECT * FROM chamCong
                WHERE chamCong.idNhanVien = nhanVien.id
                AND chamCong.thang = '$thang' AND chamCong.nam = '$nam')
                AND EXISTS (SELECT * FROM hopDong
                WHERE hopDong.idNhanVien = nhanVien.id)
                AND nhanVien.hoTen LIKE '%$search%'";
         $result_tong_ban_ghi = mysqli_query($connect, $sql_tong_ban_ghi);
        foreach ($result_tong_ban_ghi as $each_tong_ban_ghi){
            $tong_so_ban_ghi = $each_tong_ban_ghi['tong_so_ban_ghi'];
        }
        $so_trang = ceil($tong_so_ban_ghi/$so_ban_ghi_1_trang);
        $sql = "SELECT nhanVien.*, phongBan.tenPhong, chucVu.chucVu 
        FROM nhanVien 
        INNER JOIN phongBan
        ON nhanVien.idPhongBan = phongBan.id
        INNER JOIN chucVu
        ON nhanVien.idChucVu = chucVu.id
        WHERE NOT EXISTS (SELECT * FROM chamCong
        WHERE chamCong.idNhanVien = nhanVien.id
        AND chamCong.thang = '$thang' AND chamCong.nam = '$nam')
        AND EXISTS (SELECT * FROM hopDong
        WHERE hopDong.idNhanVien = nhanVien.id)
        AND nhanVien.trangThai = 1
        AND nhanVien.hoTen LIKE '%$search%'
        LIMIT $start, $so_ban_ghi_1_trang";
        $result = mysqli_query($connect, $sql);
        include 'dis-conn.php';
        if(mysqli_num_rows($result)>0){
            foreach($result as $value => $each){
                ?>
                    <tr>
                        <td>
                            <?php echo ++$value ?>
                        </td>
                        <td>
                            <?php echo $each['hoTen']?>
                        </td>
                        <td>
                            <?php echo $each['ngaySinh']?>
                        </td>
                        <td>
                            <?php echo $each['SDT']?>
                        </td>
                        <td>
                            <?php echo $each['tenPhong']?>
                        </td>
                        <td>
                            <?php echo $each['chucVu']?>
                        </td>
                        <td>
                            <a class="btn btn-success" href="?action=create&id=<?php echo $each['id']?>">Chấm công</a>
                        </td>
                    </tr>
                <?php
            }
        }else{
            ?>
            <td colspan="7" align="center">
                  Không có dữ liệu          
            </td>
            <?php
        }    
    ?>
</table>
<div width="100%" style="text-align:center">
<a class="btn btn-light" href="?p=<?php $p=$_GET['p'] ?? 1; if( $p-1>0){echo $p-1;}else{echo $p;};?>&search=<?php echo $search;?>">
    Prev
</a>
<?php
    for($i = 1; $i <= $so_trang; $i++){
?>
    <a class="btn btn-light" href="?p=<?php echo $i;?>&search=<?php echo $search;?>">
        <?php echo $i;?>
    </a>
<?php
    }
?>
<a class="btn btn-light" href="?p=<?php $p=$_GET['p'] ?? 1; if($p+1<=$so_trang){echo $p+1;}else{echo $p;};?>&search=<?php echo $search;?>">
    Next
</a>
</div>
<h5 class="title">ĐÃ CHẤM CÔNG THÁNG <?php echo date("n", strtotime("first day of previous month"));?> NĂM <?php echo date("Y", strtotime("first day of previous month")); ?></h5>
<div class="header_table">
    <div  class="search_box">
    <form action="" method="get" class="input-group">
        <input type="hidden" name="search" value="<?php echo $search; ?>">
        <input type="search" id="form1" class="form-control" name="search1" value="<?php echo $search1;?>" placeholder="Tìm nhân viên">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>
    </div>
</div>

<table width="100%" class="table table-bordered">
<thead class="thead-dark">
    <tr>
        <th>STT</th>
        <th>Họ tên</th>
        <th>SĐT</th>
        <th>Phòng ban</th>
        <th>Chức vụ</th>
        <th>Lương</th>
        <th>Bảo hiểm</th>
        <th>Thưởng</th>
        <th>Thực lương</th>
        <th></th>
        <th></th>
    </tr>
</thead> 
    <?php 
        include 'conn.php';
        $so_ban_ghi_1_trang = 4;
        if(isset($_GET['p2'])){
            $p2 = $_GET['p2'];
        }
        else {
            $p2 = 1;
        }
        $start = ($p2 - 1) * $so_ban_ghi_1_trang;
        $sql_tong_ban_ghi = "SELECT COUNT(nhanVien.id)
                AS tong_so_ban_ghi
                FROM nhanVien
                INNER JOIN chamCong
                ON chamCong.idNhanVien=nhanVien.id 
                INNER JOIN phongBan
                ON nhanVien.idPhongBan = phongBan.id
                INNER JOIN chucVu
                ON nhanVien.idChucVu = chucVu.id
                WHERE chamCong.thang = '$thang' AND chamCong.nam = '$nam'
                AND EXISTS (SELECT * FROM hopDong
                WHERE hopDong.idNhanVien = nhanVien.id)
                AND nhanVien.hoTen LIKE '%$search1%'";
         $result_tong_ban_ghi = mysqli_query($connect, $sql_tong_ban_ghi);
        foreach ($result_tong_ban_ghi as $each_tong_ban_ghi){
            $tong_so_ban_ghi = $each_tong_ban_ghi['tong_so_ban_ghi'];
        }
        $so_trang = ceil($tong_so_ban_ghi/$so_ban_ghi_1_trang);
        $sql = "SELECT chamCong.*, nhanVien.hoTen,nhanVien.SDT, phongBan.tenPhong, chucVu.chucVu 
        FROM nhanVien
        INNER JOIN chamCong
        ON chamCong.idNhanVien=nhanVien.id 
        INNER JOIN phongBan
        ON nhanVien.idPhongBan = phongBan.id
        INNER JOIN chucVu
        ON nhanVien.idChucVu = chucVu.id
        WHERE chamCong.thang = '$thang' AND chamCong.nam = '$nam'
        AND EXISTS (SELECT * FROM hopDong
        WHERE hopDong.idNhanVien = nhanVien.id)
        AND nhanVien.hoTen LIKE '%$search1%'
        LIMIT $start, $so_ban_ghi_1_trang";
        $result = mysqli_query($connect, $sql);
        include 'dis-conn.php';
        if(mysqli_num_rows($result)==0){
            ?>
            <td align="center" colspan="11">Không có dữ liệu</td>
            <?php
        }else{
        foreach($result as $value => $each){
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
            $thucLuong = $luong-$baoHiem+$tienThuong;
            include 'conn.php';
            $sql="SELECT idChamCong FROM luong WHERE idChamCong='".$each['id']."'";
            $result = mysqli_query($connect,$sql);
            if(mysqli_num_rows($result)==0){
                $sql = "INSERT INTO luong(idChamCong,thucLuong)
                VALUES('".$each['id']."','$thucLuong')";
                mysqli_query($connect,$sql);
            }
            include 'dis-conn.php';
    ?>
        <tr>
            <td>
                <?php echo ++$value ?>
            </td>
            <td>
                <?php echo $each['hoTen']?>
            </td>
            <td>
                <?php echo $each['SDT']?>
            </td>
            <td>
                <?php echo $each['tenPhong']?>
            </td>
            <td>
                <?php echo $each['chucVu']?>
            </td>
            <td>
                <?php echo $luong; ?>
            </td>
            <td>
                <?php echo $baoHiem; ?>
            </td>
            <td>
                <?php echo $tienThuong; ?>
            </td>
            <td>
                <?php echo $thucLuong ?>
            </td>
            <td>
                <a class="btn btn-primary" href="?action=update&id=<?php echo $each['id']?>&search=<?php echo $search;?>&search1=<?php echo $search1;?>&p=<?php echo $p; ?>&p2=<?php echo $p2; ?>">Sửa</a>
            </td>
            <td>
                <a class="btn btn-danger" href="timekeeping/delete.php?id=<?php echo $each['id']?>&search=<?php echo $search;?>&search1=<?php echo $search1;?>&p=<?php echo $p; ?>&p2=<?php echo $p2; ?>"><i class="fa-solid fa-trash-can"></i></a>
            </td>
        </tr>
    <?php
        }
    }
    ?>
</table>
<div width="100%" style="text-align:center">
<a class="btn btn-light" href="?p2=<?php $p=$_GET['p2'] ?? 1; if( $p2-1>0){echo $p2-1;}else{echo $p2;};?>&p=<?php echo $p;?>&search1=<?php echo $search1;?>&search=<?php echo $search;?>">
    Prev
</a>
<?php
    for($i = 1; $i <= $so_trang; $i++){
?>
    <a class="btn btn-light" href="?p2=<?php echo $i;?>&p=<?php echo $p;?>&search1=<?php echo $search1;?>&search=<?php echo $search;?>">
        <?php echo $i;?>
    </a>
<?php
    }
?>
<a class="btn btn-light" href="?p2=<?php $p=$_GET['p2'] ?? 1; if($p2+1<=$so_trang){echo $p2+1;}else{echo $p2;};?>&p=<?php echo $p;?>&search1=<?php echo $search1;?>&search=<?php echo $search;?>">
    Next
</a>
</div>
<a href="salary.php" class="btn btn-primary">Lưu bảng lương</a>
