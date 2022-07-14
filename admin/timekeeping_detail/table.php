<h5 class="title">Lịch sử chấm công chi tiết</h5>
<div class="header_table">
<a class="btn btn-success" href ="timekeeping_detail.php?action=tableEmployee">Thêm chấm công mới</a>
<div class="search_box">
<form action="" method="get" class="input-group">
    <?php 
        $search ="";
        if(isset($_GET["search"])){
            $search=$_GET["search"];
        } 
        $thang = date("m");
        if(isset($_GET["thang"])){
            $thang=$_GET["thang"];
        }
        $nam =date("Y");
        if(isset($_GET["nam"])){
            $nam=$_GET["nam"];
        }
    ?>
    <input type="hidden" name="thang" value="<?php echo $thang; ?>">
    <input type="hidden" name="nam" value="<?php echo $nam; ?>">
    <input type="search" id="form1" class="form-control" name="search" value="<?php echo $search;?>" placeholder="Tìm theo tên, sdt">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-search"></i>
    </button>
</form>
</div>
</div>
<div class="header_table">
<h5>Tìm chấm công theo tháng</h5>
<div class="search_box">
<form action="" method="get" class="input-group">
    <input type="hidden" name="search" value="<?php echo $search; ?>">
    <input type="number" name="thang" value="<?php echo $thang;?>" placeholder="Nhập tháng">
    <input type="number" name="nam" value="<?php echo $nam;?>" placeholder="Nhập năm">
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
        <th>Tên nhân viên</th>
        <th>SĐT</th>
        <th>Ngày chấm công</th>
        <th></th>
        <th></th>
    </tr>
</thead> 
    <?php
    include 'conn.php';
    include '../setTimezone.php';
    $so_ban_ghi_1_trang = 10;
    if(isset($_GET['p'])){
        $p = $_GET['p'];
    }
    else {
        $p = 1;
    }
    $start = ($p - 1) * $so_ban_ghi_1_trang;
    $sql_tong_ban_ghi = "SELECT COUNT(chamcong_chitiet.id)
            AS tong_so_ban_ghi
    from chamcong_chitiet
    INNER JOIN nhanVien
    ON nhanVien.id = chamcong_chitiet.idNhanVien
    WHERE (nhanVien.hoTen LIKE '%$search%' OR nhanVien.SDT LIKE '%$search%')
    AND MONTH(chamcong_chitiet.ngayChamCong) = '$thang' AND YEAR(chamcong_chitiet.ngayChamCong) = '$nam'
    ORDER BY chamcong_chitiet.ngayChamCong DESC, nhanVien.hoTen ASC";
     $result_tong_ban_ghi = mysqli_query($connect, $sql_tong_ban_ghi);
     foreach ($result_tong_ban_ghi as $each_tong_ban_ghi){
         $tong_so_ban_ghi = $each_tong_ban_ghi['tong_so_ban_ghi'];
     }
     $so_trang = ceil($tong_so_ban_ghi/$so_ban_ghi_1_trang);
    $sql= "SELECT chamcong_chitiet.*, nhanVien.hoTen, nhanVien.SDT from chamcong_chitiet
    INNER JOIN nhanVien
    ON nhanVien.id = chamcong_chitiet.idNhanVien
    WHERE (nhanVien.hoTen LIKE '%$search%' OR nhanVien.SDT LIKE '%$search%')
    AND MONTH(chamcong_chitiet.ngayChamCong) = '$thang' AND YEAR(chamcong_chitiet.ngayChamCong) = '$nam'
    ORDER BY chamcong_chitiet.ngayChamCong DESC, nhanVien.hoTen ASC
    LIMIT $start, $so_ban_ghi_1_trang";
    $result=mysqli_query($connect,$sql);
    include 'dis-conn.php';
    foreach ($result as $value => $each){?>
    <tr>
        <td><?php echo ++$value ?></td>
        <td><?php echo $each['hoTen']; ?></td>
        <td><?php echo $each['SDT']; ?></td>
        <td><?php echo $each['ngayChamCong']; ?></td>
        <td><a class="btn btn-primary" href="timekeeping_detail/update.php?id=<?php echo $each['id']?>&p=<?php echo $p; ?>&search=<?php echo $search; ?>&thang=<?php echo $thang; ?>&nam=<?php echo $nam; ?>">Sửa</a></td>
        <td><a class="btn btn-danger" href="timekeeping_detail/delete.php?id=<?php echo $each['id']?>&p=<?php echo $p; ?>&search=<?php echo $search; ?>&thang=<?php echo $thang; ?>&nam=<?php echo $nam; ?>"><i class="fa-solid fa-trash-can"></i></a></td>
    </tr>
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