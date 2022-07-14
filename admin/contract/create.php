<!doctype html>
<html lang="en">
  <head>
    <title>Thêm thông tin</title>
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
<form action="process_create.php" method="POST" class="title">
    <?php 
    $id = $_GET['id'] ?? '';
    include '../conn.php';
    $sql = "SELECT * FROM nhanVien
    WHERE NOT EXISTS 
    (SELECT * from hopDong
    WHERE nhanVien.id=hopDong.idNhanVien )
    AND id = '$id'";
    $result = mysqli_query($connect, $sql);
    include '../dis-conn.php';
    foreach ($result as $row){
        $hoTen = $row['hoTen'];
    }
    ?>
    <input type="hidden" name="idNhanVien" value="<?php echo $id; ?>">
    Tên nhân viên: <?php echo $hoTen; ?><br>
    Ngày bắt đầu: <input type="date" id="ngayBatDau" name="ngayBatDau"><br>
    Ngày kết thúc: <input type="date" id="ngayKetThuc" name="ngayKetThuc"><br>
    Lương cơ bản: <input type="number" id="luongCb" step="50" name="luongCb">nghìn đồng<br>
    Bảo hiểm:<select name="idBaohiem" id="idBaohiem">
        <option value="">-Chọn-</option>
        <?php
            include '../conn.php';
            $sql = "SELECT * FROM baoHiem";
            $result = mysqli_query($connect,$sql);
            include '../dis-conn.php';
            foreach($result as $each){
                ?>
                <option value="<?php echo $each['id'] ?>">
                    <?php echo $each['loaiBaohiem']."-".$each['tienBaohiem']." %"; ?>
                </option>
            <?php
            } 
        ?>
    </select><br>
    <button class="btn btn-primary" onclick="return validate()">Tạo</button>
</form>
<span style="font: size 12px;color:red;" id="error_date"></span><br>
<span style="font: size 12px;color:red;" id="error_select"></span>
<?php
include '../footer.php'; 
include '../../jQuery.php';
?>
<script src="../../navbar-menu.js"></script>
<script>
    function validate() {
    let check=0;
    // var regexPhone = /^[\+]?[0-9]{10,11}$/;
    // var regexEmail=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    // var regexName = /[a-zA-Z/sÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂ ưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]/;
    // var text = document.querySelectorAll("input[type=text]");
    // for(let i=0;i<text.length;i++) {
    //     if(text[i].value.length==0){
    //         check++
    //     }else{
    //         $("#error_length").text('')
    //     }
    // }
    // var name = document.querySelectorAll("#hoTen");
    // for(let i=0;i<name.length;i++) {
    //     if(!regexName.test(name[i].value)){
    //         check++
    //     }else{
    //         $("#error_name").text('')
    //     }
    // }
    // var phone = document.querySelectorAll("#phone");
    // for(let i=0;i<phone.length;i++) {
    //     if(!regexPhone.test(phone[i].value)){
    //         check++
    //     }else{
    //         $("#error_phone").text('')
    //     }
    // }
    // var email = document.querySelectorAll("#email");
    // for(let i=0;i<email.length;i++) {
    //     if(!regexEmail.test(email[i].value)){
    //         check++
    //     }else{
    //         $("#error_email").text('')
    //     }
    // }
    // let check2=0;
    // var radio = document.querySelectorAll("input[type=radio]");
    // for(var i=0;i<radio.length;i++){
    //     if(radio[i].checked){
    //         check2++;
    //     } 
    // }
    // if(check2==0){
    //     check++
    // }else{
    //     $("#error_radio").text('')
    // }
    var select = document.querySelectorAll("select");
    for(var i=0;i<select.length;i++){
        if(select[i].value.length==0){   
            check++;
        }else{
            $("#error_select").text('')
        }
    }
    let ngayBatDau = $("#ngayBatDau").val();
    ngayBatDau= new Date(ngayBatDau)
    let ngayKetThuc = $("#ngayKetThuc").val();
    ngayKetThuc= new Date(ngayKetThuc)
    if(Number(ngayBatDau)>=Number(ngayKetThuc)){
        check++
    }
    if(check!=0){
        $("#error_date").text('!ERROR :Ngày không hợp lệ')
        $("#error_name").text('!ERROR :Tên sai cú pháp')
        $("#error_phone").text('!ERROR :SĐT sai cú pháp')
        $("#error_email").text('!ERROR :email sai cú pháp')
        $("#error_radio").text('!ERROR :Còn ô chưa được chọn')
        $("#error_select").text('!ERROR :Còn ô chưa được chọn')
        $("#error_length").text('!ERROR :điền những ô trống còn lại')
        return false;
    }else{
        return true;
    }
}
</script>
