<h5 class="title">Danh sách nhân viên</h5>
<div class="header_table">
    <a class="btn btn-success" href="employee/create.php">Thêm nhân viên</a>
    <div class="search_box">
        <form action="" method="get" class="input-group">
            <?php 
                $search ="";
                if(isset($_GET["search"])){
                    $search=$_GET["search"];
                }
            ?>
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
        <th>Giới tính</th>
        <th>Sđt</th>
        <th>Địa chỉ</th>
        <th>Phòng ban</th>
        <th>Chức vụ</th>
        <th>username</th>
        <th>password</th>
        <th>Trạng thái</th>
        <th></th>
        <th></th>
    </tr>
</thead>
    <?php 
        include 'conn.php';
        $so_ban_ghi_1_trang = 10;
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
                <?php 
                if($each['gioiTinh']==1){
                     echo "Nam";
                }else if($each['gioiTinh']==0){
                    echo "Nữ";
                }else{
                    echo "Không xác định";
                }
                ?>
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
                <?php echo $each['username']?>
            </td>
            <td>
                <?php echo $each['password']?>
            </td>
            <td style="text-align:center;">
                <?php if($each['trangThai']==1){
                    ?>
                <i style="color:green;" class="fa-solid fa-circle-check"></i>
                    <?php
                    }else{
                    ?>
                <i style="color:red;" class="fa-solid fa-circle-xmark"></i>
                    <?php
                    }
                ?>
            </td>
            <td>
                <a class="btn btn-primary" href="employee/update.php?id=<?php echo $each['id']?>&search=<?php echo $search; ?>&p=<?php echo $p; ?>">Sửa</a>
            </td>
            <td>
                <a class="btn btn-danger" href="employee/delete.php?id=<?php echo $each['id']?>&search=<?php echo $search; ?>&p=<?php echo $p; ?>"><i class="fa-solid fa-trash-can"></i></a>
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