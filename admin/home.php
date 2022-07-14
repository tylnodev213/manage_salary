<?php
include_once 'header.php';
?>
<h3 class="title">TỔNG QUAN HÔM NAY</h3>
<div class="content__sumary">
    <div class="content__sumary__items">
        <div class="content__sumary__items__title">
            <h5>Tổng số nhân viên</h5>
            <a href="employee.php">Chi tiết</a>
        </div>
        <div class="content__sumary__items__value">
            <img src="https://png.pngtree.com/element_our/20200610/ourlarge/pngtree-business-office-man-image_2244209.jpg" id="img-employee">
            <span id="number-employee">
                <?php
                include 'conn.php';
                $sql = "SELECT COUNT(id) as tongNhanVien FROM nhanVien";
                $result = mysqli_query($connect,$sql);
                include 'dis-conn.php';
                foreach($result as $row){
                    echo $row['tongNhanVien']." Nhân viên";
                }
                ?>
            </span>
        </div>
    </div>
    <div class="content__sumary__items">
        <div class="content__sumary__items__title">
            <h5>Lịch sử chấm công</h5>
            <a href="timekeeping_detail.php">Chi tiết</a>
        </div>
        <div class="content__sumary__items__value">
            <img id="img-history" src="https://gogeticon.net/files/3111474/3051a44f39d87c0c0bb113e42095279c.png">
            <span id="number-timekeeping">
                <?php
                include 'conn.php';
                include '../setTimezone.php';
                $sql = "SELECT COUNT(id) as tongNhanVien FROM chamcong_chitiet
                WHERE ngayChamCong ='".date("Y-m-d")."'";
                $result = mysqli_query($connect,$sql);
                include 'dis-conn.php';
                foreach($result as $row){
                    if($row['tongNhanVien']==0){
                        echo 'Chưa có nhân viên nào chấm công hôm nay';
                    }else{
                        echo "Có ".$row['tongNhanVien']." nhân viên đã chấm công hôm nay";
                    }
                }
                ?>
            </span>
        </div>
    </div>
    <div class="content__sumary__items">
        <div class="content__sumary__items__title">
            <h5>Mức lương cao qua các tháng</h5>
        </div>
        <div class="content__sumary__items__value">
        <div id="chart-container">
            <canvas id="graph"></canvas>
        </div>
        </div>
    </div>
</div>
<?php
include_once 'footer.php';
?>
