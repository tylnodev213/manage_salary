<!doctype html>
<html lang="en">
  <head>
    <title>Thêm chấm công chi tiết</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300&display=swap" rel="stylesheet">
    <link href="/quanliluong/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/header.css">
    <link rel="stylesheet" href="../../css/body.css">
    <body>
        <header style="z-index: 999;">
            <ul class="header__navbar header__navbar--left">
                <li class="header__navbar__items">
                    <a id="menu-on"><i class="fa-solid fa-bars" ></i></a>
                </li>
                <li class="header__navbar__items">
                    <i class="fa-solid fa-address-book"></i><span style="font-size:20px"> Ocean company</span> 
                </li>
            </ul>
            <ul class="header__navbar header__navbar--right">
                <li class="header__navbar__items">
                    <i class="fa-solid fa-bell"></i>
                </li>
                <li class="header__navbar__items">
                    <i class="fa-solid fa-circle-question"></i>
                </li>
                <li class="header__navbar__items" id="img-admin">
                    <img src="https://previews.123rf.com/images/bsd555/bsd5552003/bsd555200302924/143157301-admin-support-blue-rgb-color-icon-virtual-assistant-online-consultant-manager-managing-and-assistanc.jpg">
                    <ul id="menu-admin">
                        <li><a href="change_password.php">Đổi mật khẩu</a></li>
                        <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </header>
        <section>
            <div id="navbar__expand">
                <ul class="navbar__expand__box-menu">
                    <li class="navbar__expand__items">
                        <a href="../index.php"><i class="fa-solid fa-house-chimney"></i> Tổng quan</a>
                    </li>
                    <li class="navbar__expand__items">
                        <a href="../employee.php"><i class="fa-solid fa-user-gear"></i></i> Nhân viên</a>
                    </li>
                    <li class="navbar__expand__items">
                        <a href="../contract.php"><i class="fa-solid fa-file-contract"></i> Hợp đồng</a>
                    </li>
                    <li class="navbar__expand__items">
                        <a href="../insurance.php"><i class="fa-solid fa-user-nurse"></i></i></i> Bảo hiểm</a>
                    </li>
                    <li class="navbar__expand__items">
                        <a href="../department.php"><i class="fa-solid fa-folder-tree"></i> Phòng ban</a>
                    </li>
                    <li class="navbar__expand__items">
                        <a href="../position.php"><i class="fa-solid fa-user-group"></i> Chức vụ</a>
                    </li>
                    <li class="navbar__expand__items">
                        <a href="../timekeeping.php"><i class="fa-solid fa-calculator"></i> Chấm công</a>
                    </li>
                    <li class="navbar__expand__items">
                        <a href="../gift.php"><i class="fa-solid fa-circle-dollar-to-slot"></i> Thưởng</a>
                    </li>
                    <li class="navbar__expand__items navbar__expand__items--bottom">
                        <a href="#" id="menu-off"><i class="fa-solid fa-angle-left"></i> Thu gọn</a>
                    </li>
                </ul>
            </div>
            <div id="content__homepage">
            
<?php
$id = $_GET['id'] ?? "";
$action = $_GET['action'] ?? "";
?>
<h5 class="title"></h5>
<form method="POST" id="myForm">
    <input type="hidden" name="idNhanVien" value="<?php echo $id; ?>"><br>
    <?php
    include '../conn.php';
    $sql = "SELECT hoTen FROM nhanVien WHERE id='$id'";
    $result=mysqli_query($connect,$sql);
    include '../dis-conn.php';
    foreach($result as $row){
        $hoTen = $row['hoTen'];
    }
    ?>
    Tên nhân viên: <?php echo $hoTen; ?><br>
    <label for="example">Ngày chấm công thiếu</label>
    <input placeholder="Select date" type="date" class="form-control" name="ngayChamCong">
    <button id="submit" class="btn btn-primary">Thêm</button>
</form>
<span><?php 
if($action=='dup'){
    echo 'bạn đã điểm danh ngày này r';
}
?></span>
<?php
include '../footer.php'; 
include '../../jQuery.php';
?>
<script src="../../navbar-menu.js"></script>
<script>
    $('#submit').click(function(){
        confirm("Còn muốn bổ sung không");
        if(confirm("Còn muốn bổ sung Không")){
            $('#myForm').attr('action', 'process_create.php?return=y');
        }else{
            $('#myForm').attr('action', 'process_create.php?');
        }
    })
</script>
