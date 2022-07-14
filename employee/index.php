<?php
session_start();
if(!isset($_SESSION['id_em'])){
    header('location:../index.php');
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
    <link href="/quanliluong/fontawesome-free-6.1.1-web/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/body.css">
    <?php 
    $action = $_GET['action'] ?? 'calendar.php';
    if ( $action== 'calendar.php'){
        ?>
        <link rel="stylesheet" href="../css/calendar.css">
        <?php
    }else{
        ?>
        <link rel="stylesheet" href="../css/info.css">
        <?php
    }
    ?> 
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
                include $action;
            ?>
            </div>
        </section>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="../navbar-menu.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script>
        $(document).ready(function () {
            showGraph();
        });

        function showGraph(){
        
            $.post("chart.php",
                function (data){
                    console.log(data);
                    var formStatusVar = [];
                    var total = []; 

                    for (var i in data) {
                        formStatusVar.push("Tháng "+data[i].thang);
                        total.push(data[i].thucLuong);
                    }

                    var options = {
                        legend: {
                            display: false
                        },
                        scales: {
                            xAxes: [{
                                display: true
                            }],
                        yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    };

                    var myChart = {
                        labels: formStatusVar,
                        datasets: [
                            {
                                label: 'Lương',
                                backgroundColor: '#17cbd1',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#0ec2b6',
                                hoverBorderColor: '#42f5ef',
                                data: total
                            }
                        ]
                    };

                    var bar = $("#graph"); 
                    var barGraph = new Chart(bar, {
                        type: 'bar',
                        data: myChart,
                        options: options
                    });
                });
        }
    </script>
</body>
</html>