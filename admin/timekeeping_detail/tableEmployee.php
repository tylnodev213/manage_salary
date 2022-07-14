<h5 class="title">Danh sách nhân viên</h5>
<div class="search_box">
    <form action="" method="get" class="input-group">
        <?php 
            $search ="";
            if(isset($_GET["search"])){
                $search=$_GET["search"];
            }
        ?>
        <input type="hidden" name="action" value="tableEmployee">
        <input type="search" id="form1" class="form-control" name="search" value="<?php echo $search;?>" placeholder="Tìm nhân viên">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </form>
</div>
<table width="100%" class="table table-bordered">
<thead class="thead-dark">
    <tr>
        <th>STT</th>
        <th>Họ tên</th>
        <th>Ngày sinh</th>
        <th>Sđt</th>
        <th>Địa chỉ</th>
        <th>Phòng ban</th>
        <th>Chức vụ</th>
        <th></th>
    </tr>
</thead>
    <?php 
        include 'conn.php';
        $so_ban_ghi_1_trang = 9;
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
                WHERE nhanVien.hoTen LIKE '%$search%'
                OR nhanVien.SDT LIKE '%$search%'";
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
         WHERE nhanVien.hoTen LIKE '%$search%'
         OR nhanVien.SDT LIKE '%$search%'
         LIMIT $start, $so_ban_ghi_1_trang";
        $result = mysqli_query($connect, $sql);
        include 'dis-conn.php';
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
                <?php echo $each['diachi']?>
            </td>
            <td>
                <?php echo $each['tenPhong']?>
            </td>
            <td>
                <?php echo $each['chucVu']?>
            </td>
            <td>
                <a class="btn btn-success" href="timekeeping_detail/create.php?id=<?php echo $each['id']?>&search=<?php echo $search; ?>">Bổ sung chấm công</a>
            </td>
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
<a class="title" href="timekeeping_detail.php">Quay lại</a>