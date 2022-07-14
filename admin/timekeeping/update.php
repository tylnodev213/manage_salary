<?php
$id='';
if(isset($_GET['id'])){
    $id = $_GET['id'];
}
$search = $_GET['search'] ?? '';
$search1 = $_GET['search1'] ?? '';
$p = $_GET['p'] ?? 1;
$p2 = $_GET['p2'] ?? 1;
include 'conn.php';
$sql = "DELETE FROM luong WHERE idChamCong= $id";
mysqli_query($connect,$sql);
$sql = "SELECT * FROM chamCong where id='$id'";
$result = mysqli_query($connect,$sql);
include 'dis-conn.php';
foreach($result as $each){
    ?>
    <form class="title" action="process_update.php?search=<?php echo $search; ?>&search1=<?php echo $search1; ?>&p=<?php echo $p; ?>&p2=<?php echo $p2; ?>" method="POST">
    <input type="hidden" name="id" value="<?php echo $each['id']; ?>"><br>
    <input type="hidden" name="idNhanVien" value="<?php echo $each['idNhanVien']; ?>"><br>
    <?php
    include 'conn.php';
    $sql = "SELECT hoten FROM nhanVien where id = '".$each['idNhanVien']."'";
    $result = mysqli_query($connect,$sql);
    include 'dis-conn.php';
    foreach($result as $row){
        $hoten = $row['hoten'];
    }
    ?>
    Tên nhân viên: <?php echo $hoten; ?><br>
    <?php
    include 'conn.php';
    $sql = "SELECT luongCb FROM hopdong where idNhanVien = '".$each['idNhanVien']."'";
    $result = mysqli_query($connect,$sql);
    include 'dis-conn.php';
    foreach($result as $row){
        $luongCb = $row['luongCb'];
    }
    ?>
    Lương cơ bản: <?php echo $luongCb; ?><br>
    <?php
    include 'conn.php';
    include '../setTimezone.php';
    $first_day = date("Y-n-j", strtotime("first day of previous month"));
    $last_day = date("Y-n-j", strtotime("last day of previous month"));
    $sql = "SELECT COUNT(ngayChamCong) as total_date FROM chamcong_chitiet where ngayChamCong between '$first_day' and '$last_day'
    AND chamcong_chitiet.idNhanVien = '$id'";
    $result = mysqli_query($connect,$sql);
    include 'dis-conn.php';
    foreach($result as $row){
        $total_date = $row['total_date'];
    }
    ?>
    Số ngày làm việc:<?php echo $total_date; ?><br>
    Thưởng : <select class="form-control" name="idThuong">
        <option value="">-Chọn-</option>
            <?php
            include 'conn.php';
            $sql = "SELECT * FROM thuong";
            $result = mysqli_query($connect, $sql);
            include 'dis-conn.php';
            foreach ($result as $row){
                ?>
                <option value="<?php echo $row['id']; ?>"
                <?php
                if($each['idThuong']==$row['id']){
                    ?> selected
                    <?php
                }
                ?>
                ><?php echo $row['tienThuong']; ?></option>
                <?php
            }
            ?>
        </option>
    </select>
    <input type="hidden" name="thang" value="<?php echo date("n", strtotime("first day of previous month"));?>">
    <input type="hidden" name="nam" value="<?php echo date("Y"); ?>">
    <button class="btn btn-primary" >Cập nhật</button>
</form>
    <?php
}
?>
<?php
include '../jQuery.php';
?>
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
    // var name = document.querySelectorAll("#name");
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
    // // }
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
