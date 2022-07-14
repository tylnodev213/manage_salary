<?php
session_start();
$id = $_SESSION['id_em'];
    $nam = date("Y");
    header('Content-Type: application/json');
    include '../admin/conn.php';
    $data = array();
    $query = "SELECT * FROM luong
    INNER JOIN chamCong 
    ON chamCong.id = luong.idChamCong
    WHERE chamCong.idNhanVien=$id AND chamCong.nam=$nam";
    $result = mysqli_query($connect,$query);
    include '../admin/dis-conn.php';
    foreach($result as $row){
        $data[] = $row;
    }
    echo json_encode($data);
?>