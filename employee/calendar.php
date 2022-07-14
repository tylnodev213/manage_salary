<?php
$id = $_SESSION['id_em'];
// Set your timezone
include '../setTimezone.php';

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Today
$today = date('Y-m-d');

// For H3 title
$html_title = date('m / Y', $timestamp);

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// You can also use strtotime!
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);
 
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
//$str = date('w', $timestamp);


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ( $day = 1; $day <= $day_count; $day++, $str++) {
    if($day>=1 && $day <=9){
        $day="0".$day;
    }
    $date = $ym . '-' . $day;
    include '../admin/conn.php';
    $sql = "SELECT * FROM chamcong_chitiet
    INNER JOIN nhanVien
    ON nhanVien.id = chamcong_chitiet.idNhanVien
    INNER JOIN hopDong
    ON hopDong.idNhanVien = nhanVien.id WHERE nhanVien.id = '$id'
    AND (ngayChamCong BETWEEN ngayBatDau AND ngayKetThuc)";
    $result = mysqli_query($connect,$sql);
    include '../admin/dis-conn.php';
    $check=0;
    foreach($result as $each){
        if ($each['ngayChamCong'] == $date) {
            $check=1;
            $week .= '<td class="attend">' . $day. ' <i class="fa-solid fa-circle-check"></i></td>';
        }
    }
    if ($today == $date && $check!=1) {
        $week .= '<td class="today">' . $day. ' <i class="fa-solid fa-calendar-day"></i></td>';
    }else if($check==0){
        $week .= '<td>' . $day.'</td>';
    }
     
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        // Prepare for new week
        $week = '';
    }

}
?>
    <div class="container">
        <div class="row header_calendar">
            <h3><a href="?ym=<?php echo $prev; ?>"><i class="fa-solid fa-angle-left"></i></a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>"><i class="fa-solid fa-angle-right"></i></a></h3>
            <?php 
            $check = $_GET['check'] ?? '';
            switch($check){
                case 't':
                    ?>
                    <h3 setTimeout(display:none,3000);>Điểm danh thành công</h3>
                    <?php
                    break;
                case 'dup':
                    ?>
                    <h3 setTimeout(display:none,3000);>Bạn đã điểm danh rồi</h3>
                    <?php
                    break;
                default:
                    ?>
                    <h3></h3>
                    <?php
            }
            ?>
            <a href="attend.php?id=" class="btn btn-success">Điểm danh</a>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>Chủ nhật</th>
                <th>Thứ 2</th>
                <th>Thứ 3</th>
                <th>Thứ 4</th>
                <th>Thứ 5</th>
                <th>Thứ 6</th>
                <th>Thứ 7</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>
    </div>