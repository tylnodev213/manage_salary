<h5 class="title">Danh sách nhân viên chưa có hợp đồng</h5>
<div class="header_table">
    <form action="" method="get" class="input-group col-md-4">
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
        <input type="hidden" name="search" value="<?php echo $search;?>">
        <input type="search" id="form1" class="form-control" name="search1" value="<?php echo $search1;?>" placeholder="Tìm nhân viên">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>
<table width="100%" class="table table-bordered">
<thead class="thead-dark">
    <tr>
        <th>STT</th>
        <th>Tên nhân viên</th>
        <th>Ngày sinh</th>
        <th>SĐT</th>
        <th>Phòng ban</th>
        <th>Chức vụ</th>
        <th></th>
    </tr>
</thead>
    <?php
    include 'conn.php';
    $so_ban_ghi_1_trang = 4;
    if(isset($_GET['p1'])){
        $p1 = $_GET['p1'];
    }
    else {
        $p1 = 1;
    }
    $start = ($p1 - 1) * $so_ban_ghi_1_trang;
    $sql_tong_ban_ghi = "SELECT COUNT(nhanVien.id)
            AS tong_so_ban_ghi
            FROM nhanVien
            INNER JOIN phongBan
            ON phongBan.id=nhanVien.idPhongBan
            INNER JOIN chucVu
            ON chucVu.id=nhanVien.idChucVu
            WHERE NOT EXISTS 
            (SELECT * from hopDong
            WHERE nhanVien.id=hopDong.idNhanVien )
            AND nhanVien.hoten LIKE '%$search1%'";
            $result_tong_ban_ghi = mysqli_query($connect, $sql_tong_ban_ghi);
    foreach ($result_tong_ban_ghi as $each_tong_ban_ghi){
            $tong_so_ban_ghi = $each_tong_ban_ghi['tong_so_ban_ghi'];
            }
            $so_trang = ceil($tong_so_ban_ghi/$so_ban_ghi_1_trang);
                
            $sql= "SELECT nhanVien.*, phongBan.tenPhong, chucVu.chucVu FROM nhanVien
            INNER JOIN phongBan
            ON phongBan.id=nhanVien.idPhongBan
            INNER JOIN chucVu
            ON chucVu.id=nhanVien.idChucVu
            WHERE NOT EXISTS 
            (SELECT * from hopDong
            WHERE nhanVien.id=hopDong.idNhanVien )
            AND nhanVien.hoten LIKE '%$search1%'";
    $result=mysqli_query($connect,$sql);
    include 'dis-conn.php';
    if(mysqli_num_rows($result)>0){
        foreach ($result as $value => $each){?>
            <tr>
                <td><?php echo ++$value ?></td>
                <td><?php echo $each['hoTen']?></td>
                <td><?php echo $each['ngaySinh']?></td>
                <td><?php echo $each['SDT']?></td>
                <td><?php echo $each['tenPhong']?></td>
                <td><?php echo $each['chucVu']?></td>
                <td><a class="btn btn-success" href="contract/create.php?id=<?php echo $each['id']; ?>">Tạo hợp đồng</a></td>
            </tr>
        <?php
        }
    }else{
        ?><tr><td colspan="7" align="center"><?php echo "Không có kêt quả hiển thị"; ?></td></tr><?php
    }
    ?>
</table>
<div width="100%" style="text-align:center">
<a class="btn btn-light" href="?p1=<?php $p=$_GET['p1'] ?? 1; if( $p-1>0){echo $p-1;}else{echo $p;};?>&search=<?php echo $search;?>">
    Prev
</a>
<?php
    for($i = 1; $i <= $so_trang; $i++){
?>
    <a class="btn btn-light" href="?p1=<?php echo $i;?>&search=<?php echo $search;?>">
        <?php echo $i;?>
    </a>
<?php
    }
?>
<a class="btn btn-light" href="?p1=<?php $p=$_GET['p1'] ?? 1; if($p+1<=$so_trang){echo $p+1;}else{echo $p;};?>&search=<?php echo $search;?>">
    Next
</a>
</div>

<h5 class="title">Danh sách đã có hợp đồng</h5>
<div class="header_table">
    <form action="" method="get" class="input-group col-md-4">
        <input type="hidden" name="search1" value="<?php echo $search1;?>">
        <input type="search" id="form1" class="form-control" name="search" value="<?php echo $search;?>" placeholder="Tìm hợp đồng theo tên nhân viên">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>
<table width="100%" class="table table-bordered">
<thead class="thead-dark">
    <tr>
        <th>STT</th>
        <th>Tên nhân viên</th>
        <th>Ngày bắt đầu</th>
        <th>Ngày kết thúc</th>
        <th>Lương cơ bản</th>
        <th>Loại bảo hiểm</th>
        <th></th>
        <th></th>
    </tr>
</thead>
    <?php
    include 'conn.php';
    $so_ban_ghi_1_trang = 5;
    if(isset($_GET['p'])){
        $p2 = $_GET['p'];
    }
    else {
        $p2 = 1;
    }
    $start = ($p2 - 1) * $so_ban_ghi_1_trang;
    $sql_tong_ban_ghi = "SELECT COUNT(hopDong.id)
            AS tong_so_ban_ghi
    from hopDong
    INNER JOIN nhanVien
    ON nhanVien.id=hopDong.idNhanVien
    INNER JOIN baoHiem
    ON baoHiem.id=hopDong.idBaohiem 
    WHERE nhanVien.hoten LIKE '%$search%'";
      $result_tong_ban_ghi = mysqli_query($connect, $sql_tong_ban_ghi);
      foreach ($result_tong_ban_ghi as $each_tong_ban_ghi){
          $tong_so_ban_ghi = $each_tong_ban_ghi['tong_so_ban_ghi'];
      }
      $so_trang = ceil($tong_so_ban_ghi/$so_ban_ghi_1_trang);
      $sql= "SELECT hopDong.*,baoHiem.loaiBaohiem, nhanVien.hoten from hopDong
      INNER JOIN nhanVien
      ON nhanVien.id=hopDong.idNhanVien
      INNER JOIN baoHiem
      ON baoHiem.id=hopDong.idBaohiem 
      WHERE nhanVien.hoten LIKE '%$search%'
      LIMIT $start, $so_ban_ghi_1_trang";
    $result=mysqli_query($connect,$sql);
    include 'dis-conn.php';
    if(mysqli_num_rows($result)>0){
        foreach ($result as $value => $each){?>
            <tr>
                <td><?php echo ++$value ?></td>
                <td><?php echo $each['hoten']?></td>
                <td><?php echo $each['ngayBatDau']?></td>
                <td><?php echo $each['ngayKetThuc']?></td>
                <td><?php echo $each['luongCb']. "k"?></td>
                <td><?php echo $each['loaiBaohiem']?></td>
                <td><a class="btn btn-primary" href="?action=update&id=<?php echo $each['id']?>&search=<?php echo $search; ?>&p2=<?php echo $p2; ?>">Sửa</a></td>
                <td><a class="btn btn-danger" href="contract/delete.php?id=<?php echo $each['id']?>&search=<?php echo $search; ?>&p2=<?php echo $p2; ?>"><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>
            <?php
        }
    }else{
        ?><tr><td colspan="8" align="center"><?php echo "Không có kêt quả hiển thị"; ?></td></tr><?php
    }
    ?>
</table>
<div width="100%" style="text-align:center">
<a class="btn btn-light" href="?p2=<?php $p=$_GET['p2'] ?? 1; if( $p-1>0){echo $p-1;}else{echo $p;};?>&search=<?php echo $search;?>">
    Prev
</a>
<?php
    for($i = 1; $i <= $so_trang; $i++){
?>
    <a class="btn btn-light" href="?p2=<?php echo $i;?>&search=<?php echo $search;?>">
        <?php echo $i;?>
    </a>
<?php
    }
?>
<a class="btn btn-light" href="?p2=<?php $p=$_GET['p2'] ?? 1; if($p+1<=$so_trang){echo $p+1;}else{echo $p;};?>&search=<?php echo $search;?>">
    Next
</a>
</div>
