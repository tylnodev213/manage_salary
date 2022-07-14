<?php 

session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Sửa thông tin</title>
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
        <?php 
        if(isset($_SESSION['id_em'])){
            ?>
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
                        <li>User ID : <?php echo $_SESSION['id_em'] ?></li>
                        <li><a href="../admin/logout.php"><i class="fa-solid fa-right-from-bracket"></i>Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>
        </header>
        <section>
            <div id="navbar__expand">
                <ul class="navbar__expand__box-menu">
                    <li class="navbar__expand__items 
                    <?php  
                        if($action=='calendar.php'){
                        echo 'active';
                        } 
                    ?>">
                        <a href="?action=calendar.php"><i class="fa-solid fa-calendar"></i> Lịch làm việc</a>
                    </li>
                    <li class="navbar__expand__items">
                        <a href="?action=info.php"><i class="fa-solid fa-id-badge"></i> Thông tin</a>
                    </li>
                    <li class="navbar__expand__items">
                        <a href="?action=history.php"><i class="fa-solid fa-money-bill-trend-up"></i> Lịch sử lương</a>
                    </li>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                    <li class="navbar__expand__items navbar__expand__items--bottom">
                        <a href="#" id="menu-off"><i class="fa-solid fa-angle-left"></i> Thu gọn</a>
                    </li>
                </ul>
            </div>
            <div id="content__homepage">
            <?php
        }else{
            ?>
            
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
        }
        ?>
                <h5 class="title"></h5>
<?php
$id = $_GET['id'] ?? '';
$search = $_GET['search'] ?? '';
$p = $_GET['p'] ?? 1;
include "../conn.php";
$sql = " SELECT nhanVien.*, phongBan.tenPhong, chucVu.chucVu 
FROM nhanVien 
INNER JOIN phongBan
ON nhanVien.idPhongBan = phongBan.id
INNER JOIN chucVu
ON nhanVien.idChucVu = chucVu.id 
WHERE nhanVien.id = '$id'";
$result = mysqli_query($connect,$sql);
include "../dis-conn.php";
foreach ($result as $each) {
?>
<form class="title" action="process_update.php?search=<?php echo $search; ?>&p=<?php echo $p; ?>" method="post">
<input type="hidden" name="id" value="<?php echo $each['id']; ?>">
<div class="form-row">
<div class="form-group col-md-6">
    <label>username</label>
    <input class="form-control" type="text" name="username" value="<?php echo $each['username']; ?>">
</div>
<div class="form-group col-md-6">
    <label>password</label>
    <input  class="form-control" type="text" name="password" value="<?php echo $each['password']; ?>">
</div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        <label>Họ tên</label>
        <input class="form-control" type="text" id="#hoTen" name="name" id="name" value="<?php echo $each['hoTen']; ?>">
    </div>
    <div class="form-group col-md-6">
        <label>Ngày sinh</label> 
        <input class="form-control" type="date" name="dob" value="<?php echo $each['ngaySinh']; ?>">
        </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <label>Giới tính</label>
        <div class="form-row">
        <div class="form-group col-md-6">
        <input type="radio" id="gt" name="gt" value="1" <?php if($each['gioiTinh']==1){ ?> checked <?php } ?>>Nam
        </div>
        <div class="form-group col-md-6">
        <input type="radio" id="gt" name="gt" value="0" <?php if($each['gioiTinh']==0){ ?> checked <?php } ?>>Nữ
        </div>
        </div>
            </div>
        
        <div class="col-md-6">
        <label>SDT</label> <input class="form-control" type="text" name="phone" id="phone" value="<?php echo $each['SDT']; ?>"><br>
        </div>
        Địa chỉ:<input class="form-control" type="text" name="address" value="<?php echo $each['diachi']; ?>"><br>
    <div class="row">
        <div class="col-md-6">
        <?php 
if(!isset($_SESSION['id_em'])){
?>
        Phòng ban: <select class="form-control" name="id_department">
        <option value="">-Chọn-</option>
        <?php
    include '../conn.php';
    $sql = "SELECT * FROM phongBan";
    $result = mysqli_query($connect,$sql);
    foreach($result as $row){
        ?>
        <option value="<?php echo $row['id'];?>"  
        <?php
            if($each['tenPhong'] == $row['tenPhong']){
        ?>
            selected
        <?php
            }
        ?>
            >
        <?php echo $row['tenPhong'];?></option>
        <?php
    }
?>
</select><br>
        </div>
        <div class="col-md-6">
    Chức vụ: <select class="form-control" name="id_position">
        <option>-Chọn-</option>
        <?php
    include '../conn.php';
    $sql = "SELECT * FROM chucVu";
    $result = mysqli_query($connect,$sql);
    foreach($result as $row){
        ?>
        <option value="<?php echo $row['id'];?>"  
        <?php
            if($each['chucVu'] == $row['chucVu']){
        ?>
            selected
        <?php
            }
        ?>
            >
        <?php echo $row['chucVu'];?></option>
        <?php
        }
        ?>
        </select><br>
        </div>
        <div class="col-md-6">
        <select name="trangThai" class="form-control">
            <option value="1"<?php 
            include '../conn.php';
            $sql = "SELECT * FROM nhanVien where id=$id";
            $result = mysqli_query($connect,$sql);
            include "../dis-conn.php";
            foreach($result as $row){
                if($row['trangThai']==1){
                    ?> selected <?php
                }
            }
            ?>>Làm việc</option>
            <option value="0"<?php 
            include '../conn.php';
            $sql = "SELECT * FROM nhanVien where id=$id";
            $result = mysqli_query($connect,$sql);
            include "../dis-conn.php";
            foreach($result as $row){
                if($row['trangThai']==0){
                    ?> selected <?php
                }
            }
            ?>>Nghỉ việc</option>
        </select><br>
        </div>
        <?php
    }else{
        ?>
        <input type="hidden" name="id_position" value="<?php echo $each['idChucVu']?>">
        <input type="hidden" name="id_department" value="<?php echo $each['idPhongBan']?>">
        <?php
    }
}
?>
    <div class="col-md-6">
        <button class="btn btn-success"onclick="return validate()">Cập nhật</button>
    </div>
    </div>
</form>
<span id="error_length"></span><br>
<span id="error_name"></span>
<span id="error_phone"></span>
<span id="error_radio"></span>
<?php 
$error =$_GET['error'] ?? '';
if($error=='dup'){
    echo 'Tài khoản này đã tồn tại hoặc phòng ban này đã có trưởng phòng';
}
?>
<?php
include '../../jQuery.php';
?>
<script>
    function validate() {
    let check=0;
    var regexPhone = /^[\+]?[0-9]{10,11}$/;
    // var regexEmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var regexName = /[a-zA-Z/sÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂ ưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]/;
    var text = document.querySelectorAll("input[type=text]");
    for(let i=0;i<text.length;i++) {
        if(text[i].value.length==0){
            check++
        }else{
            $("#error_length").text('')
        }
    }
    var name = document.querySelectorAll("#name");
    for(let i=0;i<name.length;i++) {
        if(!regexName.test(name[i].value)){
            check++
        }else{
            $("#error_name").text('')
        }
    }
    var phone = document.querySelectorAll("#phone");
    for(let i=0;i<phone.length;i++) {
        if(!regexPhone.test(phone[i].value)){
            check++
        }else{
            $("#error_phone").text('')
        }
    }
    // var email = document.querySelectorAll("#email");
    // for(let i=0;i<email.length;i++) {
    //     if(!regexEmail.test(email[i].value)){
    //         check++
    //     }else{
    //         $("#error_email").text('')
    //     }
    // }
    let check2=0;
    var radio = document.querySelectorAll("input[type=radio]");
    for(var i=0;i<radio.length;i++){
        if(radio[i].checked){
            check2++;
        } 
    }
    if(check2==0){
        check++
    }else{
        $("#error_radio").text('')
    }
    var select = document.querySelectorAll("select");
    for(var i=0;i<select.length;i++){
        if(select[i].value.length==0){   
            check++;
        }else{
            $("#error_select").text('')
        }
    }
    // let ngayBatDau = $("#ngayBatDau").val();
    // ngayBatDau= new Date(ngayBatDau)
    // let ngayKetThuc = $("#ngayKetThuc").val();
    // ngayKetThuc= new Date(ngayKetThuc)
    // if(Number(ngayBatDau)>=Number(ngayKetThuc)){
    //     check++
    // }
    if(check!=0){
        $("#error_date").text('Ngày không hợp lệ')
        $("#error_name").text('Tên sai cú pháp')
        $("#error_phone").text('SĐT sai cú pháp')
        $("#error_email").text('email sai cú pháp')
        $("#error_radio").text('Còn ô chưa được chọn')
        $("#error_select").text('Còn ô chưa được chọn')
        $("#error_length").text('điền những ô trống còn lại')
        return false;
    }else{
        return true;
    }
}
</script>
