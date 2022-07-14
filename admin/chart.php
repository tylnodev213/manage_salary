<?php
    $nam = date("Y", strtotime("first day of previous month"));
    header('Content-Type: application/json');
    include 'conn.php';
    $data = array();
    $query = "SELECT chamCong.thang as thang, MAX(luong.thucLuong) AS size_status FROM luong
    INNER JOIN chamCong
    ON chamCong.id = luong.idChamCong
    WHERE chamCong.nam = $nam
    GROUP BY chamCong.thang
    ORDER BY size_status ASC
    LIMIT 3";
    $result = mysqli_query($connect,$query);
    include 'dis-conn.php';
    foreach($result as $row){
        $data[] = $row;
    }
    echo json_encode($data);
?>