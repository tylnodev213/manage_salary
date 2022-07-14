<?php
$id = $_SESSION['id_em'];
include '../admin/conn.php';
$sql = "SELECT * FROM nhanVien 
INNER JOIN chucVu
ON chucVu.id = nhanVien.idChucVu
INNER JOIN phongBan
ON phongBan.id= nhanVien.idPhongBan
INNER JOIN hopDong
ON hopDong.idNhanVien = nhanVien.id
WHERE nhanVien.id = $id";
$result = mysqli_query($connect,$sql);
include '../admin/dis-conn.php';
foreach($result as $row){
?>
<div class="section about-section gray-bg" id="about">
    <div class="container">
        <a href="../admin/employee/update.php?id=<?php echo $id ?>"><i class="fa-solid fa-pen-to-square"></i><a>
        <div class="row align-items-center flex-row-reverse">
            <div class="col-lg-6">
                <div class="about-text go-to">
                    <h3 class="dark-color"><?php echo $row['hoTen'] ?></h3>
                    <h6 class="theme-color lead"><?php echo $row['chucVu']." tại phòng ".$row['tenPhong']?></h6>
                    <div class="row about-list">
                        <div class="col-md-6">
                            <div class="media">
                                <label>Ngày sinh</label>
                                <p><?php echo date("d/m/Y",strtotime($row['ngaySinh'])) ?></p>
                            </div>
                            <div class="media">
                                <label>Tuổi</label>
                                <p><?php echo date("Y")-date("Y",strtotime($row['ngaySinh'])) ?></p>
                            </div>
                            <div class="media">
                                <label>Địa chỉ</label>
                                <p><?php echo $row['diachi'] ?></p>
                            </div>
                            <div class="media">
                                <label>Phone</label>
                                <p><?php echo $row['SDT'] ?></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="media">
                                <label>Bắt đầu</label>
                                <p><?php echo date("d/m/Y",strtotime($row['ngayBatDau'])) ?></p>
                            </div>
                            <div class="media">
                                <label>Kết thúc</label>
                                <p><?php echo date("d/m/Y",strtotime($row['ngayKetThuc'])) ?></p>
                            </div>
                            <div class="media">
                                <label>Username</label>
                                <p><?php echo $row['username'] ?></p>
                            </div>
                            <div class="media">
                                <label>Password</label>
                                <p><?php echo $row['password'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-avatar">
                    <img src="<?php 
                    if( $row['gioiTinh']==1){ 
                        echo 'data:image/png;base64,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';
                    }else{
                        echo 'data:image/png;base64,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';
                    }
                    ?>" title="" alt="ảnh đại diện">
                </div>
            </div>
        </div>
        <?php
                    }
                    ?>
        <div class="counter">
            <div class="row">
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2">
                            <?php
                            include '../admin/conn.php';
                            $sql = "SELECT COUNT(ngayChamCong) as total FROM chamcong_chitiet 
                            WHERE idNhanVien = $id AND (MONTH(ngayChamCong) = ".date("m")." AND YEAR(ngayChamCong) = ".date("Y").")";
                            $result = mysqli_query($connect,$sql);
                            include '../admin/dis-conn.php';
                            foreach($result as $row){
                                $total = $row['total'];
                                echo $total;
                            }
                            ?>
                        </h6>
                        <p class="m-0px font-w-600">Ngày đi làm tháng này</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2">
                        <?php
                            include '../admin/conn.php';
                            $sql = "SELECT *  FROM hopDong
                            WHERE idNhanVien = $id";
                            $result = mysqli_query($connect,$sql);
                            include '../admin/dis-conn.php';
                            foreach($result as $row){
                                echo $row['luongCb']*$total." k";
                            }
                            ?>
                        </h6>
                        <p class="m-0px font-w-600">Lương tạm tính</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="850" data-speed="850">
                        <?php
                        $date = date("j");
                        echo $date-$total;
                        ?>
                        </h6>
                        <p class="m-0px font-w-600">Số ngày nghỉ tháng này</p>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="count-data text-center">
                        <h6 class="count h2" data-to="850" data-speed="850">
                        <?php
                         include '../admin/conn.php';
                         $sql = "SELECT *  FROM nhanVien
                         WHERE id = $id";
                         $result = mysqli_query($connect,$sql);
                         include '../admin/dis-conn.php';
                         foreach($result as $row){
                             $trangThai = $row['trangThai'];
                         }
                         if($row['trangThai']==1){
                            ?>
                        <i style="color:green;" class="fa-solid fa-circle-check"></i>
                            <?php
                            }else{
                            ?>
                        <i style="color:red;" class="fa-solid fa-circle-xmark"></i>
                            <?php
                            }
                        ?>
                        </h6>
                        <p class="m-0px font-w-600">Trạng thái</p>
                    </div>
                </div>
            </div>
        </div>
    </div>