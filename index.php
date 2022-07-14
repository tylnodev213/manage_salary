<?php
include 'setTimezone.php';
session_start();
if(isset($_SESSION['id'])){
    header('location:admin/index.php');
    } 
else if(isset($_SESSION['id_em'])){
  header('location:employee/index.php');
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Trang chủ</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300&display=swap" rel="stylesheet">
    <link href="fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/index.css">
  </head>
    <body>
          <div class="wrapper fadeInDown">
            <div id="formContent">
              <!-- Tabs Titles -->
              <!-- Icon -->
              <div class="fadeIn first">
                <h2 style="color:black"><?php echo "Hôm nay ngày ".date("d-m-Y"); ?></h2>
              </div>

              <!-- Login Form -->
              <form action="attendance.php" method="POST">
                <input type="text" id="username" class="fadeIn second" name="username" placeholder="Username"><br><span id="username_error" style="color:red; font-size:12px"></span><br>
                <input type="password" id="password" class="fadeIn third" name="password" placeholder="Password"><br><span id="password_error" style="color:red; font-size:12px"></span><br>
                <input onclick="return validate();" type="submit" class="fadeIn fourth" value="Log In">
              </form>

              <!-- Remind Passowrd -->
              <div id="formFooter">
              <?php
          $action= $_GET['action'] ?? '';
          if($action == 'f'){
              ?>
              <span id="fail">Tài khoản hoặc mật khẩu không đúng</span>
              <?php
                  }
              ?>
              </div>
            </div>
          </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <?php
    include 'jQuery.php';
    ?>
    <script type="text/javascript">
        function validate() {
            check=0;
            username = $('#username').val();
            if(username.length > 0) {
                check++;
            }else{
                $('#username_error').text('ô này đang để trống');
            }
            password = $('#password').val();
            if(password.length > 0) {
                check++;
            }else{
                $('#password_error').text('ô này đang để trống');
            }
            if(check!=1){
                return true;
            }else{
                return false;
            }
        }
    </script>
  </body>
</html>