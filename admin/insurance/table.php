<h5 class="title">Danh sách bảo hiểm</h5>
<div class="header_table">
    <a class="btn btn-success" href="?action=create">Tạo bảo hiểm mới</a>
    <div class="search_box">
    <form action="" method="get" class="input-group">
        <?php 
            $search ="";
            if(isset($_GET["search"])){
                $search=$_GET["search"];
            }
        ?>
        <input type="search" id="form1" class="form-control" name="search" value="<?php echo $search;?>" placeholder="Tìm loại bảo hiểm">
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
        <th>Loại bảo hiểm</th>
        <th>Tiền bảo hiểm</th>
        <th></th>
        <th></th>
    </tr>
</thead>
    <?php
    include 'conn.php';
    $so_ban_ghi_1_trang = 5;
    if(isset($_GET['p'])){
        $p = $_GET['p'];
    }
    else {
        $p = 1;
    }
    $start = ($p - 1) * $so_ban_ghi_1_trang;
    $sql_tong_ban_ghi = "SELECT COUNT(id)
            AS tong_so_ban_ghi
            FROM baoHiem
            WHERE baoHiem.loaiBaoHiem LIKE '%$search%'";
    $result_tong_ban_ghi = mysqli_query($connect, $sql_tong_ban_ghi);
    foreach ($result_tong_ban_ghi as $each_tong_ban_ghi){
        $tong_so_ban_ghi = $each_tong_ban_ghi['tong_so_ban_ghi'];
    }
    $so_trang = ceil($tong_so_ban_ghi/$so_ban_ghi_1_trang);
    $sql= "SELECT * from baoHiem WHERE loaiBaohiem  LIKE '%$search%'
    LIMIT $start, $so_ban_ghi_1_trang";
    $result=mysqli_query($connect,$sql);
    include 'dis-conn.php';
    foreach ($result as $value => $each){?>
    <tr>
        <td><?php echo ++$value ?></td>
        <td><?php echo $each['loaiBaohiem']?></td>
        <td><?php echo $each['tienBaohiem']." %"?></td>
        <td><a class="btn btn-primary" href="?action=update&id=<?php echo $each['id']?>&search=<?php echo $search; ?>&p=<?php echo $p; ?>">Sửa</a></td>
        <td>
        <?php
        include 'conn.php';
        $sql = "SELECT * FROM hopDong
        WHERE idBaoHiem = ".$each['id']."";
        $result = mysqli_query($connect, $sql);
        include 'dis-conn.php';
            if(mysqli_num_rows($result)==0){
                ?>
                <a class="btn btn-danger" href="insurance/delete.php?id=<?php echo $each['id']?>&search=<?php echo $search; ?>&p=<?php echo $p; ?>"><i class="fa-solid fa-trash-can"></i></a>
                <?php
            }
        ?>
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
