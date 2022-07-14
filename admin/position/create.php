<form  class="title" action="position/process_create.php" method="POST">
    Tên chức vụ: <input class="form-control" type="text" name="name_position" id="name"><br>
    <button class="btn btn-success" onclick="return validate()">Thêm</button>
</form>
<span class="title" style="font: size 12px;color:red;" id="error_length"></span><br>
<span class="title" style="font: size 12px;color:red;" id="error_name"></span>
<?php
include '../jQuery.php';
?>
<script>
    function validate() {
    let check=0;
    // var regexPhone = /^[\+]?[0-9]{10,11}$/;
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
    // var select = document.querySelectorAll("select");
    // for(var i=0;i<select.length;i++){
    //     if(select[i].value.length==0){   
    //         check++;
    //     }else{
    //         $("#error_select").text('')
    //     }
    // }
    // let ngayBatDau = $("#ngayBatDau").val();
    // ngayBatDau= new Date(ngayBatDau)
    // let ngayKetThuc = $("#ngayKetThuc").val();
    // ngayKetThuc= new Date(ngayKetThuc)
    // if(Number(ngayBatDau)>=Number(ngayKetThuc)){
    //     check++
    // }
    if(check!=0){
        $("#error_date").text('!ERROR: Ngày không hợp lệ')
        $("#error_name").text('!ERROR: Tên chức vụ sai cú pháp')
        $("#error_phone").text('!ERROR: SĐT sai cú pháp')
        $("#error_email").text('!ERROR: email sai cú pháp')
        $("#error_radio").text('!ERROR: Còn ô chưa được chọn')
        $("#error_select").text('!ERROR: Còn ô chưa được chọn')
        $("#error_length").text('!ERROR: điền những ô trống còn lại')
        return false;
    }else{
        return true;
    }
}
</script>